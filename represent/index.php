<?php
/*
 * 小区管理员后台首页
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);
require("../includes/init.php");
require("includes/cls_represent.php");
Represent::checkUserLogin();

$act= isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'default' ;
$community_id = $_SESSION['represent']['community_id'];

/* 默认首页 */
if($act=='default')
{
   $pageNow = isset($_REQUEST['page']) ? intval($_REQUEST['page']): 1;
   $pageNum = 30;
   $userinfo = Represent::getUserInfo($community_id,$pageNow,$pageNum,$lineNum);
   $pages = Represent::setPage($pageNum,$pageNow,$userinfo['resNum']);
   $smarty->assign('userinfo',$userinfo);
   $smarty->assign('pages',$pages);
}
/* 退出登录 */
elseif($act=='logout')
{
   unset($_SESSION['represent']);
   setcookie("represent");
   $Common->base_header("Location:/\n");  
}


chdir('../');
$smarty->display("represent/index.htm");

?>