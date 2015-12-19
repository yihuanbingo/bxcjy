<?php /* Smarty version Smarty-3.1.7, created on 2014-07-13 14:27:17
         compiled from "./templates/admin/message.htm" */ ?>
<?php /*%%SmartyHeaderCode:212946778953c226c5d52c02-32226625%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e4b70bcdc52bbbbb599066b8bbf7a1802adce04' => 
    array (
      0 => './templates/admin/message.htm',
      1 => 1404805092,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '212946778953c226c5d52c02-32226625',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'act' => 0,
    'community' => 0,
    'c' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53c226c5dbdab',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c226c5dbdab')) {function content_53c226c5dbdab($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('admin/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<div class="col_main">
	  <div class="main_hd">
	    <div class="title_tab">
		  <ul class="tab_navs">
		    <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='default'){?>class="selected"<?php }?>><a href="/admin/message.php">小区发送</a></li>
          <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='excel'){?>class="selected"<?php }?>><a href="/admin/message.php?act=excel">表格发送</a></li>
		  </ul>
		</div>
	  </div>

<div class="main_content">
<?php if ($_smarty_tpl->tpl_vars['act']->value=='default'){?>
<form action="/admin/message.php?act=community_send" method="post" enctype="multipart/form-data" id="community" class="form">
	<p class="f_content">
	<select name="community">
	<option value="0">所有小区</option>
   <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['community']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
   <option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['community_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['community_name'];?>
</option>
   <?php } ?>
   </select>
   <p class="f_content">
	<textarea name="content" style="width:360px;height:120px"></textarea>
   <p class="f_content">
   <input type="button" value="发 送" class="btn_primary" onclick="javascript:AjaxSubmit('community');">
</form>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['act']->value=='excel'){?>
<form action="/admin/message.php?act=excel_send" method="post" enctype="multipart/form-data" id="excel" class="form">
	<p class="f_content">
	<input type="file" name="phone">
   <p class="f_content">
	<textarea name="content" style="width:360px;height:120px"></textarea>
   <p class="f_content">
   <input type="button" value="发 送" class="btn_primary" onclick="javascript:AjaxSubmit('excel');">
</form>
<?php }?>

<?php }} ?>