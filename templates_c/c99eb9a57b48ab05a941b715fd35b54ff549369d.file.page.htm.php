<?php /* Smarty version Smarty-3.1.7, created on 2014-07-17 19:17:15
         compiled from "./templates/admin/library/page.htm" */ ?>
<?php /*%%SmartyHeaderCode:123024661153c7b0bbe2ea57-37810358%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c99eb9a57b48ab05a941b715fd35b54ff549369d' => 
    array (
      0 => './templates/admin/library/page.htm',
      1 => 1405595710,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '123024661153c7b0bbe2ea57-37810358',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pages' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53c7b0bbe5026',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c7b0bbe5026')) {function content_53c7b0bbe5026($_smarty_tpl) {?> <!-- 公用分页 -->
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