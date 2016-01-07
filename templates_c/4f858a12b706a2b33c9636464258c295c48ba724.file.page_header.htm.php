<?php /* Smarty version Smarty-3.1.7, created on 2016-01-07 23:32:36
         compiled from ".\templates\admin\library\page_header.htm" */ ?>
<?php /*%%SmartyHeaderCode:6671566bdf8cf41e37-29572595%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4f858a12b706a2b33c9636464258c295c48ba724' => 
    array (
      0 => '.\\templates\\admin\\library\\page_header.htm',
      1 => 1452180754,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6671566bdf8cf41e37-29572595',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_566bdf8d1dc3a',
  'variables' => 
  array (
    '_lang' => 0,
    'admin' => 0,
    'nav' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_566bdf8d1dc3a')) {function content_566bdf8d1dc3a($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="robots" content="noarchive">
    <link rel="stylesheet" type="text/css" href="/templates/css/common.css">
    <link rel="stylesheet" type="text/css" href="/templates/css/detail.css">
    <link rel="stylesheet" type="text/css" href="/templates/admin/css/common.css">
    <script type="text/javascript" src="/templates/js/jquery-1.8.0.min.js"></script>
    <script type="text/javascript" src="/templates/js/jquery.form.js"></script>
    <script type="text/javascript" src="/templates/js/common.js"></script>
    <script type="text/javascript" src="/templates/js/transaction.js"></script>
    <script type="text/javascript" src="/templates/js/admin.js"></script>
    <title>管理中心 - <?php echo $_smarty_tpl->tpl_vars['_lang']->value['title'];?>
</title>
</head>
<body>

<div id="popDiv" class="mydiv" style="display:none">
    <div class="middle">
        <div id="alertMsg"></div>
    </div>
</div>

<div id="bg" class="bg" style="display:none"></div>

<div class="head_box">
    <div class="head">

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
            <dl class="dl">
                <dt class="dt">
                    <i class="icon_menu"></i>
                    <i class="icon_switch"></i>
                    后台
                </dt>
                <dd class="dd"><a href="/admin/activity.php" <?php if ($_smarty_tpl->tpl_vars['nav']->value=='activity'){?>class="selected"<?php }?>>活动管理</a></dd>
                <dd class="dd"><a href="/admin/valifycode.php" <?php if ($_smarty_tpl->tpl_vars['nav']->value=='valifycode'){?>class="selected"<?php }?>>验证码管理</a></dd>
                <dd class="dd"><a href="/admin/rechargerecord.php" <?php if ($_smarty_tpl->tpl_vars['nav']->value=='rechargerecord'){?>class="selected"<?php }?>>充值记录</a></dd>
            </dl>
        </div><?php }} ?>