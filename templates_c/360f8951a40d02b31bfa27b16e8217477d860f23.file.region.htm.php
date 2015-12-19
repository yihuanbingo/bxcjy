<?php /* Smarty version Smarty-3.1.7, created on 2015-12-12 16:52:33
         compiled from ".\templates\admin\region.htm" */ ?>
<?php /*%%SmartyHeaderCode:1160566be0514bb772-21057369%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '360f8951a40d02b31bfa27b16e8217477d860f23' => 
    array (
      0 => '.\\templates\\admin\\region.htm',
      1 => 1405070030,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1160566be0514bb772-21057369',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'province' => 0,
    'city' => 0,
    'district' => 0,
    'subdistrict' => 0,
    'neighborhood' => 0,
    'substrict' => 0,
    'selectlist' => 0,
    'p' => 0,
    'slelectlist' => 0,
    'c' => 0,
    'd' => 0,
    's' => 0,
    'n' => 0,
    'community_list' => 0,
    'regionlist' => 0,
    'r' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_566be052119f3',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_566be052119f3')) {function content_566be052119f3($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('admin/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


	<div class="col_main">
	  <div class="main_hd">
	    <div class="title_tab">
		  <ul class="tab_navs">
		    <li class="selected"><a href="/admin/region.php">地区管理</a></li>
		  </ul>
		</div>
	  </div>

<div class="main_content">	  
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
	   var html = "<option>省/直辖市</option>";
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
	   var html = "<option>城市</option>";
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
	   var html = "<option>区县</option>";
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
	   var html = "<option>街道办</option>";
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
	   var html = "<option>社区</option>";
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
<script type="text/javascript" src="/includes/kindeditor/kindeditor-min.js"></script>
<script type="text/javascript" src="/includes/kindeditor/lang/zh_CN.js"></script> 
<form action="/admin/region.php?act=act_region" method="post" enctype="multipart/form-data" id="region" class="form">
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
<input type="submit" class="btn_primary" id='regionsubmit' style="float:right" value="确认">
</form>
<script type="text/javascript">
    function UpdateRegion(id)
    {
    	this.edit_view = document.getElementById("edit_view_"+id);
		this.edit_act = document.getElementById("edit_act_"+id);
		this.region_text = document.getElementById("region_text_"+id);
		this.region_input = document.getElementById("region_input_"+id);
		/*用于post的值*/
		this.region = document.getElementById("region_"+id);
		
		/* 显示编辑框、按钮 */
		this.viewUpdateRegion = function()
		{
			this.edit_view.style.display = "none";
			this.edit_act.style.display = "block";
			this.region_text.style.display = "none";
			this.region_input.style.display = "block";
		}
		/* 取消编辑 */
		this.cancelUpdateRegion = function()
		{
			this.edit_view.style.display = "block";
			this.edit_act.style.display = "none";
			this.region_text.style.display = "block";
			this.region_input.style.display = "none";
		}
		/* 提交编辑 */
		this.doUpdateRegion = function()
		{
			$.post("/admin/region.php",{
			act:'update_region',region_id:id,region_name:this.region.value,province:<?php echo $_smarty_tpl->tpl_vars['province']->value;?>
,city:<?php echo $_smarty_tpl->tpl_vars['city']->value;?>
,district:<?php echo $_smarty_tpl->tpl_vars['district']->value;?>
,
			subdistrict:<?php echo $_smarty_tpl->tpl_vars['subdistrict']->value;?>
,neighborhood:<?php echo $_smarty_tpl->tpl_vars['neighborhood']->value;?>
},
			function(data)
			{
				var data = json_decode(data);
				if(data.error==0)
				{
					alertMsg(data.data);
					setTimeout("$('#region').submit();",1000);
				}
					if(data.error==1)
					{
					/* 弹出错误提示 */
					alertMsg(data.data);
					}
			});
		}
		/* 删除分类 */
		this.deleteRegion = function()
		{
			$.post("/admin/region.php",{
			act:'delete_region',region_id:id,province:<?php echo $_smarty_tpl->tpl_vars['province']->value;?>
,city:<?php echo $_smarty_tpl->tpl_vars['city']->value;?>
,district:<?php echo $_smarty_tpl->tpl_vars['district']->value;?>
,
			subdistrict:<?php echo $_smarty_tpl->tpl_vars['subdistrict']->value;?>
,neighborhood:<?php echo $_smarty_tpl->tpl_vars['neighborhood']->value;?>
},
			function(data)
			{
				var data = json_decode(data);
				if(data.error==0)
				{
					alertMsg(data.data);
					setTimeout("$('#region').submit();",1000);
				}
					if(data.error==1)
					{
					/* 弹出错误提示 */
					alertMsg(data.data);
					}
			});
		}
	}
	function viewUpdateRegion(id)
	{
		var updateregion = new UpdateRegion(id);
		updateregion.viewUpdateRegion();
	}
	function cancelUpdateRegion(id)
	{
		var updateregion = new UpdateRegion(id);
		updateregion.cancelUpdateRegion();
	}
	function doUpdateRegion(id)
	{
		var updateregion = new UpdateRegion(id);
		updateregion.doUpdateRegion();
	}
	function deleteRegion(id)
	{
		var updateregion = new UpdateRegion(id);
		updateregion.deleteRegion();
	}
</script>
 <div class="clear height5"></div>
 <table class="info_list" cellspacing="1">
 <?php if ($_smarty_tpl->tpl_vars['community_list']->value){?>
 	<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['community_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
   <tr>
    <td><?php echo $_smarty_tpl->tpl_vars['c']->value['community_name'];?>
</td>
   </tr>
   <?php } ?>
   
 <?php }else{ ?> 
  <?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['regionlist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
?>
   <tr>
    <td width="80%" align="center">
    	<span id="region_text_<?php echo $_smarty_tpl->tpl_vars['r']->value['region_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['r']->value['region_name'];?>
</span>
    	<span id="region_input_<?php echo $_smarty_tpl->tpl_vars['r']->value['region_id'];?>
" style="display:none">
	 	<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['region_name'];?>
" class="editinput" id="region_<?php echo $_smarty_tpl->tpl_vars['r']->value['region_id'];?>
" style="width:90%"">
	 	</span>
    </td>
	 <td width="20%" align="center">
    	   <div id="edit_view_<?php echo $_smarty_tpl->tpl_vars['r']->value['region_id'];?>
">
        	<a href="javascript:void(0);" onclick="javascript:viewUpdateRegion(<?php echo $_smarty_tpl->tpl_vars['r']->value['region_id'];?>
);">
	    		<img src="/templates/images/icon/icon_edit.gif" title="编辑">
	   		</a>&ensp;
	  		<a href="javascript:void(0)" onclick="javascript:deleteRegion(<?php echo $_smarty_tpl->tpl_vars['r']->value['region_id'];?>
);">
	    		<img src="/templates/images/icon/icon_trash.gif" title="删除">
	   		</a>
	   	</div>
         <div id="edit_act_<?php echo $_smarty_tpl->tpl_vars['r']->value['region_id'];?>
" style="display:none">
         	<input type="button" class="searchbutton" onclick="javascript:doUpdateRegion(<?php echo $_smarty_tpl->tpl_vars['r']->value['region_id'];?>
);" value="确 认">
         	<input type="button" class="searchbutton" onclick="javascript:cancelUpdateRegion(<?php echo $_smarty_tpl->tpl_vars['r']->value['region_id'];?>
);" value="取 消">
         </div>
    </td>
   </tr>
  <?php } ?>
  </table>
	<form action="/admin/region.php?act=new_region" id="new_region" method="post" enctype="multipart/form-data" class="form">
    	<div class="middle" style="margin-top:10px">
  			<input type="button" class="btn_primary" name="new_region" value="新建行政区划" onclick="showui()">
        	<input type="text" id="new_region_name" name="new_region_name" class="input" style="visibility:hidden;align:center;margin-left:5px;margin-right:5px" >
        	<input type="button" class="btn_primary" style="visibility:hidden" id="submit" value="提交" onclick="javascript:new_region_submit()">
         <input type="button" class="btn_primary" style="visibility:hidden" id="cancel" value="取消" onclick="hideui()">
		</div>
	</form>
	<script type="text/javascript">
	function showui()
	{
		
		document.getElementById("new_region_name").style.visibility="visible";
		document.getElementById("submit").style.visibility="visible";
		document.getElementById("cancel").style.visibility="visible";
	}
	function hideui()
	{
		document.getElementById("new_region_name").style.visibility="hidden";
		document.getElementById("submit").style.visibility="hidden";
		document.getElementById("cancel").style.visibility="hidden";
	}
	function new_region_submit()
	{
		$.post("/admin/region.php?act=new_region",{
		region_name:$("#new_region_name").val(),province:<?php echo $_smarty_tpl->tpl_vars['province']->value;?>
,city:<?php echo $_smarty_tpl->tpl_vars['city']->value;?>
,district:<?php echo $_smarty_tpl->tpl_vars['district']->value;?>
,
		subdistrict:<?php echo $_smarty_tpl->tpl_vars['subdistrict']->value;?>
,neighborhood:<?php echo $_smarty_tpl->tpl_vars['neighborhood']->value;?>
},
		function(data)
		{
			var data = json_decode(data);
			if(data.error==0)
			{
				alertMsg(data.data);
				setTimeout("$('#region').submit();",1000);
			}
				if(data.error==1)
				{
				/* 弹出错误提示 */
				alertMsg(data.data);
				}
		});
	}
</script>
 <?php }?><?php }} ?>