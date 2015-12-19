<?php
/*
 * 物业后台首页
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);
require("../includes/init.php");
require("includes/cls_property.php");
Property::checkUserLogin();
$act= isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'default' ;
$community_id = $_SESSION['property']['community_id'];
if($act=='default')
{
	$pageNow = isset($_REQUEST['page']) ? intval($_REQUEST['page']): 1;
	$pageNum = 30;
	$userinfo = Property::getUserInfo($community_id,$pageNow,$pageNum,$lineNum);
	$pages = Property::setPage($pageNum,$pageNow,$userinfo['resNum']);
	$askrepairNum = Property::getNoAskrepairNum($community_id);
	$adviceNum = Property::getNoAdviceNum($community_id);
	$smarty->assign('userinfo',$userinfo);
	$smarty->assign('askrepairnum',$askrepairNum);
	$smarty->assign('advicenum',$adviceNum);
	$smarty->assign('pages',$pages);
}
/* 退出登录 */
if($act=='logout')
{
   unset($_SESSION['property']);
   setcookie("property");
   $Common->base_header("Location:/\n");  
}


chdir('../');
$smarty->display("property/index.htm");

?>