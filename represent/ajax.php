<?php
/*
 * Ajax请求响应
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);    
require("../includes/init.php");    

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): '' ;
$community_id = $_SESSION['represent']['community_id'];
$msg = array('error'=>1,'data'=>'请选择一个具体的操作');

/* 删除物业费、停车费、代收快递 */
if($act=='deleteLog')
{  
   $logType = $Common->charFormat($_POST['logType']);
   $table = $Base->table($logType);
   $log = $_POST['log_id'];    //log数组
   if(count($log)==0)   //未选中任何数据
   {
      $msg = array('error'=>1,'data'=>'请至少选中一条记录');
   }
   else
   {
      foreach($log as $v)
      {  
		 if($logType=='log_express')
		 {
		    $sql = "delete from $table where log_id=$v and community_id=$community_id ";
		 }
	     else
		 {
		    $sql = "delete bl from $table as bl, ".$Base->table('householder')." as zh ".
			        "where bl.log_id=$v and bl.householder_id = zh.householder_id ".
					"and zh.community_id=$community_id ";
		 }
         $Mysql->query($sql);
      }
      $msg = array('error'=>0,'data'=>'删除成功，现在刷新');
   }
}

$msg = $Json->encode($msg);
echo $msg;
exit;
?>