<?php
/*
 * 物业后台首页
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);
require("../includes/init.php");
require("includes/cls_admin.php");
Admin::checkAdminLogin();

$act= isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'default' ;

/* 退出登录 */
if($act=='logout')
{
   unset($_SESSION['admin']);
   $Common->base_header("Location:/admin/login.php\n");  
}

/*
$arr = array(
'community_name'=>'御景台',
'property_name'=>'成都德昌行物业服务有限公司',
'account'=>'御景台',
'passwd'=>$Common::md5Code('123456'),
'contact_user'=>'王维富',
'contact_mobile'=>'15902806321',
'repair_phone'=>'18113133983',
'advice_phone'=>'15902806321',
'apply_time'=>time(),
'verify_time'=>time(),
'status'=>1
);
$table = $Base->table('community');
if($Mysql->insert($arr,$table))
{
   echo 'aaaaa';
}
*/

chdir('../');
$smarty->display("admin/index.htm");

?>