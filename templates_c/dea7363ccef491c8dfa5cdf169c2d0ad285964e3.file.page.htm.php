<?php /* Smarty version Smarty-3.1.7, created on 2016-01-07 20:56:24
         compiled from ".\templates\property\library\page.htm" */ ?>
<?php /*%%SmartyHeaderCode:18475566be01cb4b207-87984121%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dea7363ccef491c8dfa5cdf169c2d0ad285964e3' => 
    array (
      0 => '.\\templates\\property\\library\\page.htm',
      1 => 1450618919,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18475566be01cb4b207-87984121',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_566be01cc607c',
  'variables' => 
  array (
    'pages' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_566be01cc607c')) {function content_566be01cc607c($_smarty_tpl) {?> <!-- 公用分页 -->
 <?php if ($_smarty_tpl->tpl_vars['pages']->value['pageNow']<=$_smarty_tpl->tpl_vars['pages']->value['pages']){?>  
   <!-- 如果当前分页小于等于总共页，防止1/0等情况出现 -->
   <span class="page_nav_area">
        <a href="javascript:<?php echo $_smarty_tpl->tpl_vars['pages']->value['page_pre'];?>
" class="btn page_prev"><i class="arrow"></i></a>
        
            <span class="page_num">
                <label><?php echo $_smarty_tpl->tpl_vars['pages']->value['pageNow'];?>
</label>
                <span class="num_gap">/</span>
                <label><?php echo $_smarty_tpl->tpl_vars['pages']->value['pages'];?>
</label>
            </span>
        
        <a href="javascript:<?php echo $_smarty_tpl->tpl_vars['pages']->value['page_next'];?>
" class="btn page_next"><i class="arrow"></i></a>
   </span>
   <span class="goto_area">
        <input type="text" id="mbPage">
        <a href="javascript:void(0);" onclick="javascript:gotoMpage('mbPage');" class="btn page_go">跳转</a>
   </span>
 <?php }?><?php }} ?>