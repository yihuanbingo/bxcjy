<?php /* Smarty version Smarty-3.1.7, created on 2014-07-28 14:09:15
         compiled from "./templates/represent/index.htm" */ ?>
<?php /*%%SmartyHeaderCode:204414214953c7876e8a4d67-18823691%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2fd0704b49e6c84aea85fa85f6d3ccae19ceb8fc' => 
    array (
      0 => './templates/represent/index.htm',
      1 => 1406527753,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204414214953c7876e8a4d67-18823691',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53c7876e8e5aa',
  'variables' => 
  array (
    'userinfo' => 0,
    'u' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c7876e8e5aa')) {function content_53c7876e8e5aa($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('represent/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>



<style>
.subnum {
width:250px;
height:104px;
padding-top:26px;
border: 1px solid #74a478;
background-color: #86bd8a;
text-shadow: 0 1px 1px rgba(0,0,0,0.15);
border-radius: 3px;
color:#fff;
-webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.3);
text-align:center
}
.subnum .icon{
width: 54px;
height: 46px;
display:inline-block;
vertical-align:middle;
background: url("/templates/images/page_index_z.png") 0 -114px no-repeat;
}
.subnum .num{
font-weight: 400;
font-size: 35px;
display:inline-block;
vertical-align:middle;
}
.subnum .tit{
font-weight: 400;
font-size: 16px;
letter-spacing: 2px;
}
.infonum {
width:250px;
height:104px;
padding-top:26px;
border:1px solid #6c91a3;
background-color:#87b3d4;
text-shadow: 0 1px 1px rgba(0,0,0,0.15);
border-radius: 3px;
color:#fff;
-webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.3);
text-align:center
}

.infonum .icon{
width: 54px;
height: 46px;
display:inline-block;
vertical-align:middle;
background: url("/templates/images/page_index_z.png") 0 0 no-repeat;
}
.infonum .num{
font-weight: 400;
font-size: 35px;
display:inline-block;
vertical-align:middle;
}

.infonum .tit{
font-weight: 400;
font-size: 16px;
letter-spacing: 2px;
}  

.userinfo {
width:60px;
height:70px;
float:left;
margin:8px;
text-align:center;
overflow:hidden;
}
.userinfo img {
width: 58px;
height: 50px;
border:1px solid #e4e4e4;
}

</style>
<div class="col_main">
   <div class="main_hd">
      <div class="title_tab">

      </div>
   </div>

   <div class="main_content"> 
   <div class="subnum" style="display:inline-block">
      <span class="icon"></span>
      <span class="num"><?php echo $_smarty_tpl->tpl_vars['userinfo']->value['resNum'];?>
</span>
      <div class="clear"></div>
      <span class="tit">总关注数</span>
      <div class="clear"></div>
   </div>
      <div class="clear height20"></div>
      <?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['u']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['userinfo']->value['res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value){
$_smarty_tpl->tpl_vars['u']->_loop = true;
?>
      <div class="userinfo">
      <?php if ($_smarty_tpl->tpl_vars['u']->value['headimgurl']!=''){?>
      <img src=<?php echo $_smarty_tpl->tpl_vars['u']->value['headimgurl'];?>
 style="border:1px solid #ccc">
      <?php }else{ ?>
      <img src="/templates/images/avatar.jpg" style="border:1px solid #ccc">
      <?php }?>
      <p style="color:#666"><?php echo $_smarty_tpl->tpl_vars['u']->value['nickname'];?>
</p>
      </div>
      <?php } ?>
       <div class="clear height10"></div>
   <form action="/represent/" method="post" name="search" enctype="application/x-www-form-urlencoded">
      <input type="hidden" name="page" value="1">
   </form>
 <div class="float_r">
   <?php echo $_smarty_tpl->getSubTemplate ("represent/library/page.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

 </div>
 <div class="clear"></div>
   </div>


</div><?php }} ?>