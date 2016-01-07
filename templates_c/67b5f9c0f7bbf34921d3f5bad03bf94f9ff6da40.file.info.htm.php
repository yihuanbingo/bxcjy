<?php /* Smarty version Smarty-3.1.7, created on 2016-01-07 20:56:23
         compiled from ".\templates\admin\info.htm" */ ?>
<?php /*%%SmartyHeaderCode:6266566be01c0d7315-22026585%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '67b5f9c0f7bbf34921d3f5bad03bf94f9ff6da40' => 
    array (
      0 => '.\\templates\\admin\\info.htm',
      1 => 1450618919,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6266566be01c0d7315-22026585',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_566be01c8709e',
  'variables' => 
  array (
    'act' => 0,
    'key' => 0,
    'info' => 0,
    'cats' => 0,
    'c' => 0,
    'list' => 0,
    'r' => 0,
    'infocat' => 0,
    'h' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_566be01c8709e')) {function content_566be01c8709e($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('admin/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


	<div class="col_main">
	  <div class="main_hd">
	    <div class="title_tab">
		  <ul class="tab_navs">
		    <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='infolist'){?>class="selected"<?php }?>><a href="/admin/info.php">文章管理</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['act']->value=='infocatlist'){?>class="selected"<?php }?>><a href="/admin/info.php?act=infocatlist">文章分类管理</a></li>
		  </ul>
		</div>
	  </div>

<div class="main_content">	 
  	<?php if ($_smarty_tpl->tpl_vars['act']->value=='infolist'){?>
     <?php if ($_smarty_tpl->tpl_vars['key']->value=='operate'){?>
	  <!-- 新增或编辑 -->
      <form action="/admin/info.php" id="info" method="post" enctype="multipart/form-data" class="form">
       <p class="f_title">文章标题：<span class="color999 fontSize12">（标题不多于32个字符）</span>
       <p class="f_content"><input type="text" name="title" class="input" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['title'];?>
">
       <p class="f_title">所属分类：<span class="color999 fontSize12">（为文章分配一个分类）</span>
       <p class="f_content"><select name="cat_id">
	    <option value="0">请选择文章分类</option>
		<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cats']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['cat_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['info']->value['cat_id']==$_smarty_tpl->tpl_vars['c']->value['cat_id']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['cat_name'];?>
</option><?php } ?></select>
       <p class="f_title">文章内容：
       <p class="f_content"><textarea name="content" style="width:100%;height:250px"><?php echo $_smarty_tpl->tpl_vars['info']->value['content'];?>
</textarea>
       <input type="hidden" name="act" value="operate">
	   <input type="hidden" name="info_id" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['info_id'];?>
">
       <input type="button" class="btn_primary" style="margin-top:10px" value="发表文章" onclick="javascript:AjaxSubmit('info');">
       </form>
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
	 <?php }else{ ?>
	  <!-- 列表 -->
	   <!-- 绑定数据用于post -->
<form action="/admin/info.php" method="get" enctype="multipart/form-data" name="search">
 <input type="hidden" name="page" value="1">
</form>
 <table class="info_list" cellspacing="1">
  <tr>
   <th>文章标题</th>
   <th width="120px">所属分类</th>
   <th width="200px">发布时间</th>
   <th width="120px">操作</th>
  </tr>
  <?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value['res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
?>
   <tr>
    <td><?php echo $_smarty_tpl->tpl_vars['r']->value['title'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['r']->value['cat_name'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['r']->value['add_time'];?>
</td>
	<td align="center">
    	<div id="edit_view_<?php echo $_smarty_tpl->tpl_vars['r']->value['info_id'];?>
">
        	<a href="/admin/info.php?key=operate&info_id=<?php echo $_smarty_tpl->tpl_vars['r']->value['info_id'];?>
">
	    		<img src="/templates/images/icon/icon_edit.gif" title="编辑">
	   		</a>&ensp;
	  		<a href="javascript:void(0)" onclick="javascript:deleteInfo(<?php echo $_smarty_tpl->tpl_vars['r']->value['info_id'];?>
);">
	    		<img src="/templates/images/icon/icon_trash.gif" title="删除">
	   		</a>
	   	</div>
    </td>
   </tr>
  <?php } ?>
  </table>
   <div class="clear height10"></div>
  <div class="float_r">
   <?php echo $_smarty_tpl->getSubTemplate ("property/library/page.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

  </div>
  <a href="/admin/info.php?key=operate"><input type="button" class="btn_primary" value="添加文章"></a>
  <script type="text/javascript">
	function deleteInfo(id)
    {
			$.post("/admin/info.php",{
				act:'deleteinfo',info_id:id},
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
</script>
	 <?php }?>
    <?php }?>
    
    <?php if ($_smarty_tpl->tpl_vars['act']->value=='infocatlist'){?>
   	<table class="info_list" cellspacing="1">
  			<tr>
  				<th>文章分类</th>
                <th>操作</th>
        	</tr>
            <?php  $_smarty_tpl->tpl_vars['h'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['h']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['infocat']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['h']->key => $_smarty_tpl->tpl_vars['h']->value){
$_smarty_tpl->tpl_vars['h']->_loop = true;
?>
            <tr>
            	<td width="80%" align="center">
                <span id="infocat_text_<?php echo $_smarty_tpl->tpl_vars['h']->value['cat_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['h']->value['cat_name'];?>
</span>
                <span id="infocat_input_<?php echo $_smarty_tpl->tpl_vars['h']->value['cat_id'];?>
" style="display:none">
	    			<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['h']->value['cat_name'];?>
" class="editinput" id="infocat_<?php echo $_smarty_tpl->tpl_vars['h']->value['cat_id'];?>
" style="width:90%">
	 			</span>
                </td>
                <td width="20%" align="center">
                	<div id="edit_view_<?php echo $_smarty_tpl->tpl_vars['h']->value['cat_id'];?>
">
                		<a href="javascript:void(0);" onclick="javascript:viewUpdateLog(<?php echo $_smarty_tpl->tpl_vars['h']->value['cat_id'];?>
);">
	    					<img src="/templates/images/icon/icon_edit.gif" title="编辑">
	   					</a>&ensp;
	  					<a href="javascript:void(0);" onclick="javascript:deleteLog(<?php echo $_smarty_tpl->tpl_vars['h']->value['cat_id'];?>
);">
	    					<img src="/templates/images/icon/icon_trash.gif" title="删除">
	   					</a>
	   				</div>
                    <div id="edit_act_<?php echo $_smarty_tpl->tpl_vars['h']->value['cat_id'];?>
" style="display:none">
	   					<input type="button" class="searchbutton" onclick="javascript:doUpdateLog(<?php echo $_smarty_tpl->tpl_vars['h']->value['cat_id'];?>
);" value="确 认">
						<input type="button" class="searchbutton" onclick="javascript:cancelUpdateLog(<?php echo $_smarty_tpl->tpl_vars['h']->value['cat_id'];?>
);" value="取 消">
	  				</div>
                 </td>
            </tr>
            <?php } ?>
  	</table>
	<form action="/admin/info.php" id="info" method="post" enctype="multipart/form-data" class="form">
    	<div class="middle" style="margin-top:10px">
  			<input type="button" class="btn_primary" name="new_cat" value="新建分类" onclick="showui()">
        	<input type="text" id="cat_name" name="cat_name" class="input" style="visibility:hidden;align:center;margin-left:5px;margin-right:5px" >
        	<input type="button" class="btn_primary" style="visibility:hidden" id="submit" value="提交" onclick="javascript:AjaxSubmit('info');">
            <input type="button" class="btn_primary" style="visibility:hidden" id="cancel" value="取消" onclick="hideui()">
            <input type="hidden" name="act" value="doinfocat">
		</div>
	</form>
	<script type="text/javascript">
	function showui()
	{
		
		document.getElementById("cat_name").style.visibility="visible";
		document.getElementById("submit").style.visibility="visible";
		document.getElementById("cancel").style.visibility="visible";
	}
	function hideui()
	{
		document.getElementById("cat_name").style.visibility="hidden";
		document.getElementById("submit").style.visibility="hidden";
		document.getElementById("cancel").style.visibility="hidden";
	}
</script>
<!--<script type="text/javascript">
	/*编辑文章*/
	function UpdateInfo(id)
	{
		this.doUpdateInfo = function()
		{
			$.post("/admin/info.php",{
				act:'infolist',key:operate,info_id:id},
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
	function doUpdateInfo(id)
	{
		var updateinfo = new UpdateInfo(id);
		updateinfo.doUpdateInfo();
	}
</script>
-->

<script type="text/javascript">
    function UpdateLog(id)
    {
    	this.edit_view = document.getElementById("edit_view_"+id);
		this.edit_act = document.getElementById("edit_act_"+id);
		this.infocat_text = document.getElementById("infocat_text_"+id);
		this.infocat_input = document.getElementById("infocat_input_"+id);
		/*用于post的值*/
		this.infocat = document.getElementById("infocat_"+id);
		
		/* 显示编辑框、按钮 */
		this.viewUpdateLog = function()
		{
			this.edit_view.style.display = "none";
			this.edit_act.style.display = "block";
			this.infocat_text.style.display = "none";
			this.infocat_input.style.display = "block";
		}
		/* 取消编辑 */
		this.cancelUpdateLog = function()
		{
			this.edit_view.style.display = "block";
			this.edit_act.style.display = "none";
			this.infocat_text.style.display = "block";
			this.infocat_input.style.display = "none";
		}
		/* 提交编辑 */
		this.doUpdateLog = function()
		{
			$.post("/admin/info.php",{
				act:'updateinfocat',cat_id:id,cat_name:this.infocat.value},
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
		/* 删除分类 */
		this.deleteLog = function()
		{
			
			$.post("/admin/info.php",{
				act:'deleteinfocat',cat_id:id},
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
	function viewUpdateLog(id)
	{
		var updateinfocat = new UpdateLog(id);
		updateinfocat.viewUpdateLog();
	}
	function cancelUpdateLog(id)
	{
		var updateinfocat = new UpdateLog(id);
		updateinfocat.cancelUpdateLog();
	}
	function doUpdateLog(id)
	{
		var updateinfocat = new UpdateLog(id);
		updateinfocat.doUpdateLog();
	}
	function deleteLog(id)
	{
		var updateinfocat = new UpdateLog(id);
		updateinfocat.deleteLog();
	}
</script>
    <?php }?>
</div>

</div>
<?php }} ?>