<?php
/*
 * 首页
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);
require("includes/init.php");
require("admin/includes/cls_admin.php");

$activity_id = isset($_REQUEST['activity_id']) ? $Common->charFormat($_REQUEST['activity_id']) : "1";
$admin = new Admin();
$activityres = $admin->getActivity($activity_id);
if($activityres) {
    $smarty->assign('activity', $activityres);
    $smarty->display('index.htm');
}
else{
    echo "活动不存在";
}
?>