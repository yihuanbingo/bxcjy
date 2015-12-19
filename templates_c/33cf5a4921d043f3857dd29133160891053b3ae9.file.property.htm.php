<?php /* Smarty version Smarty-3.1.7, created on 2014-07-12 13:14:11
         compiled from "./templates/property/property.htm" */ ?>
<?php /*%%SmartyHeaderCode:176708958853c0c4238bb259-24964449%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '33cf5a4921d043f3857dd29133160891053b3ae9' => 
    array (
      0 => './templates/property/property.htm',
      1 => 1403441759,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '176708958853c0c4238bb259-24964449',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'act' => 0,
    'pay_late' => 0,
    'status' => 0,
    'keywords' => 0,
    'log' => 0,
    'l' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53c0c4239d5c8',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c0c4239d5c8')) {function content_53c0c4239d5c8($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('property/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript" src="/templates/js/DatePicker.js"></script>

	<div class="col_main">
	  <div class="main_hd">
	    <div class="title_tab">
		  <ul class="tab_navs"> 
		    <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='default'){?>class="selected"<?php }?>><a href="/property/property">缴费查询</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['act']->value=='bind'){?>class="selected"<?php }?>><a href="/property/property?act=bind">上传缴费资料</a></li>
		  </ul>
		</div>
	  </div>
	
<div class="main_content">	 
 <?php if ($_smarty_tpl->tpl_vars['act']->value=='default'){?>
 <!-- 缴费查询--> 
 <!-- 绑定数据用于post -->
<div class="form_search fontSize12">
<form action="/property/property" method="get" enctype="multipart/form-data" name="search">
 至 <input type="text" name="pay_late" id="pay_late" onClick="setmonth(this, 'yyyy-MM', '2013-01', '2024-12', 1)" readonly="readonly" style="width:110px" value="<?php echo $_smarty_tpl->tpl_vars['pay_late']->value;?>
">
  月&ensp;&ensp;
 <select name="status" style="padding:0">
  <option value="-1">缴费状态</option>
  <option value="0" <?php if ($_smarty_tpl->tpl_vars['status']->value==0){?>selected<?php }?>>欠费</option>
  <option value="1" <?php if ($_smarty_tpl->tpl_vars['status']->value==1){?>selected<?php }?>>正常</option>
 </select>&ensp;&ensp;
 房号/业主姓名/手机号
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
   <th width="65px">房号</th>
   <th width="90px">业主姓名</th>
   <th width="80px">每月应缴</th>
   <th width="80px">已交至年月</th>
   <th width="60px">当前状态</th>
   <th width="80px">费用状态</th>
   <th width="130px">备注</th>
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
     <td align="center"><?php echo $_smarty_tpl->tpl_vars['l']->value['house_number'];?>
</td>
	 <td align="center"><?php echo $_smarty_tpl->tpl_vars['l']->value['house_owner'];?>
</td>
	 <td align="center"> 
	  <span id="pay_month_text_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
">¥ <?php echo $_smarty_tpl->tpl_vars['l']->value['pay_month'];?>
</span>
	  <span id="pay_month_input_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
" style="display:none">
	    ¥ <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['l']->value['pay_month'];?>
" class="editinput" id="pay_month_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
">
	  </span>
	 </td>
	 <td align="center">
	   <span id="pay_late_text_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['l']->value['pay_late'];?>
</span>
	   <span id="pay_late_input_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
" style="display:none">
	     <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['l']->value['pay_late'];?>
" class="editinput" id="pay_late_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
" onClick="setmonth(this, 'yyyy-MM', '2013-01', '2024-12', 1)" readonly="readonly" style="width:80px">
	   </span>
	 </td>
	 <td align="center" class="red">
	   <span id="status_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
"><?php if ($_smarty_tpl->tpl_vars['l']->value['status']==1){?><img src="/templates/images/icon/yes.gif"><?php }else{ ?>已欠费<?php }?></span>
	 </td>
	 <td align="center" class="red">
	   <span id="arreage_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
"><?php if ($_smarty_tpl->tpl_vars['l']->value['arrearage']){?>- ¥ <?php echo $_smarty_tpl->tpl_vars['l']->value['arrearage'];?>
<?php }else{ ?><img src="/templates/images/icon/yes.gif"><?php }?></span>
	 </td>
	 <td><?php echo $_smarty_tpl->tpl_vars['l']->value['log_desc'];?>
</td>
	 <td align="center">
	  <div id="edit_view_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
"> 
	   <a href="javascript:void(0);" onclick="javascript:viewUpdateProperty(<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
);">
	     <img src="/templates/images/icon/icon_edit.gif" title="编辑">
	   </a>&ensp;
	   <a href="javascript:void(0);" onclick="javascript:deleteProperty(<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
);">
	     <img src="/templates/images/icon/icon_trash.gif" title="删除">
	   </a>
	  </div>
      <div id="edit_act_<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
" style="display:none">
	    <input type="button" class="searchbutton" onclick="javascript:doUpdateProperty(<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
);" value="确 认">
		<input type="button" class="searchbutton" onclick="javascript:cancelUpdateProperty(<?php echo $_smarty_tpl->tpl_vars['l']->value['log_id'];?>
);" value="取 消">
	  </div>
	 </td>
   </tr>
  <?php } ?>
  <tr height="35px">
    <td colspan="2">
	 <label><input type="checkbox" onclick="javascript:selectAll(this,'log_id[]');"> 全选</label>
	</td>
	<td colspan="7">
	 <select name="act" style="padding:0">
	  <option>请选择操作</option>
	  <option value="deleteLog">删除</option>
	 </select>
	 &ensp;
	 <input type="hidden" name="logType" value="log_property">
	 <input type="button" class="searchbutton" onclick="javascript:AjaxSubmit('property');" value="确  定">
	</td>
  </tr>
  </table>
  </form>
  <div class="clear height10"></div>
  <div class="float_r">
   <?php echo $_smarty_tpl->getSubTemplate ("property/library/page.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

  </div>
  <div class="clear"></div>
  <script type="text/javascript">
  /* 定义编辑操作类 */
  function UpdateProperty(id)
  {
     this.edit_view = document.getElementById("edit_view_"+id);
	 this.edit_act = document.getElementById("edit_act_"+id);
	 this. pay_month_text = document.getElementById("pay_month_text_"+id);
	 this.pay_late_text = document.getElementById("pay_late_text_"+id);
	 this.pay_month_input = document.getElementById("pay_month_input_"+id);
	 this.pay_late_input = document.getElementById("pay_late_input_"+id);
	 this.pay_month = document.getElementById("pay_month_"+id);
	 this.pay_late = document.getElementById("pay_late_"+id);
	 /* 显示编辑框、按钮 */
	 this.viewUpdateProperty = function() {
	   this.edit_view.style.display="none";
	   this.edit_act.style.display="block"; 
	   this.pay_month_text.style.display="none";
	   this.pay_month_input.style.display="block";
	   this.pay_late_text.style.display="none";
	   this.pay_late_input.style.display="block";
	 }
	 /* 取消编辑 */
	 this.cancelUpdateProperty = function() { 
	   this.edit_view.style.display="block";
	   this.edit_act.style.display="none"; 
	   this.pay_month_text.style.display="block";
	   this.pay_month_input.style.display="none";
	   this.pay_late_text.style.display="block";
	   this.pay_late_input.style.display="none";
	 }
	 /* 提交编辑 */
	 this.doUpdateProperty = function() {
	   $.post("/property/property", {
	                      act:'update', log_id: id, pay_month: this.pay_month.value, pay_late: this.pay_late.value},
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
	 this.deleteProperty = function() { 
	   $.post("/property/ajax.php", {
	                      act:'deleteLog', log_id: [id], logType: 'log_property' },
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
  function viewUpdateProperty(id)
  {
     var updateproprety = new UpdateProperty(id);
	 updateproprety.viewUpdateProperty();
  }
  /* 取消编辑 */
  function cancelUpdateProperty(id)
  {
     var updateproprety = new UpdateProperty(id);
	 updateproprety.cancelUpdateProperty();
  }
  /* 提交编辑 */
  function doUpdateProperty(id)
  {
     var updateproprety = new UpdateProperty(id);
	 updateproprety.doUpdateProperty(); 
  }
  /* 删除单条记录 */
  function deleteProperty(id)
  { 
     var updateproprety = new UpdateProperty(id);
	 updateproprety.deleteProperty(); 
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
					uploadJson : '/property/property?act=act_bind'
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
 &ensp; <a href="/data/excel/wuyefei.rar"><span class="red" style="text-decoration:underline">下载物业费示例表格</span></a>
 <?php }?>
</div>

</div><?php }} ?>