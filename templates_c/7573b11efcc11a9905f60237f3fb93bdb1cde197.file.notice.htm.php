<?php /* Smarty version Smarty-3.1.7, created on 2014-07-17 16:21:07
         compiled from "./templates/represent/notice.htm" */ ?>
<?php /*%%SmartyHeaderCode:175424004753c787738c4544-74808922%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7573b11efcc11a9905f60237f3fb93bdb1cde197' => 
    array (
      0 => './templates/represent/notice.htm',
      1 => 1403441759,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '175424004753c787738c4544-74808922',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'act' => 0,
    'log' => 0,
    'l' => 0,
    'notice' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53c7877397a6a',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c7877397a6a')) {function content_53c7877397a6a($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('represent/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>



	<div class="col_main">
	  <div class="main_hd">
	    <div class="title_tab">
		  <ul class="tab_navs">
		    <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='default'){?>class="selected"<?php }?>><a href="/represent/notice">发新通知</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['act']->value=='log'||$_smarty_tpl->tpl_vars['act']->value=='preview'){?>class="selected"<?php }?>><a href="/represent/notice?act=log">通知记录</a></li>
		  </ul>
		</div>
	  </div>
	
<div class="main_content">	 
<?php if ($_smarty_tpl->tpl_vars['act']->value=='default'){?>
  <!-- 发新通知 -->
  <script type="text/javascript" src="/includes/kindeditor/kindeditor-min.js"></script>
  <script type="text/javascript" src="/includes/kindeditor/lang/zh_CN.js"></script> 
  <script type="text/javascript">
	  var editor;
	  KindEditor.ready(function(K) {
		editor = K.create('textarea[name="content"]', {
			resizeType : 1,	
			afterChange : function() 
			              {
                            this.sync();
                          },
			afterBlur : function()
			            {
                          this.sync();
                        } ,
			cssPath : '/includes/kindeditor/fontSize.css',
			allowImageUpload : true ,
			uploadJson : '/uploadimg.php?act=notice',
		 	items : ['image','fontsize','bold','forecolor', 'hilitecolor','italic', 'underline', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist','insertunorderedlist']
		});
	  });
  </script>
  <form action="/represent/notice" id="notice" method="post" enctype="multipart/form-data" class="form">
  <p class="f_title">通知标题：<span class="color999 fontSize12">（标题不多于32个字符）</span>
  <p class="f_content"><input type="text" name="title" class="input">
  <p class="f_title">通知详情：<span class="color999 fontSize12">（这里输入通知内容，可上传图片）</span>
  <p class="f_content"><textarea name="content" style="width:100%;height:170px"></textarea>
  <p class="f_content"><span class="float_r red" style="display:none">注：每月能免费发送 4 条通知</span>
  <input type="hidden" name="act" value="send_notice">
  <input type="button" class="btn_primary" value="发通知" onclick="javascript:AjaxSubmit('notice');">
  </form>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['act']->value=='log'){?> 
<?php if (empty($_smarty_tpl->tpl_vars['log']->value['res'])){?>
 <div class="noexisthouseholder">
  <i class="float_l">&nbsp;</i>
  <span class="float_l">你还没有发送过通知或已清除通知记录！</span>
 </div>
<?php }else{ ?>
 <!-- 绑定数据用于post -->
 <form action="/represent/notice" method="post" name="search" enctype="application/x-www-form-urlencoded">
   <input type="hidden" name="page" value="1">
   <input type="hidden" name="act" value="log">
 </form>
 <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['log']->value['res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value){
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
  <div class="notice_box">
   <div class="l_box">
   <h2><a href="/represent/notice?act=preview&notice_id=<?php echo $_smarty_tpl->tpl_vars['l']->value['notice_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['l']->value['title'];?>
</a></h2> 
   <a href="/represent/notice?act=preview&notice_id=<?php echo $_smarty_tpl->tpl_vars['l']->value['notice_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['l']->value['summary'];?>
</a>
   </div>
   <div class="m_box">
     <span class="color999"><?php echo $_smarty_tpl->tpl_vars['l']->value['add_time'];?>
</span>
   </div>
   <div class="m_box">
     <a href="/represent/notice?act=delete&notice_id=<?php echo $_smarty_tpl->tpl_vars['l']->value['notice_id'];?>
">点击删除</a>
   </div>
   <div class="clear"></div>
   </div>
 <?php } ?> 
 <div class="clear height10"></div>
 <div class="float_r">
   <?php echo $_smarty_tpl->getSubTemplate ("represent/library/page.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

 </div>
 <?php }?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['act']->value=='preview'){?>
<style type="text/css">
.preview{
width: 380px;
height: 744px;
margin: 0 auto;
background: url(/templates/images/iphone.png) 0 0 no-repeat;
border:1px solid #fff; /* 不加加框布局会乱 */
}
.preview .p_content{
width:300px;height:460px;padding:10px;background-color: #F0EFEF;margin:133px 0 0 32px;overflow-y:scroll;overflow-x:hidden;
}
.preview .p_content h2{
color: #555;
text-align: left;
font-weight: bold;
font-size: 20px;
}
.preview .p_content hr{
margin:7px 0;
}
.preview .p_content .updatetime {
font-size: 12px;
color: #999;
}
.preview .p_content .p_content_box{
padding:10px 0;
line-height: 180%;
}
.preview .p_content .p_content_box img{
max-width:283px;
}
</style>
<div class="preview">
<div class="p_content">
 <h2><?php echo $_smarty_tpl->tpl_vars['notice']->value['title'];?>
</h2>
 <hr>
 <div class="updatetime"><?php echo $_smarty_tpl->tpl_vars['notice']->value['add_time'];?>
</div>
 <div class="p_content_box">
   <?php echo $_smarty_tpl->tpl_vars['notice']->value['content'];?>

 </div>
</div>
</div>
<div class="clear height20"></div>
<div style="width:382px;height:50px;margin:0 auto">
  <input type="button" class="btn_primary" onclick="javascript:history.go(-1);"  value="返回上一页"  style="width:382px;height:50px">
</div>
<?php }?>
</div>


</div><?php }} ?>