<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/12
 * Time: 16:46
 */
define("IN_BS", true);

require("../includes/init.php");
require('includes/cls_admin.php');
//Admin::checkAdminLogin();

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']) : 'default';
$aid = $_SESSION['admin']['aid'];
$admin = new Admin();
/* 验证码列表 */
if ($act == 'default') {
    //todo
    $pageNow = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
    $pageNum = 10;
    $activity = isset($_REQUEST['activity']) ? intval($_REQUEST['activity']) : 0;
    $valifycode = isset($_REQUEST['valifycode']) ? $Common->charFormat($_REQUEST['valifycode']) : '';
    $use_account = isset($_REQUEST['use_account']) ? $Common->charFormat($_REQUEST['use_account']) : '';
    $pages = Admin::setPage($pageNum, $pageNow, $list['resNum']);

    $list = $admin->getValify($pageNow, $pageNum, $activity, $valifycode, $use_account);
    $activitylist = $admin->getAllActivity();
    $smarty->assign('list', $list);
    $smarty->assign('pages', $pages);
    $smarty->assign('activitylist', $activitylist);
    $smarty->assign('activity', $activity);
    $smarty->assign('valifycode', $valifycode);
    $smarty->assign('use_account', $use_account);
}

if ($act == 'product') {
    $key = isset($_REQUEST['key']) ? $Common->charFormat($_REQUEST['key']) : '';
    if (empty($key)) {
        $activitylist = $admin->getAllActivity();
        $smarty->assign('activitylist', $activitylist);
    } else {
        $activity = isset($_REQUEST['activity']) ? intval($_REQUEST['activity']) : 0;
        $codedigit = isset($_REQUEST['codedigit']) ? intval($_REQUEST['codedigit']) : 6;
        $codecount = isset($_REQUEST['codecount']) ? intval($_REQUEST['codecount']) : 0;
        $admin->productValifyCode($activity, $codecount, $codedigit);
    }
}


$smarty->assign('act', $act);
$smarty->assign('nav', 'valifycode');
chdir('../');
$smarty->display("admin/valifycode.htm");

?>