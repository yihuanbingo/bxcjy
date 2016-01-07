<?php /* Smarty version Smarty-3.1.7, created on 2016-01-07 20:56:16
         compiled from ".\templates\admin\lifenav.htm" */ ?>
<?php /*%%SmartyHeaderCode:2614256737d409501f3-49988884%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fb60a94f469f9f899ce6b2879e6c56242a62dd37' => 
    array (
      0 => '.\\templates\\admin\\lifenav.htm',
      1 => 1450618919,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2614256737d409501f3-49988884',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_56737d41d8e0f',
  'variables' => 
  array (
    'cat_id' => 0,
    'province' => 0,
    'city' => 0,
    'district' => 0,
    'subdistrict' => 0,
    'neighborhood' => 0,
    'substrict' => 0,
    'act' => 0,
    'cat' => 0,
    'c' => 0,
    'sc' => 0,
    'r' => 0,
    'cat_name' => 0,
    'attrs' => 0,
    'a' => 0,
    'selectlist' => 0,
    'p' => 0,
    'slelectlist' => 0,
    'd' => 0,
    's' => 0,
    'n' => 0,
    'community' => 0,
    'community_id' => 0,
    'av' => 0,
    'lifenav' => 0,
    'l' => 0,
    'k' => 0,
    'v' => 0,
    'applylist' => 0,
    'h' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56737d41d8e0f')) {function content_56737d41d8e0f($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('admin/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript">
function deleteCat(id)
{
	$.post("/admin/lifenav.php",{
		act:'deletecat',cat_id:id},
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
<script type="text/javascript">
function deleteAttr(id)
{
	$.post("/admin/lifenav.php?act=attr&cat_id=<?php echo $_smarty_tpl->tpl_vars['cat_id']->value;?>
",{
		act:'delete_attr',attr_id:id},
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
<script type="text/javascript">
function submitCat()
{
	document.forms["lifenav"].action = "/admin/lifenav.php?act=add_lifenav&key=submit_cat";
	$("#lifenav").submit();
}
</script>
<script>
function submitLifenav()
{
	$("#lifenav").ajaxSubmit({  
                    type: 'post',  
                    url: "/admin/lifenav.php?act=add_lifenav&key=do_add" ,  
                    success: function(data){  
                        var data = json_decode(data);
								if(data.error==0)
								{
									alertMsg(data.data);
									setTimeout("submitCat();",3000);
								}
								if(data.error==1)
								{
									/* 弹出错误提示 */
									alertMsg(data.data);
								}
                    },  
                });  	
}
</script>
<script type="text/javascript">
function getProvince()
{   
   var province =  parseInt(<?php echo $_smarty_tpl->tpl_vars['province']->value;?>
);
   $.post("/ajax.php", {
   act:'setRegion',region_type:1},
   function(data)
   {
	   var data = json_decode(data);
	   var html = "<option value='0'>省/直辖市</option>";
	   for(var i=0; i<data.length;i++)
	   {
	      html += "<option value='"+data[i].region_id+"' ";
		  if(province==data[i].region_id)   //当前已选
		  {
		     html += "selected ";
		  }
		  html += ">"+data[i].region_name+"</option>";
	   }
	   $("#province").html(html);
   });
}
   
function setCity(province)
{
   var city =  parseInt(<?php echo $_smarty_tpl->tpl_vars['city']->value;?>
);
   $.post("/ajax.php", {
   act:'setRegion',region_type:2, parent_id:province},
   function(data)
   {
	   var data = json_decode(data);
	   var html = "<option value='0'>城市</option>";
	   if(province>0)
	   {
	    for(var i=0; i<data.length;i++)
	    {
	      html += "<option value='"+data[i].region_id+"' ";
		  if(city==data[i].region_id)   //当前已选
		  {
		     html += "selected ";
		  }
		  html += ">"+data[i].region_name+"</option>";
	    }
		 $("#city").html(html);
	   }
   });  
}

function setDistrict(city)
{
   var district =  parseInt(<?php echo $_smarty_tpl->tpl_vars['district']->value;?>
);
   $.post("/ajax.php", {
   act:'setRegion',region_type:3, parent_id:city},
   function(data)
   {
	   var data = json_decode(data);
	   var html = "<option value='0'>区县</option>";
	   if(city>0)
	   {
	    for(var i=0; i<data.length;i++)
	    {
	      html += "<option value='"+data[i].region_id+"' ";
		  if(district==data[i].region_id)   //当前已选
		  {
		     html += "selected ";
		  }
		  html += ">"+data[i].region_name+"</option>";
	    }
		 $("#district").html(html);
	   }
   }); 
}

function setSubdistrict(district)
{
   var subdistrict =  parseInt(<?php echo $_smarty_tpl->tpl_vars['subdistrict']->value;?>
);
   $.post("/ajax.php", {
   act:'setRegion',region_type:4, parent_id:district},
   function(data)
   {
	   var data = json_decode(data);
	   var html = "<option value='0'>街道办</option>";
	   if(district>0)
	   {
	    for(var i=0; i<data.length;i++)
	    {
	      html += "<option value='"+data[i].region_id+"' ";
		  if(subdistrict==data[i].region_id)   //当前已选
		  {
		     html += "selected ";
		  }
		  html += ">"+data[i].region_name+"</option>";
	    }
		 $("#subdistrict").html(html);
	   }
   }); 
}

function setNeighborhood(subdistrict)
{
   var neighborhood =  parseInt(<?php echo $_smarty_tpl->tpl_vars['neighborhood']->value;?>
);
   $.post("/ajax.php", {
   act:'setRegion',region_type:5, parent_id:subdistrict},
   function(data)
   {
	   var data = json_decode(data);
	   var html = "<option value='0'>社区</option>";
	   if(subdistrict>0)
	   {
	    for(var i=0; i<data.length;i++)
	    {
	      html += "<option value='"+data[i].region_id+"' ";
		  if(neighborhood==data[i].region_id)   //当前已选
		  {
		     html += "selected ";
		  }
		  html += ">"+data[i].region_name+"</option>";
	    }
		 $("#neighborhood").html(html);
	   }
   }); 
}

getProvince();
setCity(<?php echo $_smarty_tpl->tpl_vars['province']->value;?>
);
setDistrict(<?php echo $_smarty_tpl->tpl_vars['city']->value;?>
);
setSubdistrict(<?php echo $_smarty_tpl->tpl_vars['district']->value;?>
);
setNeighborhood(<?php echo $_smarty_tpl->tpl_vars['substrict']->value;?>
);
</script>
	<div class="col_main">
	  <div class="main_hd">
	    <div class="title_tab">
		  <ul class="tab_navs">
		    <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='lifenav_cat'||$_smarty_tpl->tpl_vars['act']->value=='attr'){?>class="selected"<?php }?>><a href="/admin/lifenav.php">生活导航分类</a></li>
			  <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='lifenav'){?>class="selected"<?php }?>><a href="/admin/lifenav.php?act=lifenav">生活导航</a></li>
        <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='lifenav_apply'){?>class="selected"<?php }?>><a href="/admin/lifenav.php?act=lifenav_apply">生活导航申请审核</a></li>
        <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='add_lifenav'){?>class="selected"<?php }?>><a href="/admin/lifenav.php?act=add_lifenav">新增生活导航</a></li>
		  </ul>
		</div>
	  </div>

<div class="main_content">	 
<?php if ($_smarty_tpl->tpl_vars['act']->value=='lifenav_cat'){?>  
<?php if ($_smarty_tpl->tpl_vars['cat_id']->value==='list'){?>
 <table class="info_list" cellspacing="1">
  <tr>
   <th>生活导航名称</th>
   <th width="80px">排 序</th>
   <th width="200px">操作</th>
  </tr>
  <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cat']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
   <tr>
    <td><?php echo $_smarty_tpl->tpl_vars['c']->value['cat_name'];?>
</td>  
	<td><?php echo $_smarty_tpl->tpl_vars['c']->value['sort_order'];?>
</td>
	<td align="center">
    	<div id="edit_view_<?php echo $_smarty_tpl->tpl_vars['c']->value['cat_id'];?>
">
        	<a href="/admin/lifenav.php?cat_id=<?php echo $_smarty_tpl->tpl_vars['c']->value['cat_id'];?>
">
	    		<img src="/templates/images/icon/icon_edit.gif" title="编辑">
	   		</a>&ensp;
	  		<a href="javascript:void(0)" onclick="javascript:deleteCat(<?php echo $_smarty_tpl->tpl_vars['c']->value['cat_id'];?>
);">
	    		<img src="/templates/images/icon/icon_trash.gif" title="删除">
	   		</a>
	   	</div>
    </td>
   </tr>
   <?php  $_smarty_tpl->tpl_vars['sc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['c']->value['sub_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sc']->key => $_smarty_tpl->tpl_vars['sc']->value){
$_smarty_tpl->tpl_vars['sc']->_loop = true;
?>
   <tr>
    <td>&ensp;- <?php echo $_smarty_tpl->tpl_vars['sc']->value['cat_name'];?>
</td>  
	<td><?php echo $_smarty_tpl->tpl_vars['sc']->value['sort_order'];?>
</td>
	<td align="center">
    	<div id="edit_view_<?php echo $_smarty_tpl->tpl_vars['r']->value['cat_id'];?>
">
        	<a href="/admin/lifenav.php?cat_id=<?php echo $_smarty_tpl->tpl_vars['sc']->value['cat_id'];?>
">
	    		<img src="/templates/images/icon/icon_edit.gif" title="编辑">
	   		</a>&ensp;
			<a href="/admin/lifenav.php?act=attr&cat_id=<?php echo $_smarty_tpl->tpl_vars['sc']->value['cat_id'];?>
">
			    <img src="/templates/images/icon/icon_link.png" title="属性">
			</a>&ensp;
			<a href="/admin/lifenav.php?act=add_lifenav&cat_id=<?php echo $_smarty_tpl->tpl_vars['sc']->value['cat_id'];?>
">
			    <img src="/templates/images/icon/icon_add.gif" title="添加">
			</a>&ensp;
	  		<a href="javascript:void(0);" onClick="javascript:deleteCat(<?php echo $_smarty_tpl->tpl_vars['sc']->value['cat_id'];?>
);">
	    		<img src="/templates/images/icon/icon_trash.gif" title="删除">
	   		</a>
	   	</div>
    </td>
   </tr>
   <?php } ?>
  <?php } ?>
  </table>
  <div class="clear height10"></div>
  <a href="/admin/lifenav.php?cat_id=0"><input type="button" class="btn_primary" value="添加生活导航"></a>
 <?php }else{ ?>
  <form action="/admin/lifenav.php" method="post" enctype="multipart/form-data" id="lifenav" class="form">
   <p class="f_title">生活导航名称：
   <p class="f_content"><input type="text" name="cat_name" class="input" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['cat_name'];?>
">
   <p class="f_title">所属分类：
   <p class="f_content"><select name="parent_id">
    <option value="0">顶级分类</option>
	<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cat']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
	  <option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['cat_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['r']->value['parent_id']==$_smarty_tpl->tpl_vars['c']->value['cat_id']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['cat_name'];?>
</option>
	<?php } ?>
   </select>
   <p class="f_content">
   <p class="f_title">排序：
   <p class="f_content"><input type="text" name="sort_order" value="<?php if ($_smarty_tpl->tpl_vars['r']->value['cat_id']>0){?><?php echo $_smarty_tpl->tpl_vars['r']->value['sort_order'];?>
<?php }else{ ?>50<?php }?>" class="input" style="width:50px">
   <p>
    <input type="hidden" name="cat_id" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['cat_id'];?>
">
	<input type="hidden" name="act" value="operateCat">
	<input type="button" value="提 交" class="btn_primary" onclick="javascript:submitLifenav();">
  </form>
 <?php }?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['act']->value=='attr'){?>
 <table class="info_list" cellspacing="1">
  <tr>
   <th width="160px"><?php echo $_smarty_tpl->tpl_vars['cat_name']->value;?>
 的属性</th>
   <th width="80px">类 型</th>
   <th>可选值</th>
   <th width="50px">排 序</th>
   <th width="80px">操作</th>
  </tr>
  <?php  $_smarty_tpl->tpl_vars['a'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['a']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['attrs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['a']->key => $_smarty_tpl->tpl_vars['a']->value){
$_smarty_tpl->tpl_vars['a']->_loop = true;
?>
   <tr>
	<td><?php echo $_smarty_tpl->tpl_vars['a']->value['attr_name'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['a']->value['type'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['a']->value['value'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['a']->value['sort_order'];?>
</td>
	<td>
	  <a href="javascript:void(0);" onClick="javascript:deleteAttr(<?php echo $_smarty_tpl->tpl_vars['a']->value['attr_id'];?>
);"}>
	    		<img src="/templates/images/icon/icon_trash.gif" title="删除">
	  </a>
	</td>
   </tr>
  <?php } ?>
  
  </table>
  <div class="clear height10"></div>
  <form action="/admin/lifenav.php" method="post" enctype="multipart/form-data" id="lifenav" class="form">
   <p class="f_title">属性名称：
   <p class="f_content"><input type="text" name="attr_name" class="input">
   <p class="f_title">类 型：
   <p class="f_content"><select name="type">
    <option value="input">输入框</option>
	<option value="select">单选</option>
	<option value="checkbox">多选</option>
   <option value="textarea">商家简介</optgroup>
   </select>
   <p class="f_title">可选值：<span class="color999 fontSize12">（多个值用英文 , 隔开）</span>
   <p class="f_content"><input type="text" name="value" class="input">
   <p class="f_title">排序：
   <p class="f_content"><input type="text" name="sort_order"  class="input" value="50" style="width:50px">
   <p>
    <input type="hidden" name="cat_id" value="<?php echo $_smarty_tpl->tpl_vars['cat_id']->value;?>
">
	<input type="hidden" name="act" value="add_attr">
	<input type="button" value="提 交" class="btn_primary" onclick="javascript:AjaxSubmit('lifenav');">
  </form>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['act']->value=='add_lifenav'){?>
 <form action="/admin/lifenav.php?act=add_lifenav" method="post" enctype="multipart/form-data" id="lifenav" class="form">
   <p class="f_title">所属分类：
   <p class="f_content">
   <select name="cat_id" id="cat_id">
   <option value="0">请选择生活导航类别</option>
   <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cat']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
   <option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['cat_id'];?>
">**<?php echo $_smarty_tpl->tpl_vars['c']->value['cat_name'];?>
**</option>
   	<?php  $_smarty_tpl->tpl_vars['sc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['c']->value['sub_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sc']->key => $_smarty_tpl->tpl_vars['sc']->value){
$_smarty_tpl->tpl_vars['sc']->_loop = true;
?>
      <?php if ($_smarty_tpl->tpl_vars['sc']->value['cat_id']==$_smarty_tpl->tpl_vars['cat_id']->value){?>
      <option value="<?php echo $_smarty_tpl->tpl_vars['sc']->value['cat_id'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['sc']->value['cat_name'];?>
</option>
      <?php }else{ ?>
      <option value="<?php echo $_smarty_tpl->tpl_vars['sc']->value['cat_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['sc']->value['cat_name'];?>
</option>
      <?php }?>
      <?php } ?>
   <?php } ?>
   </select>
   <p class="f_title">所属区域：
   <p class="f_content">
   <select id="province" name="province" onchange="javascript:setCity(this.value);">
   <option value="0">省/直辖市</option>
   <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['selectlist']->value['province_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value){
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
   <?php if ($_smarty_tpl->tpl_vars['p']->value['region_id']==$_smarty_tpl->tpl_vars['province']->value){?>
   <option value="<?php echo $_smarty_tpl->tpl_vars['p']->value['region_id'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['p']->value['region_name'];?>
</option>
   <?php }else{ ?>
   <option value="<?php echo $_smarty_tpl->tpl_vars['p']->value['region_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['p']->value['region_name'];?>
</option>
   <?php }?>
   <?php } ?>
   </select>
   <select id="city" name="city" onchange="javascript:setDistrict(this.value);">
   <option value="0">城市</option>
   <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['slelectlist']->value['city_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
   <?php if ($_smarty_tpl->tpl_vars['c']->value['region_id']==$_smarty_tpl->tpl_vars['city']->value){?>
   <option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['region_id'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['c']->value['region_name'];?>
</option>
   <?php }else{ ?>
   <option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['region_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['region_name'];?>
</option>
   <?php }?>
   <?php } ?>
   </select>
   <select id="district" name="district" onchange="javascript:setSubdistrict(this.value)">
   <option value="0">区县</option>
   <?php  $_smarty_tpl->tpl_vars['d'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['d']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['selectlist']->value['district_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['d']->key => $_smarty_tpl->tpl_vars['d']->value){
$_smarty_tpl->tpl_vars['d']->_loop = true;
?>
   <?php if ($_smarty_tpl->tpl_vars['d']->value['region_id']==$_smarty_tpl->tpl_vars['district']->value){?>
   <option value="<?php echo $_smarty_tpl->tpl_vars['d']->value['region_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['d']->value['region_name'];?>
</option>
   <?php }else{ ?>
   <option value="<?php echo $_smarty_tpl->tpl_vars['d']->value['region_id'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['d']->value['region_name'];?>
</option>
   <?php }?>
   <?php } ?>
   </select>
   <select id="subdistrict" name="subdistrict" onchange="javascript:setNeighborhood(this.value)">
   <option value="0">街道办</option>
   <?php  $_smarty_tpl->tpl_vars['s'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['s']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['selectlist']->value['subdistrict_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['s']->key => $_smarty_tpl->tpl_vars['s']->value){
$_smarty_tpl->tpl_vars['s']->_loop = true;
?>
   <?php if ($_smarty_tpl->tpl_vars['s']->value['region_id']==$_smarty_tpl->tpl_vars['subdistrict']->value){?>
   <option value="<?php echo $_smarty_tpl->tpl_vars['s']->value['region_id'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['s']->value['region_name'];?>
</option>
   <?php }else{ ?>
   <option value="<?php echo $_smarty_tpl->tpl_vars['s']->value['region_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['s']->value['region_name'];?>
</option>
   <?php }?>
   <?php } ?>
   </select>
   <select id="neighborhood" name="neighborhood">
   <option value="0">社区</option>
   <?php  $_smarty_tpl->tpl_vars['n'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['n']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['selectlist']->value['neighborhood_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['n']->key => $_smarty_tpl->tpl_vars['n']->value){
$_smarty_tpl->tpl_vars['n']->_loop = true;
?>
   <?php if ($_smarty_tpl->tpl_vars['n']->value['region_id']==$_smarty_tpl->tpl_vars['neighborhood']->value){?>
   <option value="<?php echo $_smarty_tpl->tpl_vars['n']->value['region_id'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['n']->value['region_name'];?>
</option>
   <?php }else{ ?>
   <option value="<?php echo $_smarty_tpl->tpl_vars['n']->value['region_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['n']->value['region_name'];?>
</option>
   <?php }?>
   <?php } ?>
   </select>
   <p class="f_title">所属小区：
   <p class="f_content"><select name="community_id" id="community_id">
      <option value="0">请选择小区</option>
      <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['community']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
       <?php if ($_smarty_tpl->tpl_vars['c']->value['community_id']==$_smarty_tpl->tpl_vars['community_id']->value){?>
       <option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['community_id'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['c']->value['community_name'];?>
</option>
       <?php }else{ ?>
	    <option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['community_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['community_name'];?>
</option>
       <?php }?>
	  <?php } ?>
   </select>
   <input type="button" value="确 认" class="btn_primary" style="float:right" onclick="javascript:submitCat();">
   <div id="attrs" name="attrs">
   <?php  $_smarty_tpl->tpl_vars['a'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['a']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['attrs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['a']->key => $_smarty_tpl->tpl_vars['a']->value){
$_smarty_tpl->tpl_vars['a']->_loop = true;
?>
   <p class="f_title"><?php echo $_smarty_tpl->tpl_vars['a']->value['attr_name'];?>
：
   <p class="f_content">
    <?php if ($_smarty_tpl->tpl_vars['a']->value['type']=='input'){?>
	 <input type="input" class="input" name="<?php echo $_smarty_tpl->tpl_vars['a']->value['attr_id'];?>
">
	 <?php }elseif($_smarty_tpl->tpl_vars['a']->value['type']=='select'){?>
	 <select name="<?php echo $_smarty_tpl->tpl_vars['a']->value['attr_id'];?>
">
	  <?php  $_smarty_tpl->tpl_vars['av'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['av']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['a']->value['value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['av']->key => $_smarty_tpl->tpl_vars['av']->value){
$_smarty_tpl->tpl_vars['av']->_loop = true;
?>
	   <option value="<?php echo $_smarty_tpl->tpl_vars['av']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['av']->value;?>
</option>
	  <?php } ?>
	 </select>
	 <?php }elseif($_smarty_tpl->tpl_vars['a']->value['type']=='checkbox'){?>
	 <?php  $_smarty_tpl->tpl_vars['av'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['av']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['a']->value['value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['av']->key => $_smarty_tpl->tpl_vars['av']->value){
$_smarty_tpl->tpl_vars['av']->_loop = true;
?>
	  <label><input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['a']->value['attr_id'];?>
[]" value="<?php echo $_smarty_tpl->tpl_vars['av']->value;?>
"> <?php echo $_smarty_tpl->tpl_vars['av']->value;?>
</label> &ensp;
	 <?php } ?>
    <?php }elseif($_smarty_tpl->tpl_vars['a']->value['type']=='textarea'){?>
    <textarea name="<?php echo $_smarty_tpl->tpl_vars['a']->value['attr_id'];?>
" style="width:100%;height:250px"></textarea>
    <?php }?>
   <?php } ?>
   </div>
   <p class="f_title">排 序：<span class="color999 fontSize12">（同类信息中，排序越小越靠前）</span>
   <p class="f_content"><input type="text" name="sort_order"  class="input" value="50" style="width:50px">
   <p>
	<?php if ($_smarty_tpl->tpl_vars['attrs']->value){?><input type="button" value="提 交" class="btn_primary" onclick="javascript:submitLifenav();"><?php }?>
  </form>
<script type="text/javascript" src="/includes/kindeditor/kindeditor-min.js"></script>
<script type="text/javascript" src="/includes/kindeditor/lang/zh_CN.js"></script> 
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('textarea', {
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
	uploadJson : '/uploadimg.php?act=lifenav',
	items : ['image','fontsize','bold','forecolor', 'hilitecolor','italic', 'underline', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist','insertunorderedlist']
});
});
</script>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['act']->value=='lifenav'){?>
	<div class="content">
    <form action="/admin/lifenav.php?act=lifenav" method="get" enctype="multipart/form-data" name="search">
    <input type="hidden" name="act" value="lifenav">
 	  <input type="hidden" name="page" value="1">
	</form>
	<table class="info_list" cellspacing="1">
	<tr>
	<th width="80px">导航分类</th>
	<th width="120px">所属区域</th>
	<th>导航细节</th>
    <th width="40px">操作</th>
    </tr>
    <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lifenav']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value){
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
    <tr>
    	<td width="80px"><?php echo $_smarty_tpl->tpl_vars['l']->value['cat_name'];?>
</td>
        <td width="120tpx" style="padding-right:5px"><?php if ($_smarty_tpl->tpl_vars['l']->value['province']){?> <?php echo $_smarty_tpl->tpl_vars['l']->value['province'];?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['l']->value['city']){?> <?php echo $_smarty_tpl->tpl_vars['l']->value['city'];?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['l']->value['district']){?> <?php echo $_smarty_tpl->tpl_vars['l']->value['district'];?>

        <?php }?><?php if ($_smarty_tpl->tpl_vars['l']->value['subdistrict']){?> <?php echo $_smarty_tpl->tpl_vars['l']->value['subdistrict'];?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['l']->value['neighborhood']){?> <?php echo $_smarty_tpl->tpl_vars['l']->value['neighborhood'];?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['l']->value['community_name']){?><?php echo $_smarty_tpl->tpl_vars['l']->value['community_name'];?>
<?php }?></td>
        <td><?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['l']->value['content']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
:<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</br><?php } ?></td>
        <td width="40px"><a href="/admin/lifenav.php?act=delete_lifenav&lifenav_id=<?php echo $_smarty_tpl->tpl_vars['l']->value['lifenav_id'];?>
">
	    		<img src="/templates/images/icon/icon_trash.gif" title="删除">
	   		</a>
        </td>
	</tr>
    <?php } ?>
    </table>
      <div class="clear height10"></div>
      <div class="float_r">
        <?php echo $_smarty_tpl->getSubTemplate ("property/library/page.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
	
   	  </div>
	</div>
 	

<?php }?>
<?php if ($_smarty_tpl->tpl_vars['act']->value=='lifenav_apply'){?>
<form action="/admin/lifenav.php" method="get" enctype="multipart/form-data" name="search">
 <input type="hidden" name="act" value="lifenav_apply">
 <input type="hidden" name="page" value="1">
</form>
 <table class="info_list" cellspacing="1" width="100%">
 <tr>
  <th width="40%">申请内容</th>
  <th width="12%">申请人姓名</th>
  <th width="15%">联系电话</th>
  <th width="13%">申请时间</th>
  <th width="10%">状态</th>
  <th width="10%">操作</th>
 </tr>
 <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['applylist']->value['res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value){
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
  <tr align="center">
   <td><?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['l']->value['content']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
:<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</br><?php } ?></td>
   <td><?php echo $_smarty_tpl->tpl_vars['l']->value['contact_user'];?>
</td>
   <td><?php echo $_smarty_tpl->tpl_vars['l']->value['mobile'];?>
</td>
   <td><?php echo $_smarty_tpl->tpl_vars['l']->value['apply_time'];?>
</td>
   <td><?php if ($_smarty_tpl->tpl_vars['l']->value['status']==0){?><a href="/admin/lifenav.php?act=add_lifenav&apply_id=<?php echo $_smarty_tpl->tpl_vars['l']->value['apply_id'];?>
">待审核</a><?php }elseif($_smarty_tpl->tpl_vars['l']->value['status']==1){?>已通过<?php }?></td>
   <td>
    <div id="edit_view_<?php echo $_smarty_tpl->tpl_vars['h']->value['cat_id'];?>
">
      <?php if ($_smarty_tpl->tpl_vars['l']->value['status']==0){?>
    <a href="/admin/lifenav.php?act=add_lifenav&apply_id=<?php echo $_smarty_tpl->tpl_vars['l']->value['apply_id'];?>
">
    <img src="/templates/images/icon/icon_edit.gif" title="通过">
    </a>&ensp;
    <?php }?>
    <a href="/admin/lifenav.php?act=delete_apply&apply_id=<?php echo $_smarty_tpl->tpl_vars['l']->value['apply_id'];?>
">
    <img src="/templates/images/icon/icon_trash.gif" title="删除">
    </a>
  </div>
   </td>
  </tr>
 <?php } ?>
 </table>
<div class="clear height10"></div>
<div class="float_r">
<?php echo $_smarty_tpl->getSubTemplate ("admin/library/page.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>
<?php }?>
</div>

</div>
<?php }} ?>