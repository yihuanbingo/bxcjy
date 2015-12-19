<?php
/*
 * 业主绑定管理
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);
require('../includes/init.php');
require('includes/cls_property.php');
Property::checkUserLogin();

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'default';
$community_id = $_SESSION['property']['community_id'];

/* 显示已绑定业主 */
if($act=='default')
{
   $is_bind = isset($_REQUEST['is_bind']) ? intval($_REQUEST['is_bind']) : -1 ;
   $keywords = isset($_REQUEST['keywords']) ? $Common->charFormat($_REQUEST['keywords']): '';
   $pageNow = isset($_REQUEST['page']) ? intval($_REQUEST['page']): 1;
   $pageNum = 50;
   $householder = Property::getHouseholder($community_id,$pageNow,$pageNum,$is_bind,$keywords);
   $pages = Property::setPage($pageNum,$pageNow,$householder['resNum']); 
   $smarty->assign('householder',$householder);
   $smarty->assign('pages',$pages);
   $smarty->assign('keywords',$keywords);
   $smarty->assign('is_bind',$is_bind);
}
/* 重新绑定界面 */
elseif($act=='bind')
{

}
/* 重新绑定操作 */
elseif($act=='act_bind')
{
   $file_tmp = isset($_FILES['imgFile']) ? $_FILES['imgFile'] : '' ;
   if(!empty($file_tmp))   //有上传bind文件
   {  
      $file = $file_tmp['tmp_name'];
	  $file_type = $file_tmp['type'];
      /* 允许上传的文件类型 */
      if(!Property::check_excel_type($file_type)) 
	  {  
	     $msg = array('error'=>1,'message'=>'仅允许上传xls（excel2003）文件');
	  }
	  else 
	  {
         require('../includes/excel/reader.php');
         $xls = new Spreadsheet_Excel_Reader(); 
         $xls->setOutputEncoding('utf-8');  //设置编码 
         $xls->read($file);  //解析文件
		 $res = $xls->sheets[0]['cells'];
		 $title = current($res);
		 if($Common->charFormat($title[1])!='单元房号' || $Common->charFormat($title[2])!='业主姓名' || $Common->charFormat($title[3])!='业主电话')
		 {
		    $msg = array('error'=>1,'message'=>'excel格式须为 单元房号|业主姓名|业主电话');
		 }
		 else
		 {
		    $table = $Base->table('householder');
            array_shift($res);   //去掉第一个元素
		    foreach($res as $k=>$v)
			{
			   $house_number = $Common->charFormat($v[1]);
			   $house_number = str_replace(' ','',$house_number);    //去掉空格
			   $owner = $Common->charFormat($v[2]);
			   $owner = str_replace(' ','',$owner);   //去掉空格
			   $mobile = $Common->charFormat($v[3]);
			   $data = array(
			   'house_owner'=>$owner,
			   'mobile'=>$mobile,
			   'update_time'=>time(),
			   );
			   if($Mysql->getOne("select householder_id from $table where community_id=$community_id and house_number='$house_number'"))   //更新
			   {
			       $where = array('house_number'=>$house_number);
			       if($Mysql->update($data,$table,$where))
				   {
				      $msg['error'] = 0;
					  $msg['url'] = '/property/bind';
				   }
			   }
			   else   //插入
			   {
			       $data['house_number'] = $house_number;
				   $data['community_id'] = $community_id;
				   if($Mysql->insert($data,$table))
				   {
				      $msg['error'] = 0;
					  $msg['url'] = '/property/bind';
				   }
			   }
			}
		 }     
	  }
	  $msg = $Json->encode($msg);
	  echo $msg;
	  exit;
   } 
}
/* 更新单条数据 */
elseif($act=='update')
{
   $householder_id = isset($_REQUEST['householder_id']) ? intval($_REQUEST['householder_id']): 0 ;
   $sql = "select householder_id from ".$Base->table('householder')." where householder_id=$householder_id ".
		  "and community_id=$community_id ";
   $householder_id = $Mysql->getOne($sql);
   $msg = array('error'=>1,'data'=>'系统错误，请求失败');
   if($householder_id)
   {
      $house_owner = isset($_POST['house_owner']) ? $Common::charFormat($_POST['house_owner']):'';
	  $mobile = isset($_POST['mobile']) ? $Common::charFormat($_POST['mobile']): '' ;
	  if($house_owner=='' || $mobile=='')
	  {
	     $msg = array('error'=>1,'data'=>'业主姓名与手机号均不能为空');   
	  }
	  else
	  {
	     $data = array(
		 'house_owner'=>$house_owner,
		 'mobile'=>$mobile,
		 );
		 $table = $Base->table('householder');
		 $where = array('householder_id'=>$householder_id);
		 if($Mysql->update($data,$table,$where))
		 {
		    $msg = array('error'=>0,'data'=>'恭喜，修改成功'); 
		 }
	  }
   }
   $msg = $Json->encode($msg);
   echo $msg;
   exit;
}
$smarty->assign('act',$act);
$smarty->assign('nav','bind');
chdir('../');
$smarty->display("property/bind.htm");

?>