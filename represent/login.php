<?php
/*
 * 管理员登录
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);
require('../includes/init.php');

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'default' ;

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
   $rememberPwd = isset($_POST['rememberPwd']) ? intval($_POST['rememberPwd']) : 0 ;
   if(empty($account))
   {
      $msg = array("error"=>1,"data"=>"请输入登录账号");
   }
   elseif(empty($passwd))
   {
      $msg = array("error"=>1,"data"=>"请输入登录密码");
   }
   elseif(!$community_id = $Mysql->getOne("select community_id from ".$Base->table('account')." where type=2 and account='$account' and passwd='".$Common->md5Code($passwd)."'"))
   {
      $msg = array("error"=>1,"data"=>"账号或密码不正确");
   }
   else
   {
      $_SESSION['represent'] = array('community_id'=>$community_id,'account'=>$account);
      if($rememberPwd==1)
      {
        setcookie("represent",serialize(array('account'=>$account,'passwd'=>$Common->md5Code($passwd))),3600*24*7+time());
      }
      $msg = array("error"=>0,"data"=>"登录成功，进入管理后台","href"=>"/represent");
   }
   $msg = $Json->encode($msg);
   echo $msg;
   exit;
}

$smarty->assign('nav','login');
$smarty->assign('title','物业用户登录');
chdir('../');
$smarty->display("represent/login.htm");
?>