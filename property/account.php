<?php
/*
 * 账户设置
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);
require('../includes/init.php');
require('includes/cls_property.php');

Property::checkUserLogin();

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'passwd' ;
$account= $_SESSION['property']['account']; 

/* 修改密码界面 */
if($act=='passwd')
{
   //todo
}
/* 修改密码操作 */
elseif($act=='act_passwd')
{
   $passwd_old = isset($_POST['passwd_old']) ? $_POST['passwd_old']: '';
   $passwd = isset($_POST['passwd']) ? $_POST['passwd']: '';
   $passwd_re = isset($_POST['passwd_re']) ? $_POST['passwd_re']: '';
   if(mb_strlen($passwd)<6 || mb_strlen($passwd_old)<6 || mb_strlen($passwd_re)<6)
   {
      $msg = array(
	  'error'=>1,
	  'data'=>'密码不能少于6位',
	  );
   }
   elseif($passwd!==$passwd_re)
   {
      $msg = array(
	  'error'=>1,
	  'data'=>'两次输入密码不一致',
	  );
   }
   elseif(!$Mysql->getOne("select account_id from ".$Base->table('account')." where passwd='".$Common->md5Code($passwd_old)."' and account='".$account."'"))
   {
      $msg = array(
	  'error'=>1,
	  'data'=> '原密码不正确',
	  );      
   }
   else
   {
      if($Mysql->query("update ".$Base->table('account')." set passwd = '".$Common->md5Code($passwd)."' where account='".$account."'"))
	  {
	     $msg = array(
		 'error'=>0,
		 'data'=>'密码修改成功，请重新登录',
		 'href'=>'/',
		 );
		 session_unset();
		 session_destroy();
	  }
   }
   $msg = $Json->encode($msg);
   echo $msg;
   exit;
}

$smarty->assign('act',$act);
$smarty->assign('nav','account');
chdir('../');
$smarty->display("property/account.htm");

?>