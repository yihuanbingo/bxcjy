<?php /* Smarty version Smarty-3.1.7, created on 2014-07-28 13:43:25
         compiled from "./templates/represent/library/page.htm" */ ?>
<?php /*%%SmartyHeaderCode:198738055053d5e2fd82b6e9-14913557%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64b588938ddfeacf83828548ab26dd7c764aa291' => 
    array (
      0 => './templates/represent/library/page.htm',
      1 => 1403441759,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '198738055053d5e2fd82b6e9-14913557',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pages' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53d5e2fd84a4a',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53d5e2fd84a4a')) {function content_53d5e2fd84a4a($_smarty_tpl) {?> <!-- 公用分页 -->
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