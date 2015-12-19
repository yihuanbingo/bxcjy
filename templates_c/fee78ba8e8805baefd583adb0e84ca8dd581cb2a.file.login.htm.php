<?php /* Smarty version Smarty-3.1.7, created on 2014-07-12 12:45:13
         compiled from "./templates/property/login.htm" */ ?>
<?php /*%%SmartyHeaderCode:59395054553c0bd59b1c6c7-63802593%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fee78ba8e8805baefd583adb0e84ca8dd581cb2a' => 
    array (
      0 => './templates/property/login.htm',
      1 => 1403441759,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '59395054553c0bd59b1c6c7-63802593',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53c0bd59b5097',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c0bd59b5097')) {function content_53c0bd59b5097($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('property/library/page_passport_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<link rel="stylesheet" type="text/css"  href="/templates/property/css/passport.css">
<style type="text/css">
body{
background: url(/templates/images/banner_property_login.jpg) 0 0 repeat;
background-size:100% auto;
}
</style>

<div class="login-box">
<div class="login-panel">     
<h3>登录</h3>   
<div class="login-mod">
  <div class="login-err-panel" id="err_area" style="display:none">
    <span class="icon-wrapper"><i class="icon24-login err" style="margin-top:-.2em;*margin-top:0;"></i></span>
	<span id="err_tips" style="display:inline;">你还没有输入帐号！</span>
  </div>
  <form action="/property/login" method="post" enctype="multipart/form-data" class="login-form" id="login-form">
    <div class="login-un">
      <span class="icon-wrapper"><i class="icon24-login un"></i></span>
      <input type="text" name="account" placeholder="账号/一般为小区名称">
    </div>
    <div class="login-pwd">
      <span class="icon-wrapper"><i class="icon24-login pwd"></i></span>
      <input type="password" name="passwd" placeholder="密码">
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
  </div>
</div>
</div>
</div>
<script type="text/javascript">
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
</script><?php }} ?>