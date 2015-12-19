<?php /* Smarty version Smarty-3.1.7, created on 2015-12-12 11:49:30
         compiled from ".\templates\admin\login.htm" */ ?>
<?php /*%%SmartyHeaderCode:14192566b994ab47507-40563195%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0cb22113577cec560ffbc4701de880b9b0a31c25' => 
    array (
      0 => '.\\templates\\admin\\login.htm',
      1 => 1403441760,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14192566b994ab47507-40563195',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_566b994ac7bec',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_566b994ac7bec')) {function content_566b994ac7bec($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('admin/library/page_passport_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style type="text/css">
 .login_box{
 width:500px;margin:150px auto;background:#fff;border-radius:5px;border:1px solid #ccc
 }
 .login_box h2{
 width:480px;padding-left:20px;height:45px;line-height:45px;background:#f3f3f3;border-bottom:1px solid #ccc
 }
</style>
<div class="login_box">
 <h2>
   管理员登录
 </h2>
 <form action="/admin/login.php" method="post" enctype="multipart/form-data" class="form" id="login" style="padding:20px;">
   <p class="f_content">用户名：<input type="text" name="account" class="input">
   <p class="f_content">密&ensp;&ensp;码：<input type="password" name="passwd" class="input">
   <input type="hidden" name="act" value="act_default">
   <p><input type="button" value="登 录" class="btn_primary" onclick="javascript:AjaxSubmit('login');">
 </form>
</div><?php }} ?>