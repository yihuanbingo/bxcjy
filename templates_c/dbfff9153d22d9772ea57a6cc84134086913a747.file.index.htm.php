<?php /* Smarty version Smarty-3.1.7, created on 2014-07-12 13:12:25
         compiled from "./templates/index.htm" */ ?>
<?php /*%%SmartyHeaderCode:199005578153c0bdb9f0e706-42797541%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dbfff9153d22d9772ea57a6cc84134086913a747' => 
    array (
      0 => './templates/index.htm',
      1 => 1405141939,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '199005578153c0bdb9f0e706-42797541',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53c0bdba01f21',
  'variables' => 
  array (
    'nav' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c0bdba01f21')) {function content_53c0bdba01f21($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noarchive">
<link rel="stylesheet" type="text/css"  href="/templates/css/common.css">
<link rel="stylesheet" type="text/css"  href="/templates/property/css/common.css">
<link rel="stylesheet" type="text/css"  href="/templates/css/passport.css">
<script type="text/javascript" src="/templates/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="/templates/js/jquery.form.js"></script>
<script type="text/javascript" src="/templates/js/common.js"></script>
<script type="text/javascript" src="/templates/js/transaction.js"></script>
<title>小区快帮 - 用户登录</title>
<style type="text/css">
body{
background: url(/templates/images/banner_property_login.jpg) 0 0 repeat;background-size:100% auto;
}
.yswitch{
}
.yswitch li{
height:35px;line-height:35px;padding:0 15px;border:1px solid #ccc;border-bottom:0;border-right:0;background:#fff;
}
.yswitch li.onclick{
background:#5ba10e;color:#fff;font-weight:bold
}
</style>
</head>
<body>

<div id="popDiv" class="mydiv" style="display:none">
<div class="middle"><div id="alertMsg"></div></div>
</div>

<div id="bg" class="bg" style="display:none"></div>

<div class="head_box">
 <div class="head">
  <img src="/templates/images/logo_40.png" class="logo float_l">
  <div class="member_info float_r" style="display:none">
   <div class="mr float_r">
    <?php if ($_smarty_tpl->tpl_vars['nav']->value=='login'){?>
	  还没有账号？<a href="/property/apply">立即申请</a>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['nav']->value=='apply'){?>
	  已有账号？<a href="/property/login">直接登录</a>
	<?php }?>
   </div>
  </div>
 </div>
</div>

<div class="clear height20"></div>

<div class="login-box">
<div class="login-panel">     
<h3>请选择自己的身份进行登录</h3>
<div class="login-mod">
  <div class="login-err-panel" id="err_area" style="display:none">
    <span class="icon-wrapper"><i class="icon24-login err" style="margin-top:-.2em;*margin-top:0;"></i></span>
	<span id="err_tips" style="display:inline;">你还没有输入帐号！</span>
  </div>
  <ul class="yswitch">
   <a href="javascript:;" onclick="switchLoginUser('property');"><li id="property" class="onclick" style="border-top-left-radius:5px">小区物业</li></a>
   <a href="javascript:;" onclick="switchLoginUser('represent');"><li id="represent">小区管理员</li></a>
   <a href="javascript:;" onclick="switchLoginUser('agent');"><li id="agent" style="border-top-right-radius:5px;border-right:1px solid #ccc">代理商</li></a>
  </ul>
  <div class="clear"></div>
  <form action="/property/login" method="post" enctype="multipart/form-data" class="login-form" id="login-form" name="login-form">
    <div class="login-un">
      <span class="icon-wrapper"><i class="icon24-login un"></i></span>
      <input type="text" name="account" placeholder="请输入登录账号">
    </div>
    <div class="login-pwd">
      <span class="icon-wrapper"><i class="icon24-login pwd"></i></span>
      <input type="password" name="passwd" placeholder="请输入登录密码">
	  <input type="hidden" name="act" value="act_default">
      <input type="hidden" id="rememberPwd" name="rememberPwd" value="0">
    </div>
  </form> 
  <div class="login-help-panel">
    <a class="login-remember-pwd" href="javascript:void(0);" onclick="javascript:rememberPwd();">
	 <i id="rememberPwdIcon" class="icon24-login checkbox"></i>记住帐号</a>
    <a class="login-forget-pwd" href="">无法登录？</a>
  </div>
  <div class="login-btn-panel">
    <a class="login-btn" title="点击登录" href="javascript:AjaxSubmit('login-form');" id="login_button">登录</a>
    <span style="color:red;display:inline"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</span>
  </div>
</div>
</div>
</div>
<script type="text/javascript">
/*
* 记住密码
*/
function rememberPwd(){
 var classNow = document.getElementById('rememberPwdIcon');
 if(classNow.className=='icon24-login checkbox')
 {
    classNow.className = 'icon24-login checkbox_checked';
	$("#rememberPwd").val(1);
	return ;
 }
 if(classNow.className=='icon24-login checkbox_checked')
 {
    classNow.className = 'icon24-login checkbox';
	$("#rememberPwd").val(0);
	return ;
 }
}

/*
* 切换登录用户
*/
function switchLoginUser(user){
  var usertype = new Array("property","represent","agent");
  var count = usertype.length;
  for(var i=0; i < count; i++){
    if(user==usertype[i]){
	  document.getElementById(user).className="onclick";
	}else{
	  document.getElementById(usertype[i]).className = "";
	}
  }
  var action = "/"+user+"/login";
  document.forms["login-form"].action = action;    
}
</script>

</body>
</html><?php }} ?>