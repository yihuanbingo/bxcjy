<?php /* Smarty version Smarty-3.1.7, created on 2014-07-17 16:21:21
         compiled from "./templates/represent/account.htm" */ ?>
<?php /*%%SmartyHeaderCode:187635937853c787812265a3-89229823%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9a575be184660768eacc71005a1672219670cbea' => 
    array (
      0 => './templates/represent/account.htm',
      1 => 1403441759,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '187635937853c787812265a3-89229823',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'act' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53c78781260af',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c78781260af')) {function content_53c78781260af($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('represent/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>



	<div class="col_main">
	  <div class="main_hd">
	    <div class="title_tab">
		  <ul class="tab_navs">
		    <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='passwd'){?>class="selected"<?php }?>><a href="/represent/account">修改登录密码</a></li>
		  </ul>
		</div>
	  </div>
	
<div class="main_content">	 
  <form action="/represent/account" method="post" id="account" enctype="multipart/form-data" class="form">
   <p class="f_title">原密码：<span class="color999 fontSize12">（为保证本人操作，请输入原密码）</span>
   <p class="f_content"><input type="password" class="input" name="passwd_old">
   <p class="f_title">新密码：<span class="color999 fontSize12">（密码不得少于6位）</span>
   <p class="f_content"><input type="password" class="input" name="passwd">
   <p class="f_title">重复密码：<span class="color999 fontSize12">（请重复新密码）</span>
   <p class="f_content"><input type="password" class="input" name="passwd_re">
   <input type="hidden" name="act" value="act_passwd">
   <p class="f_title"><input type="button" class="btn_primary" value="确认修改" onclick="javascript:AjaxSubmit('account');">
  </form>
</div>

</div><?php }} ?>