<?php
/*
 * 代收快递管理
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);
require('../includes/init.php');
require('includes/cls_property.php');
Property::checkUserLogin();

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'default' ;
$community_id = $_SESSION['property']['community_id'];

Property::checkExistHouseholder($community_id,$nav='express');

/* 显示快递记录 */
if($act=='default')
{  
   $status = isset($_REQUEST['status']) ? intval($_REQUEST['status']): -1;
   $keywords = isset($_REQUEST['keywords']) ? $Common->charFormat($_REQUEST['keywords']): '';
   $pageNow = isset($_REQUEST['page']) ? intval($_REQUEST['page']): 1;
   $pageNum = 50;
   $log = Property::getExpressLog($community_id,$pageNow,$pageNum,$status,$keywords); 
   $pages = Property::setPage($pageNum,$pageNow,$log['resNum']); 
   $smarty->assign('log',$log);
   $smarty->assign('pages',$pages);
   $smarty->assign('status',$status);
   $smarty->assign('keywords',$keywords);
}
/* 显示上传 */
elseif($act=='bind')
{
   //todo
}
/* 上传excel文件 */
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
		 if($Common->charFormat($title[1])!='收件人姓名' || $Common->charFormat($title[2])!='收件人电话' || $Common->charFormat($title[3])!='快递公司名称' || $title[4]!='快递单号')
		 { 
		    $msg = array('error'=>1,'message'=>'excel格式须为 收件人姓名|收件人电话|快递公司名称|快递单号');
		 }
		 else
		 {
		    $table = $Base->table('log_express');
            array_shift($res);   //去掉第一个元素
		    foreach($res as $k=>$v)
			{
			   $name = $Common->charFormat($v[1]);
			   $phone = $Common->charFormat($v[2]);
			   $phone = str_replace(' ','',$phone);  //去掉空格
			   $express_name = $Common->charFormat($v[3]);
			   $express_sn = $Common->charFormat($v[4]); 
			   $data = array(
			   'community_id'=>$community_id,
			   'name'=>$name,
			   'phone'=>$phone,
			   'express_name'=>$express_name,
			   'express_sn'=>$express_sn,
			   'update_time'=>time(),
			   ); 
			   $Mysql->insert($data,$table);
			}
			$msg = array('error'=>0,'url'=>'/property/express');
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
   $log_id = isset($_REQUEST['log_id']) ? intval($_REQUEST['log_id']): 0 ;
   $sql = "select log_id from ".$Base->table('log_express')." where log_id=$log_id ".
		  "and community_id=$community_id ";
   $log_id = $Mysql->getOne($sql);
   $msg = array('error'=>1,'data'=>'系统错误，请求失败');
   if($log_id)
   {
      $name = isset($_POST['name']) ? $Common::charFormat($_POST['name']): '';
	  $phone = isset($_POST['phone']) ? $Common::charFormat($_POST['phone']): '';
	  $express_name = isset($_POST['express_name']) ? $Common::charFormat($_POST['express_name']): '';
	  $express_sn = isset($_POST['express_sn']) ? $Common::charFormat($_POST['express_sn']): '';
	  $status = isset($_POST['status']) ? intval($_POST['status']): 0 ;
	  if($name=='' || $phone=='' || $express_name=='' || $express_sn=='')
	  {
	     $msg = array('error'=>1,'data'=>'收件人信息，快递信息均不能为空');   
	  }
	  else
	  {
	     $data = array(
		 'name'=>$name,
		 'phone'=>$phone,
		 'express_name'=>$express_name,
		 'express_sn'=>$express_sn,
		 'status'=>$status
		 );
		 $table = $Base->table('log_express');
		 $where = array('log_id'=>$log_id);
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
$smarty->assign('nav','express');
chdir('../');
$smarty->display("property/express.htm");

?>