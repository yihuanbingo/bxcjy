<?php /* Smarty version Smarty-3.1.7, created on 2014-07-12 12:45:13
         compiled from "./templates/property/library/page_passport_header.htm" */ ?>
<?php /*%%SmartyHeaderCode:197350256853c0bd59b544d5-48360147%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '891c9b66745f373c72395f70f67c58164b496bee' => 
    array (
      0 => './templates/property/library/page_passport_header.htm',
      1 => 1403441759,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '197350256853c0bd59b544d5-48360147',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    '_lang' => 0,
    'nav' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53c0bd59b7146',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c0bd59b7146')) {function content_53c0bd59b7146($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['_lang']->value['title'];?>
</title>
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
<?php }} ?>