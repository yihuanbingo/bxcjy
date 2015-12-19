<?php /* Smarty version Smarty-3.1.7, created on 2015-12-12 16:52:44
         compiled from ".\templates\admin\community.htm" */ ?>
<?php /*%%SmartyHeaderCode:22533566be05ca0d607-20845897%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '17da325ef253fc69135975d87d031f559b964881' => 
    array (
      0 => '.\\templates\\admin\\community.htm',
      1 => 1405690586,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22533566be05ca0d607-20845897',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'act' => 0,
    'list' => 0,
    'l' => 0,
    'province' => 0,
    'city' => 0,
    'district' => 0,
    'subdistrict' => 0,
    'neighborhood' => 0,
    'substrict' => 0,
    'apply_id' => 0,
    'applylist' => 0,
    'h' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_566be05d1dbd3',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_566be05d1dbd3')) {function content_566be05d1dbd3($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('admin/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


	<div class="col_main">
	  <div class="main_hd">
	    <div class="title_tab">
		  <ul class="tab_navs">
		    <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='list'){?>class="selected"<?php }?>><a href="/admin/community.php">小区列表</a></li>
          <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='new_community'){?>class="selected"<?php }?>><a href="/admin/community.php?act=new_community">新增小区</a></li>
          <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='community_apply'){?>class="selected"<?php }?>><a href="/admin/community.php?act=community_apply">小区申请审核</a></li>
		  </ul>
		</div>
	  </div>

<div class="main_content">	 

<?php if ($_smarty_tpl->tpl_vars['act']->value=='list'){?>
<form action="/admin/community.php" method="get" enctype="multipart/form-data" name="search">
 <input type="hidden" name="page" value="1">
</form>
 <table class="info_list" cellspacing="1" width="100%">
 <tr>
  <th width="120px">小区名称</th>
  <th width="100px">所在省</th>
  <th width="100px">所在市</th>
  <th width="100px">所在区</th>
  <th>操作</th>
 </tr>
 <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value['res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value){
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
  <tr>
   <td><?php echo $_smarty_tpl->tpl_vars['l']->value['community_name'];?>
</td>
   <td><?php echo $_smarty_tpl->tpl_vars['l']->value['province'];?>
</td>
   <td><?php echo $_smarty_tpl->tpl_vars['l']->value['city'];?>
</td>
   <td><?php echo $_smarty_tpl->tpl_vars['l']->value['district'];?>
</td>
   <td><a href="/admin/community.php?act=switch&cid=<?php echo $_smarty_tpl->tpl_vars['l']->value['community_id'];?>
" target="_blank">调用权限</a></td>
  </tr>
 <?php } ?>
 </table>
<div class="clear height10"></div>
<div class="float_r">
<?php echo $_smarty_tpl->getSubTemplate ("admin/library/page.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['act']->value=='new_community'){?>
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
 <form action="/admin/community.php?act=new_community&key=do" method="post" enctype="multipart/form-data" id="new_community" class="form">
 	  <p class="f_title">小区名称：<span class="color999 fontSize12">（小区名称不多于30个字符）</span> 
     <p class="f_content"><input type="text" name="community_name" class="input">
 	  <p class="f_title">物业名称：<span class="color999 fontSize12">（物业名称不多于30个字符）</span> 
     <p class="f_content"><input type="text" name="property_name" class="input">
     <p class="f_title">
     <select id="province" name="province" onchange="javascript:setCity(this.value);">
     <option value="0">省/直辖市</option>
     </select>
     <select id="city" name="city" onchange="javascript:setDistrict(this.value);">
	  <option value="0">城市</option>
     </select>
     <select id="district" name="district" onchange="javascript:setSubdistrict(this.value)">
     <option value="0">区县</option>
     </select>
     <select id="subdistrict" name="subdistrict" onchange="javascript:setNeighborhood(this.value)">
	  <option value="0">街道办</option>
     </select>
     <select id="neighborhood" name="neighborhood">
	  <option value="0">社区</option>
     </select>
     <p class="f_title">详细地址：<span class="color999 fontSize12">（小区详细地址）</span>
     <p class="f_content"><input type="text" name="address" class="input">
     <p class="f_title">投诉建议电话：<span class="color999 fontSize12">（业主可见，可为座机号或手机号，支持一键拔打）</span> 
     <p class="f_content"><input type="text" name="advice_phone" class="input">
     <p class="f_title">报修申请电话：<span class="color999 fontSize12">（业主可见，可为座机号或手机号，支持一键拔打）</span> 
     <p class="f_content"><input type="text" name="repair_phone" class="input">
     <input name="apply_id" value="<?php echo $_smarty_tpl->tpl_vars['apply_id']->value;?>
" style="display:none">
     <p class="f_title"><input type="button" class="btn_primary" value="确认新增" onclick="javascript:AjaxSubmit('new_community');">
 </form>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['act']->value=='community_apply'){?>
<form action="/admin/community.php" method="get" enctype="multipart/form-data" name="search">
 <input type="hidden" name="act" value="community_apply">
 <input type="hidden" name="page" value="1">
</form>
 <table class="info_list" cellspacing="1" width="100%">
 <tr>
  <th width="18%">小区名称</th>
  <th width="35%">详细地址</th>
  <th width="8%">申请人姓名</th>
  <th width="10%">联系电话</th>
  <th width="12%">申请时间</th>
  <th width="7%">状态</th>
  <th width="10%">操作</th>
 </tr>
 <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['applylist']->value['res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value){
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
  <tr align="center">
   <td><?php echo $_smarty_tpl->tpl_vars['l']->value['community_name'];?>
</td>
   <td><?php echo $_smarty_tpl->tpl_vars['l']->value['address'];?>
</td>
   <td><?php echo $_smarty_tpl->tpl_vars['l']->value['contact_user'];?>
</td>
   <td><?php echo $_smarty_tpl->tpl_vars['l']->value['mobile'];?>
</td>
   <td><?php echo $_smarty_tpl->tpl_vars['l']->value['apply_time'];?>
</td>
   <td><?php if ($_smarty_tpl->tpl_vars['l']->value['status']==0){?><a href="/admin/community.php?act=new_community&apply_id=<?php echo $_smarty_tpl->tpl_vars['l']->value['apply_id'];?>
">待审核</a><?php }elseif($_smarty_tpl->tpl_vars['l']->value['status']==1){?>已通过<?php }?></td>
   <td>
  	<div id="edit_view_<?php echo $_smarty_tpl->tpl_vars['h']->value['cat_id'];?>
">
  		<?php if ($_smarty_tpl->tpl_vars['l']->value['status']==0){?>
		<a href="/admin/community.php?act=new_community&apply_id=<?php echo $_smarty_tpl->tpl_vars['l']->value['apply_id'];?>
">
		<img src="/templates/images/icon/icon_edit.gif" title="通过">
		</a>&ensp;
		<?php }?>
		<a href="/admin/community.php?act=delete_apply&apply_id=<?php echo $_smarty_tpl->tpl_vars['l']->value['apply_id'];?>
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