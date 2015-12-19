<?php /* Smarty version Smarty-3.1.7, created on 2014-07-12 13:14:23
         compiled from "./templates/property/askrepair.htm" */ ?>
<?php /*%%SmartyHeaderCode:121102861553c0c42f85f0f5-08741175%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '43da92ad13da8994ff36ad728c345a7a3fc6eab1' => 
    array (
      0 => './templates/property/askrepair.htm',
      1 => 1403441759,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '121102861553c0c42f85f0f5-08741175',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'status' => 0,
    'act' => 0,
    'log' => 0,
    'l' => 0,
    'repair' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53c0c42f972ab',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c0c42f972ab')) {function content_53c0c42f972ab($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('property/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>



	<div class="col_main">
	  <div class="main_hd">
	    <div class="title_tab">
		  <ul class="tab_navs">
		    <li <?php if ($_smarty_tpl->tpl_vars['status']->value==0&&$_smarty_tpl->tpl_vars['act']->value=="default"){?>class="selected"<?php }?>><a href="/property/askrepair">待受理</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['status']->value==1){?>class="selected"<?php }?>><a href="/property/askrepair?status=1">已完成</a></li>
            <li <?php if ($_smarty_tpl->tpl_vars['act']->value=="phone"){?>class="selected"<?php }?>><a href="/property/askrepair?act=phone">报修电话</a></li>
		  </ul>
		</div>
	  </div>
	
<div class="main_content">	 
<?php if ($_smarty_tpl->tpl_vars['act']->value=="default"){?>
<?php if ($_smarty_tpl->tpl_vars['status']->value==0){?>
<?php if (empty($_smarty_tpl->tpl_vars['log']->value['res'])){?>
 <div class="noexisthouseholder">
  <i class="float_l">&nbsp;</i>
  <span class="float_l">暂时还没有业主提出新的报修申请！</span>
 </div>
<?php }else{ ?>
 <!-- 绑定数据用于post -->
 <form action="/property/askrepair" method="post" name="search" enctype="application/x-www-form-urlencoded">
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
   <p><span class="color999">报&ensp;修&ensp;人</span>：<?php echo $_smarty_tpl->tpl_vars['l']->value['name'];?>

   <p><span class="color999">报修时间：</span><?php echo $_smarty_tpl->tpl_vars['l']->value['add_time'];?>

   <p><span class="color999">联系电话：</span><?php echo $_smarty_tpl->tpl_vars['l']->value['phone'];?>

   <p>
     <span class="float_l color999">报修内容：</span>
     <span style="width:300px;text-decoration:underline" class="float_l"><?php echo $_smarty_tpl->tpl_vars['l']->value['content'];?>
</span>
   </div>
   <div class="r_box">
    <div id="reply_text_<?php echo $_smarty_tpl->tpl_vars['l']->value['ask_id'];?>
">
	 <a href="javascript:void(0);" onclick="javascript:replyTo(<?php echo $_smarty_tpl->tpl_vars['l']->value['ask_id'];?>
)">点击回复</a>
	</div>
    <div id="reply_act_<?php echo $_smarty_tpl->tpl_vars['l']->value['ask_id'];?>
" style="display:none">
     <p><a href="javascript:void(0);" onclick="javascript:replyTo(<?php echo $_smarty_tpl->tpl_vars['l']->value['ask_id'];?>
)">取消回复：</a><span class="color999">（回复内容请简明扼要，不得多于150个字符）</span>
	 <form action="/property/askrepair" method="post" enctype="multipart/form-data" id="property_<?php echo $_smarty_tpl->tpl_vars['l']->value['ask_id'];?>
">
	 <p><textarea style="width:330px;height:60px;" class="input" name="reply"></textarea>
	 <div class="clear height5"></div>
     <p>
	 <input type="hidden" name="ask_id" value="<?php echo $_smarty_tpl->tpl_vars['l']->value['ask_id'];?>
">
	 <input type="hidden" name="act" value="reply">
	 <input type="button" class="btn_primary btn_primary_mid" value="确认回复" onclick="javascript:AjaxSubmit('property_<?php echo $_smarty_tpl->tpl_vars['l']->value['ask_id'];?>
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
  <span class="float_l">暂时还没有已完成的报修申请！</span>
 </div>
<?php }else{ ?>
 <!-- 绑定数据用于post -->
 <form action="/property/askrepair" method="post" name="search" enctype="application/x-www-form-urlencoded">
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
   <p><span class="color999">报&ensp;修&ensp;人</span>：<?php echo $_smarty_tpl->tpl_vars['l']->value['name'];?>

   <p><span class="color999">报修时间：</span><?php echo $_smarty_tpl->tpl_vars['l']->value['add_time'];?>

   <p><span class="color999">联系电话：</span><?php echo $_smarty_tpl->tpl_vars['l']->value['phone'];?>

   <p>
     <span class="float_l color999">报修内容：</span>
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
     <p><span class="blue">（业主已撤销该报修）</span>
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
<?php if ($_smarty_tpl->tpl_vars['act']->value=="phone"){?>
<form action="/property/askrepair?act=phone" class="form" method="post" id="repair" enctype="multipart/form-data">
<p class="f_title">报修电话：<span class="color999 fontSize12">（业主可见，可为座机号或手机号，支持一键拔打）</span>
<p class="f_content"><input type="text" name="repair_phone" class="input" value="<?php echo $_smarty_tpl->tpl_vars['repair']->value['repair_phone'];?>
" />
<p class="f_title">手机通知：<span class="color999 fontSize12">（若有新的报修申请，将发短信至该手机，<font color="red">本服务免费</font>）</span>
<p class="f_content"><input type="text" name="repair_mobile" class="input" value="<?php echo $_smarty_tpl->tpl_vars['repair']->value['repair_mobile'];?>
" />
<input type="hidden" name="key" value="change">
<p class="f_title"><input type="button" class="btn_primary" value="确认编辑" onclick="javascript:AjaxSubmit('repair');">
</form>
<?php }?>
</div>

</div><?php }} ?>