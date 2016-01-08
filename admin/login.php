<?php
/*
 * 管理员登录
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);
require('../includes/init.php');
require('includes/cls_admin.php');
session_start();
$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'default' ;
$admin = new Admin();
/* 登陆界面 */
if($act=='default')
{
   //todo
}
/* 登陆操作 */
elseif($act=='act_default')
{
   $account = isset($_POST['account']) ? $Common->charFormat($_POST['account']): '';
   $passwd = isset($_POST['passwd']) ? $_POST['passwd']: '' ;
   $res = $admin->getAccount($account);
   if(empty($account))
   {
      $msg = array('error'=>1,'data'=>'请输入登录账号');
   }
   elseif(empty($passwd))
   {
      $msg = array('error'=>1,'data'=>'请输入登录密码');
   }
   elseif(!$res || md5($passwd)!=$res['passwd'])
   {
      $msg = array('error'=>1,'data'=>'账号或密码不正确');
   }
   else
   {
      $_SESSION['admin'] = array('aid'=>1,'aname'=>$account);
	  $msg = array('error'=>0,'data'=>'登录成功，进入管理后台','href'=>'/admin');
   }
   $msg = $Json->encode($msg);
   echo $msg;
   exit;
}

$smarty->assign('nav','login');
$smarty->assign('title','管理员登录');
chdir('../');
$smarty->display("admin/login.htm");

?>