<?php /* Smarty version Smarty-3.1.7, created on 2014-07-12 13:13:47
         compiled from "./templates/property/library/page_header.htm" */ ?>
<?php /*%%SmartyHeaderCode:136092206153c0c40b763df6-89813245%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5be969b92862f4d5a1365b25d2fe086169a16424' => 
    array (
      0 => './templates/property/library/page_header.htm',
      1 => 1403441759,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '136092206153c0c40b763df6-89813245',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    '_lang' => 0,
    'online' => 0,
    'nav' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53c0c40b7b22d',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c0c40b7b22d')) {function content_53c0c40b7b22d($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noarchive">
<link rel="stylesheet" type="text/css"  href="/templates/css/common.css">
<link rel="stylesheet" type="text/css"  href="/templates/property/css/common.css">
<script type="text/javascript" src="/templates/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="/templates/js/jquery.form.js"></script>
<script type="text/javascript" src="/templates/js/common.js"></script>
<script type="text/javascript" src="/templates/js/transaction.js"></script>
<title>物业管理中心 - <?php echo $_smarty_tpl->tpl_vars['_lang']->value['title'];?>
</title>
</head>
<body>

<div id="popDiv" class="mydiv" style="display:none">
<div class="middle"><div id="alertMsg"></div></div>
</div>

<div id="bg" class="bg" style="display:none"></div>

<div class="head_box">
 <div class="head">
  <a href="/property/"><img src="/templates/images/logo_40.png" class="logo float_l"></a>
  <div class="member_info float_r">
   <div class="ml float_l">
     <img src="/templates/images/icon/icon_property.png">
     <div class="mtext" style="background:none;padding-right:0">
	  <?php echo $_smarty_tpl->tpl_vars['online']->value['account'];?>

	 </div>
   </div>
   <div class="mr float_r">
    <span class="color999">|</span>&ensp;<a href="/property/?act=logout">退出</a>
   </div>
  </div>
 </div>
</div>

<div class="clear height20"></div>

<div class="body">
  <div class="container_box">
    <div class="col_side">
     <dl class="dl" style="border-top:0">
	   <dt class="dt">
	     <i class="icon_menu" style="background:url(/templates/images/index.png) -175px 0 no-repeat"></i>
		 <i class="icon_switch"></i>
		  物业管理
		</dt>
	   <dd class="dd"><a href="/property/property" <?php if ($_smarty_tpl->tpl_vars['nav']->value=='property'){?>class="selected"<?php }?>>物业费</a></dd>
	   <dd class="dd"><a href="/property/park" <?php if ($_smarty_tpl->tpl_vars['nav']->value=='park'){?>class="selected"<?php }?>>停车费</a></dd>
	   <dd class="dd"><a href="/property/express" <?php if ($_smarty_tpl->tpl_vars['nav']->value=='express'){?>class="selected"<?php }?>>代收快递</a></dd>
	 </dl>
	 <dl class="dl">
	   <dt class="dt">
	     <i class="icon_menu"></i>
		 <i class="icon_switch"></i>
		  动态管理
		</dt>
	   <dd class="dd"><a href="/property/notice" <?php if ($_smarty_tpl->tpl_vars['nav']->value=='notice'){?>class="selected"<?php }?>>通知管理</a></dd>
	   <dd class="dd"><a href="/property/askrepair" <?php if ($_smarty_tpl->tpl_vars['nav']->value=='askrepair'){?>class="selected"<?php }?>>报修申请</a></dd>
	   <dd class="dd"><a href="/property/advice" <?php if ($_smarty_tpl->tpl_vars['nav']->value=='advice'){?>class="selected"<?php }?>>投诉建议</a></dd>
	 </dl>
	 <dl class="dl">
	 	<dt class="dt">
	     <i class="icon_menu" style="background:url(/templates/images/index.png) 0 -29px no-repeat"></i>
		 <i class="icon_switch"></i>
		 小区设置 
		</dt>
       <dd class="dd"><a href="/property/intro" <?php if ($_smarty_tpl->tpl_vars['nav']->value=='intro'){?>class="selected"<?php }?>>小区介绍</a></dd>
	   <dd class="dd"><a href="/property/bind" <?php if ($_smarty_tpl->tpl_vars['nav']->value=='bind'){?>class="selected"<?php }?>>业主信息</a></dd>
	   <dd class="dd"><a href="/property/account" <?php if ($_smarty_tpl->tpl_vars['nav']->value=='account'){?>class="selected"<?php }?>>修改登录密码</a></dd>
	 </dl>
    </div><?php }} ?>