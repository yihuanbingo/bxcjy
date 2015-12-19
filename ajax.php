<?php
/*
 * Ajax请求响应
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);    
require("includes/init.php");    

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): '' ;

if($act=='setRegion')
{
   $parent_id = intval($_REQUEST['parent_id']);
   $region_type = intval($_REQUEST['region_type']);
   $sql = "select region_id, region_name from ".$Base->table('region')." where region_type=$region_type and parent_id=$parent_id ";
   $res = $Mysql->getAll($sql);
   $res = $Json->encode($res);
   echo $res;
   exit;
}
 
echo '这是测试bitbucket的提交';
 
?>