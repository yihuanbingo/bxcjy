<?php
/*
 * 首页
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);
require("includes/init.php");


$activity_id= isset($_REQUEST['activity_id']) ? intval($_REQUEST['activity_id']) : "1";
$smarty->assign('activity_id', $activity_id);
$smarty->display('index.htm');
?>