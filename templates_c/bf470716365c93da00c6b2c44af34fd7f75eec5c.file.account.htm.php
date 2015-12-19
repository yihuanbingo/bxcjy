<?php /* Smarty version Smarty-3.1.7, created on 2015-12-12 16:49:16
         compiled from ".\templates\admin\account.htm" */ ?>
<?php /*%%SmartyHeaderCode:13166566bdf8c3a8f78-26302148%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bf470716365c93da00c6b2c44af34fd7f75eec5c' => 
    array (
      0 => '.\\templates\\admin\\account.htm',
      1 => 1405597186,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13166566bdf8c3a8f78-26302148',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'act' => 0,
    'list' => 0,
    'l' => 0,
    'community' => 0,
    'c' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_566bdf8cce462',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_566bdf8cce462')) {function content_566bdf8cce462($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('admin/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


	<div class="col_main">
	  <div class="main_hd">
	    <div class="title_tab">
		  <ul class="tab_navs">
		    <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='default'||'new_account'){?>class="selected"<?php }?>><a href="/admin/account.php">账户列表</a></li>
		  </ul>
		</div>
	  </div>

<div class="main_content">	 

<?php if ($_smarty_tpl->tpl_vars['act']->value=='default'){?>
<script type="text/javascript">
	function deleteAccount(id)
	{
		if(confirm("确定要删除这个账号吗？"))
		{
			$.post("/admin/account.php",{
				act:'delete_account',account_id:id},
			function(data)
			{

				var data = json_decode(data);
	    		if(data.error==0)
				{
					alertMsg(data.data);
					setTimeout("window.location.reload();",1000);
				}
	   			if(data.error==1)
	   			{
	    		 	/* 弹出错误提示 */
		 			alertMsg(data.data);
	   			}
			});	
		}
	}
</script>
<form action="/admin/account.php" method="get" enctype="multipart/form-data" name="search">
 <input type="hidden" name="page" value="1">
</form>
 <table class="info_list" cellspacing="1" width="100%">
 <tr>
  <th width="240px">账户名</th>
  <th width="100px">账户类型</th>
  <th width="240px">小区</th>
  <th>操作</th>
 </tr>
 <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value['res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value){
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
  <tr>
   <td><?php echo $_smarty_tpl->tpl_vars['l']->value['account'];?>
</td>
   <td><?php echo $_smarty_tpl->tpl_vars['l']->value['type'];?>
</td>
   <td><?php echo $_smarty_tpl->tpl_vars['l']->value['community_name'];?>
</td>
   <td>
   	<a href="javascript:void(0)" onclick="javascript:deleteAccount(<?php echo $_smarty_tpl->tpl_vars['l']->value['account_id'];?>
);">
		<img src="/templates/images/icon/icon_trash.gif" title="删除">
	</a>
   </td>
  </tr>
 <?php } ?>
 </table>
<div class="clear height10"></div>
<div class="float_r">
<?php echo $_smarty_tpl->getSubTemplate ("admin/library/page.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>
 <a href="/admin/account.php?act=new_account"><input type="button" class="btn_primary" value="新建账户"></a>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['act']->value=='new_account'){?>
<form action="/admin/account.php" method="post" enctype="multipart/form-data" id="new_account" class="form">
	<p class="f_title">账户名：<span class="color999 fontSize12">（账户名不多于30个字符）</span> 
	<p class="f_content"><input type="text" name="account" class="input">
	<p class="f_title">账户类型：
	<p class="f_content">
	<select name="type" id="type">
		<option value="1">物业</option>
		<option value="2">小区管理员</option>
	</select>
	<p class="f_title">所属小区：
	<p class="f_content">
	<select name="community_id" id="community_id">
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
	<input name="act" value="new_account" style="display:none">
	<input name="key" value="do_add" style="display:none">
    <p class="f_title">
    <input type="button" class="btn_primary" value="确认" onclick="javascript:AjaxSubmit('new_account');">
</form>
<?php }?><?php }} ?>