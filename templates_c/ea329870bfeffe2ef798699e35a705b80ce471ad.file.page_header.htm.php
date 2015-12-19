<?php /* Smarty version Smarty-3.1.7, created on 2014-07-16 22:02:00
         compiled from "./templates/admin/library/page_header.htm" */ ?>
<?php /*%%SmartyHeaderCode:178469243053c226be4eb679-45567351%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ea329870bfeffe2ef798699e35a705b80ce471ad' => 
    array (
      0 => './templates/admin/library/page_header.htm',
      1 => 1405519318,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '178469243053c226be4eb679-45567351',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53c226be5258d',
  'variables' => 
  array (
    '_lang' => 0,
    'admin' => 0,
    'nav' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c226be5258d')) {function content_53c226be5258d($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<title>管理中心 - <?php echo $_smarty_tpl->tpl_vars['_lang']->value['title'];?>
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
  <div class="member_info float_r">
   <div class="ml float_l">
     <img src="/templates/images/icon/icon_property.png">
     <div class="mtext" style="background:none;padding-right:0">
	  <?php echo $_smarty_tpl->tpl_vars['admin']->value['aname'];?>

	 </div>
   </div>
   <div class="mr float_r">
    <span class="color999">|</span>&ensp;<a href="/admin/?act=logout">退出</a>
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
    	   微信端
    	 </dt>
         <dd class="dd"><a href="/admin/info.php" <?php if ($_smarty_tpl->tpl_vars['nav']->value=='info'){?>class="selected"<?php }?>>文章管理</a></dd>
         <dd class="dd"><a href="/admin/lifenav.php" <?php if ($_smarty_tpl->tpl_vars['nav']->value=='lifenav'){?>class="selected"<?php }?>>生活导航</a></dd>
         <dd class="dd"><a href="/admin/masssend.php" <?php if ($_smarty_tpl->tpl_vars['nav']->value=='masssend'){?>class="selected"<?php }?>>群发管理</a></dd>
         <dd class="dd"><a href="/admin/message.php" <?php if ($_smarty_tpl->tpl_vars['nav']->value=='message'){?>class="selected"<?php }?>>短信群发</a></dd>
     </dl>
     <dl class="dl">
       <dt class="dt">
         <i class="icon_menu"></i>
         <i class="icon_switch"></i>
         后台
       </dt>
    	   <dd class="dd"><a href="/admin/community.php" <?php if ($_smarty_tpl->tpl_vars['nav']->value=='community'){?>class="selected"<?php }?>>小区管理</a></dd>
         <dd class="dd"><a href="/admin/region.php" <?php if ($_smarty_tpl->tpl_vars['nav']->value=='region'){?>class="selected"<?php }?>>地区管理</a></dd>
         <dd class="dd"><a href="/admin/account.php" <?php if ($_smarty_tpl->tpl_vars['nav']->value=='account'){?>class="selected"<?php }?>>账户管理</a></dd>
        </dl>
    </div><?php }} ?>