<?php /* Smarty version Smarty-3.1.7, created on 2014-07-12 13:14:09
         compiled from "./templates/property/express.htm" */ ?>
<?php /*%%SmartyHeaderCode:186900702553c0c4210160c6-01616966%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e3151a1aadd3618c0d967785718df51f5c26ad1a' => 
    array (
      0 => './templates/property/express.htm',
      1 => 1403441759,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '186900702553c0c4210160c6-01616966',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'act' => 0,
    'status' => 0,
    'keywords' => 0,
    'log' => 0,
    'l' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53c0c42114379',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c0c42114379')) {function content_53c0c42114379($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('property/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>



	<div class="col_main">
	  <div class="main_hd">
	    <div class="title_tab">
		  <ul class="tab_navs">
		    <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='default'){?>class="selected"<?php }?>><a href="/property/express">代收快递查询</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['act']->value=='bind'){?>class="selected"<?php }?>><a href="/property/express?act=bind">上传代收快递信息</a></li>
		  </ul>
		</div>
	  </div>
	
<div class="main_content">	 
 <?php if ($_smarty_tpl->tpl_vars['act']->value=='default'){?>
 <!-- 缴费查询--> 
 <!-- 绑定数据用于post -->
<div class="form_search fontSize12">
<form action="/property/express" method="get" enctype="multipart/form-data" name="search">
 <select name="status" style="padding:0">
  <option value="-1">按领取状态</option>
  <option value="0" <?php if ($_smarty_tpl->tpl_vars['status']->value==0){?>selected<?php }?>>未领取</option>
  <option value="1" <?php if ($_smarty_tpl->tpl_vars['status']->value==1){?>selected<?php }?>>已领取</option>
 </select>&ensp;&ensp;
 收件人姓名/收件人电话/快递单号
 <input type="text" name="keywords" value="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
">&ensp;
 <input type="hidden" name="page" value="1">
 <input type="submit" class="searchbutton" value="搜 索"> 
</form>
</div>
<div class="clear height10"></div>
 <form action="/property/ajax.php" method="post" enctype="multipart/form-data" id="property">
 <table class="info_list" cellspacing="1">
  <tr>
   <th width="30px"></th>
   <th width="120px">收件人姓名</th>
   <th width="120px">收件人电话</th>
   <th width="120px">快递公司</th>
   <th width="150px">快递单号</th>
   <th width="80px">是否领取</th>
   <th>操作</th>
  </tr>
  <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['log']->value['res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value){
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
   <tr>
     <td><input type="checkbox" name="log_id[]" value="<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
"></td>
     <td>
	   <span id="name_text_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['l']->value['name'];?>
</span>
	   <span id="name_input_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
" style="display:none">
	     <input type="text" id="name_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['l']->value['name'];?>
" class="editinput" style="width:110px">
	   </span>
	 </td>
	 <td align="center">
	   <span id="phone_text_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['l']->value['phone'];?>
</span>
	   <span id="phone_input_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
" style="display:none">
	     <input type="text" id="phone_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['l']->value['phone'];?>
" class="editinput" style="width:110px">
	   </span>
	 </td>
	 <td align="center">
	   <span id="express_name_text_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['l']->value['express_name'];?>
</span>
	   <span id="express_name_input_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
" style="display:none">
	     <input type="text" id="express_name_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['l']->value['express_name'];?>
" class="editinput" style="width:110px">
	   </span>
	 </td>
	 <td align="center" class="red">
	   <span id="express_sn_text_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['l']->value['express_sn'];?>
</span>
	   <span id="express_sn_input_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
" style="display:none">
	     <input type="text" id="express_sn_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['l']->value['express_sn'];?>
" class="editinput" style="width:110px">
	   </span>
	 </td>
	 <td align="center">
	   <span id="status_text_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
">
	     <?php if ($_smarty_tpl->tpl_vars['l']->value['status']==1){?><img src="/templates/images/icon/yes.gif"><?php }else{ ?><img src="/templates/images/icon/no.gif"><?php }?>
	   </span>
	   <span id="status_input_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
" style="display:none">
	     <select id="status_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
" style="padding:0">
		   <option value="1" <?php if ($_smarty_tpl->tpl_vars['l']->value['status']==1){?>selected<?php }?>>已领取</option>
		   <option value="0" <?php if ($_smarty_tpl->tpl_vars['l']->value['status']==0){?>selected<?php }?>>未领取</option>
		 </select>
	   </span>
	 <td align="center">
	  <div id="edit_view_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
"> 
	   <a href="javascript:void(0);" onclick="javascript:viewUpdateLog(<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
);">
	     <img src="/templates/images/icon/icon_edit.gif" title="编辑">
	   </a>&ensp;
	   <a href="javascript:void(0);" onclick="javascript:deleteLog(<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
);">
	     <img src="/templates/images/icon/icon_trash.gif" title="删除">
	   </a>
	  </div>
      <div id="edit_act_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
" style="display:none">
	    <input type="button" class="searchbutton" onclick="javascript:doUpdateLog(<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
);" value="确 认">
		<input type="button" class="searchbutton" onclick="javascript:cancelUpdateLog(<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
);" value="取 消">
	  </div>
	 </td>
   </tr>
  <?php } ?>
  <tr height="35px">
    <td colspan="2">
	 <label><input type="checkbox" onclick="javascript:selectAll(this,'log_id[]');"> 全选</label>
	</td>
	<td colspan="5">
	 <select name="act" style="padding:0">
	  <option>请选择操作</option>
	  <option value="deleteLog">删除</option>
	 </select>
	 &ensp;
	 <input type="hidden" name="logType" value="log_express">
	 <input type="button" class="searchbutton" onclick="javascript:AjaxSubmit('property');" value="确  定">
	</td>
  </tr>
  </table>
  </table>
  <div class="clear height10"></div>
  <div class="float_r">
   <?php echo $_smarty_tpl->getSubTemplate ("property/library/page.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

  </div>
  <script type="text/javascript">
  /* 定义编辑操作类 */
  function UpdateLog(id)
  {
     this.edit_view = document.getElementById("edit_view_"+id);
	 this.edit_act = document.getElementById("edit_act_"+id);
	 this.name_text = document.getElementById("name_text_"+id);
	 this.name_input = document.getElementById("name_input_"+id);
	 this.phone_text = document.getElementById("phone_text_"+id);
	 this.phone_input = document.getElementById("phone_input_"+id);
	 this.express_name_text = document.getElementById("express_name_text_"+id);
	 this.express_name_input = document.getElementById("express_name_input_"+id);
	 this.express_sn_text = document.getElementById("express_sn_text_"+id);
	 this.express_sn_input = document.getElementById("express_sn_input_"+id);
	 this.status_text = document.getElementById("status_text_"+id);
	 this.status_input = document.getElementById("status_input_"+id);
	 /* 用于post的值 */
	 this.name = document.getElementById("name_"+id);
	 this.phone = document.getElementById("phone_"+id);
	 this.express_name = document.getElementById("express_name_"+id);
     this.express_sn = document.getElementById("express_sn_"+id);
	 this.status = document.getElementById("status_"+id);
	 
	 /* 显示编辑框、按钮 */
	 this.viewUpdateLog = function() {
	   this.edit_view.style.display="none";
	   this.edit_act.style.display="block"; 
	   this.name_text.style.display="none";
	   this.name_input.style.display="block";
	   this.phone_text.style.display="none";
	   this.phone_input.style.display="block";
	   this.express_name_text.style.display="none";
	   this.express_name_input.style.display="block";
	   this.express_sn_text.style.display="none";
	   this.express_sn_input.style.display="block";
	   this.status_text.style.display="none";
	   this.status_input.style.display="block";
	 }
	 /* 取消编辑 */
	 this.cancelUpdateLog = function() { 
	   this.edit_view.style.display="block";
	   this.edit_act.style.display="none"; 
	   this.name_text.style.display="block";
	   this.name_input.style.display="none";
	   this.phone_text.style.display="block";
	   this.phone_input.style.display="none";
	   this.express_name_text.style.display="block";
	   this.express_name_input.style.display="none";
	   this.express_sn_text.style.display="block";
	   this.express_sn_input.style.display="none";
	   this.status_text.style.display="block";
	   this.status_input.style.display="none";
	 }
	 /* 提交编辑 */
	 this.doUpdateLog = function() {
	   $.post("/property/express", {
	                      act:'update', log_id: id, name: this.name.value, phone: this.phone.value, express_name: this.express_name.value, express_sn: this.express_sn.value, status: this.status.value },
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
	 /* 删除单条信息 */
	 this.deleteLog = function() { 
	   $.post("/property/ajax.php", {
	                      act:'deleteLog', log_id: [id], logType: 'log_express' },
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
  /* 删除单条记录 */
  function deleteLog(id)
  { 
     var updateproprety = new UpdateLog(id);
	 updateproprety.deleteLog(); 
  }
  </script>
 <?php }?>
 <?php if ($_smarty_tpl->tpl_vars['act']->value=='bind'){?>
 <link rel="stylesheet" href="/includes/kindeditor/themes/default/default.css">
 <script type="text/javascript" src="/includes/kindeditor/kindeditor-min.js"></script>
 <script type="text/javascript" src="/includes/kindeditor/lang/zh_CN.js"></script> 
 <script type="text/javascript">
			KindEditor.ready(function(K) {
				var editor = K.editor({
					allowFileManager : false,
					uploadJson : '/property/express?act=act_bind'
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
 &ensp; <a href="/data/excel/kuaidi.rar"><span class="red" style="text-decoration:underline">下载代收快递示例表格</span></a>
 <?php }?>
</div>

</div><?php }} ?>