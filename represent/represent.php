<?php
/*
 * 物业费管理
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);
require('../includes/init.php');
require('includes/cls_represent.php');
represent::checkUserLogin();

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'default' ;
$community_id = $_SESSION['represent']['community_id'];

represent::checkExistHouseholder($community_id,$nav='represent');

/* 显示缴费记录 */
if($act=='default')
{  
   $pay_late = empty($_REQUEST['pay_late']) ? date('Y-m',time()) : $Common->charFormat($_REQUEST['pay_late']) ;
   $status = isset($_REQUEST['status']) ? intval($_REQUEST['status']): -1;
   $keywords = isset($_REQUEST['keywords']) ? $Common->charFormat($_REQUEST['keywords']): '';
   $pageNow = isset($_REQUEST['page']) ? intval($_REQUEST['page']): 1;
   $pageNum = 30;   
   $smarty->assign('pay_late',$pay_late);
   $smarty->assign('status',$status);
   $smarty->assign('keywords',$keywords);
   $log = represent::getrepresentLog($community_id,$pageNow,$pageNum,$pay_late = strtotime($pay_late),$status,$keywords); 
   $pages = represent::setPage($pageNum,$pageNow,$log['resNum']); 
   $smarty->assign('log',$log);
   $smarty->assign('pages',$pages);
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
      if(!represent::check_excel_type($file_type)) 
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
		 if($Common->charFormat($title[1])!='单元房号' || $Common->charFormat($title[2])!='每月物业费' || $Common->charFormat($title[3])!='物业费缴至年份' || $title[4]!='物业费缴至月份')
		 { 
		    $msg = array('error'=>1,'message'=>'excel格式须为 单元房号|每月物业费|物业费缴至年份|物业费缴至月份');
		 }
		 else
		 {
		    $table = $Base->table('log_represent');
            array_shift($res);   //去掉第一个元素
			$error_no = "";
		    foreach($res as $k=>$v)
			{
			   $house_number = $Common->charFormat($v[1]);
			   $house_number = str_replace(' ','',$house_number);    //去掉空格
			   $pay_month = number_format($v[2],2);
			   $late_year = intval($v[3]);
			   $late_month = intval($v[4]); 
			   $pay_late = mktime(0,0,0,$late_month,1,$late_year);   //时间戳
			   $data = array(
			   'pay_month'=>$pay_month,
			   'pay_late'=>$pay_late,
			   'update_time'=>time(),
			   ); 
			   $householder_id = $Mysql->getOne("select householder_id from ".$Base->table('householder')." where community_id=$community_id and house_number='$house_number'");
			   if($householder_id>0)   //房号是正确的
			   {
			      if($Mysql->getOne("select log_id from ".$Base->table('log_represent')." where householder_id=$householder_id"))   //更新
			      {
			         $where = array('householder_id'=>$householder_id);
			         $Mysql->update($data,$table,$where);
			      }
			      else   //插入
			      {
			         $data['householder_id'] = $householder_id;
				     $Mysql->insert($data,$table);
			      }   
			   }
			   else   //房号不存在
			   {
			      $error_no .= "<p style='color:#666;font-size:13px'><font style='font-weight:bold;color:red'>".$house_number."</font>： 此房号输入错误或不存在，请核对或 <a href='/represent/bind' target='_blank' style='color:#1155cc'>更新业主信息</a><br>";
			   }
			}
			if(empty($error_no))   //没有错误信息
			{
			   $msg = array('error'=>0,'url'=>'/represent/represent');
			}
			else   //有错误信息，输出提示
			{
			   echo $error_no;
			   exit;
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
   $log_id = isset($_REQUEST['log_id']) ? intval($_REQUEST['log_id']): 0 ;
   $sql = "select bp.log_id from ".$Base->table('log_represent')." as bp, ".$Base->table('householder')." as bh ".
          "where bp.log_id=$log_id ".
		  "and bp.householder_id=bh.householder_id ".
		  "and bh.community_id=$community_id ";
   $log_id = $Mysql->getOne($sql);
   $msg = array('error'=>1,'data'=>'系统错误，请求失败');
   if($log_id)
   {
      $pay_month = isset($_POST['pay_month'])? number_format($_POST['pay_month'],2): 0.00 ;
	  $pay_late = isset($_POST['pay_late']) ? strtotime($_POST['pay_late']): 0 ;
	  if($pay_month==0.00 || $pay_late<=0)
	  {
	     $msg = array('error'=>1,'data'=>'请填写每月应缴和已交至年月');   
	  }
	  else
	  {
	     $data = array(
		 'pay_month'=>$pay_month,
		 'pay_late'=>$pay_late,
		 );
		 $table = $Base->table('log_represent');
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
$smarty->assign('nav','represent');
chdir('../');
$smarty->display("represent/represent.htm");

?>