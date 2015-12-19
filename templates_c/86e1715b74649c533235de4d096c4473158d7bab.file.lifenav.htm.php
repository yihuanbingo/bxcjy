<?php /* Smarty version Smarty-3.1.7, created on 2014-07-29 11:00:06
         compiled from "./templates/represent/lifenav.htm" */ ?>
<?php /*%%SmartyHeaderCode:186260123253c7877495f4f2-33487096%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '86e1715b74649c533235de4d096c4473158d7bab' => 
    array (
      0 => './templates/represent/lifenav.htm',
      1 => 1406602804,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '186260123253c7877495f4f2-33487096',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53c78774b0273',
  'variables' => 
  array (
    'cat_id' => 0,
    'act' => 0,
    'cat' => 0,
    'c' => 0,
    'sc' => 0,
    'r' => 0,
    'cat_name' => 0,
    'attrs' => 0,
    'a' => 0,
    'av' => 0,
    'lifenav' => 0,
    'l' => 0,
    'k' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c78774b0273')) {function content_53c78774b0273($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('represent/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript">
function deleteCat(id)
{
	$.post("/represent/lifenav.php",{
		act:'deletecat',cat_id:id},
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
</script>
<script type="text/javascript">
function deleteAttr(id)
{
	$.post("/represent/lifenav.php?act=attr&cat_id=<?php echo $_smarty_tpl->tpl_vars['cat_id']->value;?>
",{
		act:'delete_attr',attr_id:id},
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
</script>

	<div class="col_main">
	  <div class="main_hd">
	    <div class="title_tab">
		  <ul class="tab_navs">
		    <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='lifenav_cat'||$_smarty_tpl->tpl_vars['act']->value=='attr'){?>class="selected"<?php }?>><a href="/represent/lifenav">生活导航分类</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['act']->value=='lifenav'){?>class="selected"<?php }?>><a href="/represent/lifenav?act=lifenav">生活导航</a></li>
		  </ul>
		</div>
	  </div>

<div class="main_content">	 
<?php if ($_smarty_tpl->tpl_vars['act']->value=='lifenav_cat'){?>  
 <table class="info_list" cellspacing="1">
  <tr>
   <th>生活导航名称</th>
   <th width="80px">排 序</th>
   <th width="200px">操作</th>
  </tr>
  <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cat']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
   <tr>
    <td><?php echo $_smarty_tpl->tpl_vars['c']->value['cat_name'];?>
</td>  
	<td><?php echo $_smarty_tpl->tpl_vars['c']->value['sort_order'];?>
</td>
    <td></td>
   </tr>
   <?php  $_smarty_tpl->tpl_vars['sc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['c']->value['sub_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sc']->key => $_smarty_tpl->tpl_vars['sc']->value){
$_smarty_tpl->tpl_vars['sc']->_loop = true;
?>
   <tr>
    <td>&ensp;- <?php echo $_smarty_tpl->tpl_vars['sc']->value['cat_name'];?>
</td>  
	<td><?php echo $_smarty_tpl->tpl_vars['sc']->value['sort_order'];?>
</td>
	<td align="center">
    	<div id="edit_view_<?php echo $_smarty_tpl->tpl_vars['r']->value['cat_id'];?>
">
			<a href="/represent/lifenav.php?act=lifenav&cat_id=<?php echo $_smarty_tpl->tpl_vars['sc']->value['cat_id'];?>
">
			    <img src="/templates/images/icon/icon_add.gif" title="添加">
			</a>&ensp;
	   	</div>
    </td>
   </tr>
   <?php } ?>
  <?php } ?>
  </table>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['act']->value=='attr'){?>
 <table class="info_list" cellspacing="1">
  <tr>
   <th width="160px"><?php echo $_smarty_tpl->tpl_vars['cat_name']->value;?>
 的属性</th>
   <th width="80px">类 型</th>
   <th>可选值</th>
   <th width="50px">排 序</th>
   <th width="80px">操作</th>
  </tr>
  <?php  $_smarty_tpl->tpl_vars['a'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['a']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['attrs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['a']->key => $_smarty_tpl->tpl_vars['a']->value){
$_smarty_tpl->tpl_vars['a']->_loop = true;
?>
   <tr>
	<td><?php echo $_smarty_tpl->tpl_vars['a']->value['attr_name'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['a']->value['type'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['a']->value['value'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['a']->value['sort_order'];?>
</td>
	<td>
	  <a href="javascript:void(0);" onClick="javascript:deleteAttr(<?php echo $_smarty_tpl->tpl_vars['a']->value['attr_id'];?>
);"}>
	    		<img src="/templates/images/icon/icon_trash.gif" title="删除">
	  </a>
	</td>
   </tr>
  <?php } ?>
  
  </table>
  <div class="clear height10"></div>
  <form action="/represent/lifenav.php" method="post" enctype="multipart/form-data" id="lifenav" class="form">
   <p class="f_title">属性名称：
   <p class="f_content"><input type="text" name="attr_name" class="input">
   <p class="f_title">类 型：
   <p class="f_content"><select name="type">
    <option value="input">输入框</option>
	<option value="select">单选</option>
	<option value="checkbox">多选</option>
   </select>
   <p class="f_title">可选值：<span class="color999 fontSize12">（多个值用英文 , 隔开）</span>
   <p class="f_content"><input type="text" name="value" class="input">
   <p class="f_title">排序：
   <p class="f_content"><input type="text" name="sort_order"  class="input" value="50" style="width:50px">
   <p>
    <input type="hidden" name="cat_id" value="<?php echo $_smarty_tpl->tpl_vars['cat_id']->value;?>
">
	<input type="hidden" name="act" value="add_attr">
	<input type="button" value="提 交" class="btn_primary" onclick="javascript:AjaxSubmit('lifenav');">
  </form>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['act']->value=='lifenav'){?>
<?php if ($_smarty_tpl->tpl_vars['cat_id']->value>0){?>
 <form action="/represent/lifenav.php?act=add_lifenav" method="post" enctype="multipart/form-data" id="lifenav" class="form">
   <p class="f_title">所属分类：
   <p class="f_content"><select name="cat_id"><option value="<?php echo $_smarty_tpl->tpl_vars['cat_id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['cat_name']->value;?>
</option></select>
   <?php  $_smarty_tpl->tpl_vars['a'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['a']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['attrs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['a']->key => $_smarty_tpl->tpl_vars['a']->value){
$_smarty_tpl->tpl_vars['a']->_loop = true;
?>
   <p class="f_title"><?php echo $_smarty_tpl->tpl_vars['a']->value['attr_name'];?>
：
   <p class="f_content">
    <?php if ($_smarty_tpl->tpl_vars['a']->value['type']=='input'){?>
	 <input type="input" class="input" name="<?php echo $_smarty_tpl->tpl_vars['a']->value['attr_id'];?>
">
	<?php }elseif($_smarty_tpl->tpl_vars['a']->value['type']=='select'){?>
	 <select name="<?php echo $_smarty_tpl->tpl_vars['a']->value['attr_id'];?>
">
	  <?php  $_smarty_tpl->tpl_vars['av'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['av']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['a']->value['value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['av']->key => $_smarty_tpl->tpl_vars['av']->value){
$_smarty_tpl->tpl_vars['av']->_loop = true;
?>
	   <option value="<?php echo $_smarty_tpl->tpl_vars['av']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['av']->value;?>
</option>
	  <?php } ?>
	 </select>
	<?php }elseif($_smarty_tpl->tpl_vars['a']->value['type']=='checkbox'){?>
	 <?php  $_smarty_tpl->tpl_vars['av'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['av']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['a']->value['value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['av']->key => $_smarty_tpl->tpl_vars['av']->value){
$_smarty_tpl->tpl_vars['av']->_loop = true;
?>
	  <label><input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['a']->value['attr_id'];?>
[]" value="<?php echo $_smarty_tpl->tpl_vars['av']->value;?>
"> <?php echo $_smarty_tpl->tpl_vars['av']->value;?>
</label> &ensp;
	 <?php } ?>
	<?php }?>
   <?php } ?>
   <p class="f_title">排 序：<span class="color999 fontSize12">（同类信息中，排序越小越靠前）</span>
   <p class="f_content"><input type="text" name="sort_order"  class="input" value="50" style="width:50px">
   <p>
	<input type="button" value="提 交" class="btn_primary" onclick="javascript:AjaxSubmit('lifenav');">
  </form>
<?php }else{ ?>
	<div class="content">
    <form action="/represent/lifenav.php?act=lifenav" method="get" enctype="multipart/form-data" name="search">
 	<input type="hidden" name="page" value="1">
    <input type="hidden" name="act" value="lifenav">
	</form>
	<table class="info_list" cellspacing="1">
	<tr>
	<th width="80px">导航分类</th>
	<th width="120px">所属小区</th>
	<th>导航细节</th>
    </tr>
    <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lifenav']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value){
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
    <tr>
    	<td width="80px"><?php echo $_smarty_tpl->tpl_vars['l']->value['cat_name'];?>
</td>
        <td width="120tpx"><?php echo $_smarty_tpl->tpl_vars['l']->value['community_name'];?>
</td>
        <td><?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['l']->value['content']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
:<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</br><?php } ?></td>
	</tr>
    <?php } ?>
    </table>
    <div class="clear_height:10"><div>
      <div class="float_r">
   <?php echo $_smarty_tpl->getSubTemplate ("property/library/page.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
	
   	  </div>
	</div>
 	

<?php }?>
<?php }?>
</div>

</div>
<?php }} ?>