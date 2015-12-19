<?php /* Smarty version Smarty-3.1.7, created on 2014-07-13 14:27:10
         compiled from "./templates/admin/index.htm" */ ?>
<?php /*%%SmartyHeaderCode:97350783153c226be4558b4-34694434%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8a9435f736d72b67163180f74e69cbbe032ba8b' => 
    array (
      0 => './templates/admin/index.htm',
      1 => 1403441759,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '97350783153c226be4558b4-34694434',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'act' => 0,
    'key' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53c226be4e673',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c226be4e673')) {function content_53c226be4e673($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('admin/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>



	<div class="col_main">
	  <div class="main_hd">
	    <div class="title_tab">
		  <ul class="tab_navs">
		    <?php if ($_smarty_tpl->tpl_vars['act']->value=='recharge'){?>
		    <li <?php if ($_smarty_tpl->tpl_vars['key']->value=='recharge'||$_smarty_tpl->tpl_vars['key']->value=='act_recharge'||$_smarty_tpl->tpl_vars['key']->value=='rechargeRespond'){?>class="selected"<?php }?>><a href="/user/points">在线充值</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['key']->value=='rechargelog'){?>class="selected"<?php }?>><a href="/user/points?key=rechargelog">充值记录</a></li>
		    <?php }?>
		    <?php if ($_smarty_tpl->tpl_vars['act']->value=='withdraw'){?>
		    <li <?php if ($_smarty_tpl->tpl_vars['key']->value=='set'){?>class="selected"<?php }?>><a href="/user/points?act=withdraw">账号设置</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['key']->value=='apply'){?>class="selected"<?php }?>><a href="/user/points?act=withdraw&key=apply">申请提现</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['key']->value=='withdrawlog'){?>class="selected"<?php }?>><a href="/user/points?act=withdraw&key=withdrawlog">提现记录</a></li>
		    <?php }?>
			<?php if ($_smarty_tpl->tpl_vars['act']->value=='price'){?>
			  <li class="selected"><a href="/user/points?act=price">单题微豆数设置</a></li>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['act']->value=='log'){?>
			  <li <?php if ($_smarty_tpl->tpl_vars['key']->value=='use'){?>class="selected"<?php }?>><a href="/user/points?act=log">使用记录</a></li>
			  <li <?php if ($_smarty_tpl->tpl_vars['key']->value=='get'){?>class="selected"<?php }?>><a href="/user/points?act=log&key=get">获取记录</a></li>
			<?php }?>
		  </ul>
		</div>
	  </div>
	
<div class="main_content">	  
</div>

</div><?php }} ?>