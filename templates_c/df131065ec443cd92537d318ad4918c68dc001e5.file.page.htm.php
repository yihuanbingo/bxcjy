<?php /* Smarty version Smarty-3.1.7, created on 2016-01-06 22:09:14
         compiled from ".\templates\admin\library\page.htm" */ ?>
<?php /*%%SmartyHeaderCode:23196566bdf8d236132-63185930%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df131065ec443cd92537d318ad4918c68dc001e5' => 
    array (
      0 => '.\\templates\\admin\\library\\page.htm',
      1 => 1450618919,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23196566bdf8d236132-63185930',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_566bdf8d33fb7',
  'variables' => 
  array (
    'pages' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_566bdf8d33fb7')) {function content_566bdf8d33fb7($_smarty_tpl) {?> <!-- 公用分页 -->
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