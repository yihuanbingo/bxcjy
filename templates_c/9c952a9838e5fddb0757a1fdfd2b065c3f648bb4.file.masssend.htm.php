<?php /* Smarty version Smarty-3.1.7, created on 2016-01-07 20:56:21
         compiled from ".\templates\admin\masssend.htm" */ ?>
<?php /*%%SmartyHeaderCode:8908566c4dcfc4a0c3-60561842%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9c952a9838e5fddb0757a1fdfd2b065c3f648bb4' => 
    array (
      0 => '.\\templates\\admin\\masssend.htm',
      1 => 1450618919,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8908566c4dcfc4a0c3-60561842',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_566c4dd25b707',
  'variables' => 
  array (
    'act' => 0,
    'res' => 0,
    'r' => 0,
    'msg' => 0,
    'gid' => 0,
    'list' => 0,
    'k' => 0,
    'desc' => 0,
    'pics' => 0,
    'p' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_566c4dd25b707')) {function content_566c4dd25b707($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('admin/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>



	<div class="col_main">
	  <div class="main_hd">
	    <div class="title_tab">
		  <ul class="tab_navs">
		    <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='send'||$_smarty_tpl->tpl_vars['act']->value=='act_send'){?>class="selected"<?php }?>><a href="/admin/masssend.php">群发管理</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['act']->value=='material'){?>class="selected"<?php }?>><a href="/admin/masssend.php?act=material">图文信息</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['act']->value=='picture'){?>class="selected"<?php }?>><a href="/admin/masssend.php?act=picture">图片素材</a></li>
		  </ul>
		</div>
	  </div>

<div class="main_content">
 <!-- 群发操作 -->	 
 <?php if ($_smarty_tpl->tpl_vars['act']->value=='send'){?>
  <script type="text/javascript" src="/templates/js/DateDetailPicker.js"></script>
  <form action="/admin/masssend.php?act=act_send" class="form" id="text" method="post" enctype="multipart/form-data">
   <p class="f_title">图文ID：<span class="color999">（多图文消息请用-分隔，如1-2-3，则第1张为首图）</span></p>
   <p class="f_content"><input type="text" class="input" name="articles"></p>
   <p class="f_title">选择小区：<span class="color999">（可以向指定小区推送）</span></p>
   <p class="f_content"><select name="community_id">
    <option value="0">向所有小区</option>
    <?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['res']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['r']->value['community_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['r']->value['community_name'];?>
</option><?php } ?>
	</select></p>
   <p class="f_title">筛选时间：<span class="color999">（可以对某时间之后关注的用户发送）</span></p>
   <p class="f_content"><input type="text" name="sendtime" class="input" onclick="fPopCalendar(event,this,this)" onfocus="this.select()" readonly="readonly" value="1970-01-01"></p> 
   <input type="submit" class="btn_primary" value="确认提交">
  </form>
 <?php }?>
 <!-- 群发已执行 -->
 <?php if ($_smarty_tpl->tpl_vars['act']->value=='act_send'){?>
   <?php if ($_smarty_tpl->tpl_vars['msg']->value['error']==1){?>
    错误提示：<font color="red"><?php echo $_smarty_tpl->tpl_vars['msg']->value['data'];?>
</font>
   <?php }else{ ?>
    <?php echo $_smarty_tpl->tpl_vars['msg']->value['data'];?>

   <?php }?>
 <?php }?>
 <!-- 素材管理 -->
 <?php if ($_smarty_tpl->tpl_vars['act']->value=='material'){?>
  <!-- 显示图文列表 -->
  <?php if ($_smarty_tpl->tpl_vars['gid']->value==='list'){?>
   <style type="text/css">
    .wxinner{
	width:259px;
	height:150px;
	float:left;
	padding-left:80px;
	border:3px dashed #b8b8b8;
	border-radius:5px;
	}
	.wxinner a:hover{
	text-decoration:underline;
	}
	.wxinner .innerbox{
	width:70px;
	text-align:center;
	float:left;
	margin:40px 10px;
	}
	.wxinner .innerbox .singlebg{
	width:50px;
	height:56px;
	margin:0 auto;
	background:url(https://res.wx.qq.com/mpres/zh_CN/htmledition/comm_htmledition/style/page/media/media_list_z1e6be4.png) 0 0 no-repeat;
	}
	.wxinner .innerbox .manybg{
	width:50px;
	height:56px;
	margin:0 auto;
	background:url(https://res.wx.qq.com/mpres/zh_CN/htmledition/comm_htmledition/style/page/media/media_list_z1e6be4.png) 0 -133px no-repeat;
	}
   </style>
   <div class="wxinner">
    <div class="innerbox">
	 <a href="/admin/masssend.php?act=material&type=many&gid=0">
	 <div class="manybg"></div>
	 多图文信息
	 </a>
	</div>
    <div class="innerbox">
	 <a href="/admin/masssend.php?act=material&type=single&gid=0">
	 <div class="singlebg"></div>
	 单图文信息
	 </a>
	</div>
   </div>
   <?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list']->value['res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['r']->key;
?>
    <div class="wxinner" style="width:323px;height:auto;border:1px solid #d3d3d3;padding:10px;<?php if ($_smarty_tpl->tpl_vars['k']->value%2==0){?>float:right;margin-bottom:20px;<?php }else{ ?>margin-top:20px;<?php }?>">
	 <h3><?php echo $_smarty_tpl->tpl_vars['r']->value['title'];?>
</h3>
	 <div><?php echo date('m-d',$_smarty_tpl->tpl_vars['r']->value['created_at']);?>
</div>
     <img src="<?php echo $_smarty_tpl->tpl_vars['r']->value['thumb'];?>
" width="314" height="175" style="margin:10px 0">
     <?php echo $_smarty_tpl->tpl_vars['r']->value['digest'];?>

	 <div style="margin:10px -10px -10px;padding:0 10px;height:40px;background:#f4f4f4;border-top:1px solid #d3d3d3;line-height:40px;font-size:18px">
	  <div class="float_l">单图文ID：<?php echo $_smarty_tpl->tpl_vars['r']->value['gid'];?>
</div>
	  <div class="float_r"><a href="/admin/masssend.php?act=material&type=single&gid=<?php echo $_smarty_tpl->tpl_vars['r']->value['gid'];?>
">编辑</a> &ensp; 
	   <a href="">删除</a></div>
	 </div>
	</div>
   <?php } ?>
  <!-- 添加、编辑图文 -->
  <?php }else{ ?>
   <style type="text/css">
    .leftview{
	width:300px;
	padding:10px;
	float:left;
	margin-right:10px;
	border:1px solid #d3d3d3;
	border-radius:5px;
	font-size:14px;
	}
	.leftview .wxcover{
	height:160px;margin:10px 0;background:#ececec;text-align:center;font-size:22px;line-height:160px;color:#c0c0c0
	}
	.rightaction{
	width:425px;
	padding-left:11px;
	float:right;
	position: relative;
	}
	.rightaction .wxarrow_out{
	display: inline-block;
width: 0;
height: 0;
border-width: 12px;
border-style: dashed;
border-color: transparent;
border-left-width: 0;
border-right-color: #d3d3d3;
border-right-style: solid;
top: 44px;
left: 0;
position: absolute;
margin-top:0;
	}
	.rightaction .wxarrow_in{
	display: inline-block;
	position:absolute;
	margin-top:0;
    width: 0; 
    height: 0;
    border-width: 12px;
    border-style: dashed;
    border-color: transparent;
    border-left-width: 0;
    border-right-color: #f8f8f8;
    border-right-style: solid;
    top: 44px;
    left: 1px;
	}
	.rightaction .wxaction{
	padding:20px;
border: 1px solid #d3d3d3;
background-color: #f8f8f8;
border-radius: 3px;
box-shadow: inset 0 1px 1px 0 #fff;
min-height:300px;
	}
   </style>
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
			uploadJson : '/uploadimg.php?act=info',
		 	items : ['image','fontsize','bold','forecolor', 'hilitecolor','italic', 'underline', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist','insertunorderedlist']
		});
	  });
      </script>
   <div class="leftview">
    <h3><?php if (empty($_smarty_tpl->tpl_vars['desc']->value)){?>这是标题<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['desc']->value['title'];?>
<?php }?></h3>
	<div class="wxcover">
	 <?php if (empty($_smarty_tpl->tpl_vars['desc']->value)){?>封面图片<?php }else{ ?><img src="<?php echo $_smarty_tpl->tpl_vars['desc']->value['thumb'];?>
" width="300" height="160px"><?php }?>
	</div>
	 <?php if (empty($_smarty_tpl->tpl_vars['desc']->value)){?>这里显示摘要<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['desc']->value['digest'];?>
<?php }?>
   </div>
   <div class="rightaction">
    <i class="wxarrow_out"></i>
    <i class="wxarrow_in"></i>
	<div class="wxaction">
	 <form action="/admin/masssend.php?act=act_material" method="post" class="form" id="masssend" enctype="multipart/form-data">
	  <p class="f_title">标题</p>
	  <p class="f_content"><input type="text" class="input" name="title" value="<?php echo $_smarty_tpl->tpl_vars['desc']->value['title'];?>
"></p>
	  <p class="f_title">作者<span class="color999">（选填）</span></p>
	  <p class="f_content"><input type="text" class="input" name="author" value="<?php echo $_smarty_tpl->tpl_vars['desc']->value['author'];?>
"></p>
	  <p class="f_title">封面<span class="color999">（填入图片素材中的图片ID）</span></p>
	  <p class="f_content"><input type="text" class="input" name="thumb_media_id" value="<?php echo $_smarty_tpl->tpl_vars['desc']->value['thumb_media_id'];?>
"></p>
	  <p class="f_title">摘要</p>
	  <p class="f_content"><textarea class="input" name="digest" style="height:80px"><?php echo $_smarty_tpl->tpl_vars['desc']->value['digest'];?>
</textarea></p>
	  <p class="f_title">正文</p>
	  <p class="f_content"><textarea class="input" name="content" style="height:300px"><?php echo $_smarty_tpl->tpl_vars['desc']->value['content'];?>
</textarea></p>
	  <p class="f_title">原文链接<span class="color999">（选填）</span></p>
	  <p class="f_content"><input type="text" class="input" name="content_source_url" value="<?php echo $_smarty_tpl->tpl_vars['desc']->value['content_source_url'];?>
"></p>
	  <input type="hidden" name="gid" value="<?php echo $_smarty_tpl->tpl_vars['desc']->value['gid'];?>
">
	  <input type="button" class="btn_primary" value="确认提交" onclick="javascript:AjaxSubmit('masssend');">
	 </form>
	</div>
   </div>
   <div class="clear"></div>
  <?php }?>
 <?php }?>
 <?php if ($_smarty_tpl->tpl_vars['act']->value=='picture'){?>
 <link rel="stylesheet" href="/includes/kindeditor/themes/default/default.css">
 <script type="text/javascript" src="/includes/kindeditor/kindeditor-min.js"></script>
 <script type="text/javascript" src="/includes/kindeditor/lang/zh_CN.js"></script> 
 <script type="text/javascript">
			KindEditor.ready(function(K) {
				var editor = K.editor({
					allowFileManager : false,
					uploadJson : '/admin/masssend.php?act=act_picture'
				});
				K('#masssend').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							showRemote : false,
							clickFn : function(url, title, width, height, border, align) 
							{
							    window.location.reload();
							}
						});
					});
				});
			});
 </script>
 <input type="button" id="masssend" class="btn_primary" value="添加图片">
 <span class="color999">（图片须小于64KB，多图文第一张图为360*200，其他为200*200）</span>
 <div class="clear height10"></div>
 <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pics']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value){
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
   <div class="fontSize12" style="padding:10px 0;border-top:1px solid #ccc">
    <img src="<?php echo $_smarty_tpl->tpl_vars['p']->value['src'];?>
" height="100" class="float_l">	
    <div style="float:right;margin-top:10px">
	 <form action="/admin/masssend.php" method="post" enctype="multipart/form-data" id="massrefresh_<?php echo $_smarty_tpl->tpl_vars['p']->value['pid'];?>
">
	  <input type="hidden" name="act" value="refresh">
	  <input type="hidden" name="pid" value="<?php echo $_smarty_tpl->tpl_vars['p']->value['pid'];?>
">
	  <input type="button" class="btn_primary" onclick="javascript:AjaxSubmit('massrefresh_<?php echo $_smarty_tpl->tpl_vars['p']->value['pid'];?>
');" value="刷 新">
	 </form>	 
	 <div class="clear height5"></div>
	 <form action="/admin/masssend.php" method="post" enctype="multipart/form-data" id="massdelete_<?php echo $_smarty_tpl->tpl_vars['p']->value['pid'];?>
">
	  <input type="hidden" name="act" value="delete">
	  <input type="hidden" name="pid" value="<?php echo $_smarty_tpl->tpl_vars['p']->value['pid'];?>
">
	  <input type="button" class="btn_primary" onclick="javascript:AjaxSubmit('massdelete_<?php echo $_smarty_tpl->tpl_vars['p']->value['pid'];?>
');" value="删 除">
	 </form>
    </div>
	<div style="float:right;width:380px;margin-right:10px;margin-top:10px">
	   过期时间：<?php echo $_smarty_tpl->tpl_vars['p']->value['created_at'];?>
<br>
	  <?php if ($_smarty_tpl->tpl_vars['p']->value['overdue']){?><span class="red">已过期，使用前请刷新</span><?php }else{ ?>图片ID：<input type="text" class="input" value="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumb_media_id'];?>
"><?php }?>
	</div>
	<div class="clear"></div>
   </div>	
 <?php } ?>
 <?php }?>
</div>

</div>
<?php }} ?>