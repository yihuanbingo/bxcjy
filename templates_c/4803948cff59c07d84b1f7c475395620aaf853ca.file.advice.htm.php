<?php /* Smarty version Smarty-3.1.7, created on 2014-07-12 13:14:22
         compiled from "./templates/property/advice.htm" */ ?>
<?php /*%%SmartyHeaderCode:90652068153c0c42e3eb500-84513311%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4803948cff59c07d84b1f7c475395620aaf853ca' => 
    array (
      0 => './templates/property/advice.htm',
      1 => 1403441759,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '90652068153c0c42e3eb500-84513311',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'act' => 0,
    'status' => 0,
    'log' => 0,
    'l' => 0,
    'advice' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53c0c42e4f237',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c0c42e4f237')) {function content_53c0c42e4f237($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('property/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>



	<div class="col_main">
	  <div class="main_hd">
	    <div class="title_tab">
		  <ul class="tab_navs">
		    <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='default'&&$_smarty_tpl->tpl_vars['status']->value==0){?>class="selected"<?php }?>><a href="/property/advice">待处理</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['status']->value==1){?>class="selected"<?php }?>><a href="/property/advice?status=1">已处理</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['act']->value=="phone"){?>class="selected"<?php }?>><a href="/property/advice?act=phone">投诉建议电话</a></li>
		  </ul>
		</div>
	  </div>
	
<div class="main_content">	 
<?php if ($_smarty_tpl->tpl_vars['act']->value=='default'){?>
<?php if ($_smarty_tpl->tpl_vars['status']->value==0){?>
<?php if (empty($_smarty_tpl->tpl_vars['log']->value['res'])){?>
 <div class="noexisthouseholder">
  <i class="float_l">&nbsp;</i>
  <span class="float_l">暂时还没有业主提出新的投诉/建议！</span>
 </div>
<?php }else{ ?>
 <!-- 绑定数据用于post -->
 <form action="/property/advice" method="post" name="search" enctype="application/x-www-form-urlencoded">
     <input type="hidden" name="page" value="1">
	 <input type="hidden" name="status" value="0">
 </form>
 <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['log']->value['res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value){
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
  <div class="notice_box">
   <div class="l_box">
   <p><span class="color999">发&ensp;起&ensp;人</span>：<?php echo $_smarty_tpl->tpl_vars['l']->value['name'];?>

   <p><span class="color999">发起时间：</span><?php echo $_smarty_tpl->tpl_vars['l']->value['add_time'];?>

   <p><span class="color999">联系电话：</span><?php echo $_smarty_tpl->tpl_vars['l']->value['phone'];?>

   <p>
     <span class="float_l color999">主要内容：</span>
     <span style="width:300px;text-decoration:underline" class="float_l"><?php echo $_smarty_tpl->tpl_vars['l']->value['content'];?>
</span>
   </div>
   <div class="r_box">
    <div id="reply_text_<?php echo $_smarty_tpl->tpl_vars['l']->value['advice_id'];?>
">
	 <a href="javascript:void(0);" onclick="javascript:replyTo(<?php echo $_smarty_tpl->tpl_vars['l']->value['advice_id'];?>
)">点击回复</a>
	</div>
    <div id="reply_act_<?php echo $_smarty_tpl->tpl_vars['l']->value['advice_id'];?>
" style="display:none">
     <p><a href="javascript:void(0);" onclick="javascript:replyTo(<?php echo $_smarty_tpl->tpl_vars['l']->value['advice_id'];?>
)">取消回复：</a><span class="color999">（回复内容请简明扼要，不得多于150个字符）</span>
	 <form action="/property/advice" method="post" enctype="multipart/form-data" id="property_<?php echo $_smarty_tpl->tpl_vars['l']->value['advice_id'];?>
">
	 <p><textarea style="width:330px;height:60px;" class="input" name="reply"></textarea>
	 <div class="clear height5"></div>
     <p>
	 <input type="hidden" name="advice_id" value="<?php echo $_smarty_tpl->tpl_vars['l']->value['advice_id'];?>
">
	 <input type="hidden" name="act" value="reply">
	 <input type="button" class="btn_primary btn_primary_mid" value="确认回复" onclick="javascript:AjaxSubmit('property_<?php echo $_smarty_tpl->tpl_vars['l']->value['advice_id'];?>
');">
     </form>
	</div> 
   </div>
   <div class="clear"></div>
   </div>
 <?php } ?> 
 <div class="clear height10"></div>
 <div class="float_r">
   <?php echo $_smarty_tpl->getSubTemplate ("property/library/page.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

 </div>
 <div class="clear"></div>
 <script type="text/javascript">
 function replyTo(id)
 { 
    var reply_text_id = "reply_text_"+id;
	var reply_act_id = "reply_act_"+id;
	var reply_text_view = document.getElementById(reply_text_id); 
	var reply_act_view = document.getElementById(reply_act_id);
	if(reply_act_view.style.display=="none")
	{
	   reply_text_view.style.display = "none";
	   reply_act_view.style.display = "block";
	}
	else
	{
	   reply_act_view.style.display = "none";
	   reply_text_view.style.display = "block";
	}
 }
 </script> 
 <?php }?>  
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['status']->value>0){?>
<?php if (empty($_smarty_tpl->tpl_vars['log']->value['res'])){?>
 <div class="noexisthouseholder">
  <i class="float_l">&nbsp;</i>
  <span class="float_l">暂时还没有已处理的投诉/建议！</span>
 </div>
<?php }else{ ?>
 <!-- 绑定数据用于post -->
 <form action="/property/advice" method="post" name="search" enctype="application/x-www-form-urlencoded">
     <input type="hidden" name="page" value="1">
	 <input type="hidden" name="status" value="1">
 </form>
 <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['log']->value['res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value){
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
  <div class="notice_box">
   <div class="l_box">
   <p><span class="color999">发&ensp;起&ensp;人</span>：<?php echo $_smarty_tpl->tpl_vars['l']->value['name'];?>

   <p><span class="color999">发起时间：</span><?php echo $_smarty_tpl->tpl_vars['l']->value['add_time'];?>

   <p><span class="color999">联系电话：</span><?php echo $_smarty_tpl->tpl_vars['l']->value['phone'];?>

   <p>
     <span class="float_l color999">主要内容：</span>
     <span style="width:300px;text-decoration:underline" class="float_l"><?php echo $_smarty_tpl->tpl_vars['l']->value['content'];?>
</span>
   </div>
   <div class="r_box" style="text-align:left">
   <?php if ($_smarty_tpl->tpl_vars['l']->value['status']==1){?>	 
   <p><span class="blue">回复时间：</span><?php echo $_smarty_tpl->tpl_vars['l']->value['reply_time'];?>
	 
   <p>
     <span class="float_l blue">回复内容：</span>
     <span style="width:285px;text-decoration:underline" class="float_l"><?php echo $_smarty_tpl->tpl_vars['l']->value['reply'];?>
</span>
   <?php }elseif($_smarty_tpl->tpl_vars['l']->value['status']==2){?>
     <p><span class="blue">（业主已撤销该内容）</span>
   <?php }?>
    
   </div>
   <div class="clear"></div>
   </div>
 <?php } ?> 
 <div class="clear height10"></div>
 <div class="float_r">
   <?php echo $_smarty_tpl->getSubTemplate ("property/library/page.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

 </div>
 <div class="clear"></div>
 <?php }?>
<?php }?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['act']->value=='phone'){?>
 <form action="/property/advice?act=phone" class="form" method="post" id="advice" enctype="multipart/form-data">
<p class="f_title">投诉建议电话：<span class="color999 fontSize12">（业主可见，可为座机号或手机号，支持一键拔打）</span>
<p class="f_content"><input type="text" name="advice_phone" class="input" value="<?php echo $_smarty_tpl->tpl_vars['advice']->value['advice_phone'];?>
" />
<p class="f_title">手机通知：<span class="color999 fontSize12">（若有新的投诉建议，将发短信至该手机，<font color="red">本服务免费</font>）</span>
<p class="f_content"><input type="text" name="advice_mobile" class="input" value="<?php echo $_smarty_tpl->tpl_vars['advice']->value['advice_mobile'];?>
" />
<input type="hidden" name="key" value="change">
<p class="f_title"><input type="button" class="btn_primary" value="确认编辑" onclick="javascript:AjaxSubmit('advice');">
</form>
<?php }?>
</div>

</div><?php }} ?>