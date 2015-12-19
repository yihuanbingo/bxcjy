<?php /* Smarty version Smarty-3.1.7, created on 2014-07-14 09:19:51
         compiled from "./templates/property/NoExistHouseholder.htm" */ ?>
<?php /*%%SmartyHeaderCode:102118986253c33037015429-92253291%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c25a6a47ac43cfe0d6c8b3eb55f40258573bc074' => 
    array (
      0 => './templates/property/NoExistHouseholder.htm',
      1 => 1403441759,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '102118986253c33037015429-92253291',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53c33037046ba',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c33037046ba')) {function content_53c33037046ba($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('property/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	
    <div class="col_main">
	  <div class="main_hd">
	    <div class="title_tab">
		  <ul class="tab_navs">
		    <li class="selected"><a href="#">提示信息</a></li>
		  </ul>
		</div>
	  </div>
	
<div class="main_content">	 
 <div class="noexisthouseholder">
  <i class="float_l">&nbsp;</i>
  <span class="float_l">你还没有上传任何业主资料，业主微信无法绑定对应房号，请先 <a href="/property/bind?act=bind">上传业主资料</a></span>
 </div>

</div>

</div><?php }} ?>