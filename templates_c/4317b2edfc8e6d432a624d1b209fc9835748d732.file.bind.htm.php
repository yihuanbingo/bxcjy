<?php /* Smarty version Smarty-3.1.7, created on 2014-07-14 09:19:28
         compiled from "./templates/property/bind.htm" */ ?>
<?php /*%%SmartyHeaderCode:112356995253c3302030e319-96730949%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4317b2edfc8e6d432a624d1b209fc9835748d732' => 
    array (
      0 => './templates/property/bind.htm',
      1 => 1403441759,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '112356995253c3302030e319-96730949',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'act' => 0,
    'is_bind' => 0,
    'keywords' => 0,
    'householder' => 0,
    'h' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53c330203f3f4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c330203f3f4')) {function content_53c330203f3f4($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('property/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>



	<div class="col_main">
	  <div class="main_hd">
	    <div class="title_tab">
		  <ul class="tab_navs">
		    <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='default'){?>class="selected"<?php }?>><a href="/property/bind">业主列表</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['act']->value=='bind'){?>class="selected"<?php }?>><a href="/property/bind?act=bind">上传业主资料</a></li>
		  </ul>
		</div>
	  </div>
	
<div class="main_content">	 
 <?php if ($_smarty_tpl->tpl_vars['act']->value=='default'){?>
 <!-- 业主列表 --> 
 <!-- 绑定数据用于post -->
<div class="form_search fontSize12">
<form action="/property/bind" method="get" enctype="multipart/form-data" name="search">
 <select name="is_bind" style="padding:0">
  <option value="-1">按绑定状态</option>
  <option value="1" <?php if ($_smarty_tpl->tpl_vars['is_bind']->value==1){?>selected<?php }?>>已绑定</option>
  <option value="0" <?php if ($_smarty_tpl->tpl_vars['is_bind']->value==0){?>selected<?php }?>>未绑定</option>
 </select>&ensp;&ensp;
 房号/业主姓名/手机号
 <input type="text" name="keywords" value="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
">&ensp;
 <input type="hidden" name="page" value="1">
 <input type="submit" class="searchbutton" value="搜 索"> 
</form>
</div>
<div class="clear height10"></div>
 <table class="info_list" cellspacing="1">
  <tr>
   <th width="120px">房号</th>
   <th width="120px">业主姓名</th>
   <th width="150px">手机号</th>
   <th width="100px">绑定码</th>
   <th width="80px">绑定状态</th>
   <th>操作</th>
  </tr>
  <?php  $_smarty_tpl->tpl_vars['h'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['h']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['householder']->value['res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['h']->key => $_smarty_tpl->tpl_vars['h']->value){
$_smarty_tpl->tpl_vars['h']->_loop = true;
?>
   <tr>
    <td align="center"><?php echo $_smarty_tpl->tpl_vars['h']->value['house_number'];?>
</td> 
	<td align="center">
	  <span id="house_owner_text_<?php echo $_smarty_tpl->tpl_vars['h']->value['householder_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['h']->value['house_owner'];?>
</span>
	  <span id="house_owner_input_<?php echo $_smarty_tpl->tpl_vars['h']->value['householder_id'];?>
" style="display:none">
	    <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['h']->value['house_owner'];?>
" class="editinput" id="house_owner_<?php echo $_smarty_tpl->tpl_vars['h']->value['householder_id'];?>
" style="width:110px">
	  </span>
	</td> 
	<td align="center">
	  <span id="mobile_text_<?php echo $_smarty_tpl->tpl_vars['h']->value['householder_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['h']->value['mobile'];?>
</span>
	  <span id="mobile_input_<?php echo $_smarty_tpl->tpl_vars['h']->value['householder_id'];?>
" style="display:none">
	    <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['h']->value['mobile'];?>
" class="editinput" id="mobile_<?php echo $_smarty_tpl->tpl_vars['h']->value['householder_id'];?>
" style="width:110px">
	  </span>
	</td> 
	<td align="center"><?php echo $_smarty_tpl->tpl_vars['h']->value['bind_code'];?>
</td> 
	<td align="center">
	 <?php if ($_smarty_tpl->tpl_vars['h']->value['is_bind']>0){?><img src="/templates/images/icon/yes.gif"><?php }else{ ?><img src="/templates/images/icon/no.gif"><?php }?>
	</td>
	<td align="center">
	  <div id="edit_view_<?php echo $_smarty_tpl->tpl_vars['h']->value['householder_id'];?>
"> 
	   <a href="javascript:void(0);" onclick="javascript:viewUpdateLog(<?php echo $_smarty_tpl->tpl_vars['h']->value['householder_id'];?>
);">
	     <img src="/templates/images/icon/icon_edit.gif" title="编辑">
	   </a>
	  </div>
      <div id="edit_act_<?php echo $_smarty_tpl->tpl_vars['h']->value['householder_id'];?>
" style="display:none">
	    <input type="button" class="searchbutton" onclick="javascript:doUpdateLog(<?php echo $_smarty_tpl->tpl_vars['h']->value['householder_id'];?>
);" value="确 认">
		<input type="button" class="searchbutton" onclick="javascript:cancelUpdateLog(<?php echo $_smarty_tpl->tpl_vars['h']->value['householder_id'];?>
);" value="取 消">
	  </div>
	</td>
   </tr>
  <?php } ?>
  </table>
  <div class="clear height10"></div>
  <div class="float_r">
   <?php echo $_smarty_tpl->getSubTemplate ("property/library/page.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

  </div>
  <div class="clear"></div>
  <script type="text/javascript">
  /* 定义编辑操作类 */
  function UpdateLog(id)
  {
     this.edit_view = document.getElementById("edit_view_"+id);
	 this.edit_act = document.getElementById("edit_act_"+id);
	 this.house_owner_text = document.getElementById("house_owner_text_"+id);
	 this.house_owner_input = document.getElementById("house_owner_input_"+id);
     this.mobile_text = document.getElementById("mobile_text_"+id);
	 this.mobile_input = document.getElementById("mobile_input_"+id);
	 this.house_owner = document.getElementById("house_owner_"+id);
	 this.mobile = document.getElementById("mobile_"+id);
	
	 /* 显示编辑框、按钮 */
	 this.viewUpdateLog = function() {
	   this.edit_view.style.display="none";
	   this.edit_act.style.display="block"; 
	   this.house_owner_text.style.display="none";
	   this.house_owner_input.style.display="block";
	   this.mobile_text.style.display="none";
	   this.mobile_input.style.display="block";
	 }
	 /* 取消编辑 */
	 this.cancelUpdateLog = function() { 
	   this.edit_view.style.display="block";
	   this.edit_act.style.display="none"; 
	   this.house_owner_text.style.display="block";
	   this.house_owner_input.style.display="none";
	   this.mobile_text.style.display="block";
	   this.mobile_input.style.display="none";
	 }
	 /* 提交编辑 */
	 this.doUpdateLog = function() {
	   $.post("/property/bind", {
	                      act:'update', householder_id: id, house_owner: this.house_owner.value, mobile: this.mobile.value },
       function(data)
       {
	    var data = json_decode(data);
	    if(data.error==0)
	    {
		  alertMsg(data.data);
		  setTimeout("window.location.reload();",1000);
	    }
	    if(data.error==1)
	    {
	      /* 弹出错误提示 */
		  alertMsg(data.data);
	    }
       });	
	 }
  }
  /* 显示编辑框、按钮 */
  function viewUpdateLog(id)
  {
     var updateproprety = new UpdateLog(id);
	 updateproprety.viewUpdateLog();
  }
  /* 取消编辑 */
  function cancelUpdateLog(id)
  {
     var updateproprety = new UpdateLog(id);
	 updateproprety.cancelUpdateLog();
  }
  /* 提交编辑 */
  function doUpdateLog(id)
  {
     var updateproprety = new UpdateLog(id);
	 updateproprety.doUpdateLog(); 
  }
  </script>
 <?php }?>
 <?php if ($_smarty_tpl->tpl_vars['act']->value=='bind'){?>
 <!-- 绑定业主 -->
 <link rel="stylesheet" href="/includes/kindeditor/themes/default/default.css">
 <script type="text/javascript" src="/includes/kindeditor/kindeditor-min.js"></script>
 <script type="text/javascript" src="/includes/kindeditor/lang/zh_CN.js"></script> 
 <script type="text/javascript">
			KindEditor.ready(function(K) {
				var editor = K.editor({
					allowFileManager : false,
					uploadJson : '/property/bind?act=act_bind'
				});
				K('#insertfile').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							showRemote : false,
							clickFn : function(url, title, width, height, border, align) 
							{
							    window.location.href = url;
							}
						});
					});
				});
			});
 </script>
 <input type="button" class="btn_primary"  id="insertfile" value="上传excel文件">
 &ensp; <a href="/data/excel/yezhu.rar"><span class="red" style="text-decoration:underline">下载业主信息示例表格</span></a>
 <?php }?>
</div>

</div><?php }} ?>