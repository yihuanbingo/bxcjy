<?php /* Smarty version Smarty-3.1.7, created on 2014-07-14 09:37:15
         compiled from "./templates/property/intro.htm" */ ?>
<?php /*%%SmartyHeaderCode:200501302753c3344b0e8757-38170516%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b87fdb6bcf544841756884865a2d9f87a29aa974' => 
    array (
      0 => './templates/property/intro.htm',
      1 => 1403441759,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '200501302753c3344b0e8757-38170516',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'act' => 0,
    'province' => 0,
    'city' => 0,
    'district' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_53c3344b1dbe0',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c3344b1dbe0')) {function content_53c3344b1dbe0($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('property/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


	<div class="col_main">
	  <div class="main_hd">
	    <div class="title_tab">
		  <ul class="tab_navs">
		    <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='default'){?>class="selected"<?php }?>><a href="/property/intro">小区信息</a></li>
		    <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='qrscene'){?>class="selected"<?php }?>><a href="/property/intro?act=qrscene">二维码下载</a></li>
		  </ul>
		</div>
	  </div>
	
<div class="main_content">	  
<?php if ($_smarty_tpl->tpl_vars['act']->value=='default'){?>  
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
	   var html = "<option>请选择所在省/直辖市</option>";
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
	   var html = "<option>请选择所在城市</option>";
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
	   }
	   $("#city").html(html);
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
	   var html = "<option>请选择所在区县</option>";
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
	   }
	   $("#district").html(html);
   }); 
}

function setProvince(province)
{
   setCity(province);
   setDistrict(0);
}

getProvince();
setCity(<?php echo $_smarty_tpl->tpl_vars['province']->value;?>
);
setDistrict(<?php echo $_smarty_tpl->tpl_vars['city']->value;?>
);
</script>
  <script type="text/javascript" src="/includes/kindeditor/kindeditor-min.js"></script>
  <script type="text/javascript" src="/includes/kindeditor/lang/zh_CN.js"></script> 
  <script type="text/javascript">
	  var editor;
	  KindEditor.ready(function(K) {
		editor = K.create('textarea[name="intro"]', {
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
			uploadJson : '/uploadimg.php?act=intro',
		 	items : ['image','fontsize','bold','forecolor', 'hilitecolor','italic', 'underline', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist','insertunorderedlist']
		});
	  });
  </script>
  <form action="/property/intro" method="post" enctype="multipart/form-data" id="intro" class="form">
   <p class="f_title">小区名称：<span class="color999 fontSize12">（小区名称不多于32个字符）</span>
   <p class="f_content"><input type="text" name="community_name" class="input" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['community_name'];?>
" />
   <p class="f_title">物业名称：<span class="color999 fontSize12">（物业名称不多于32个字符）</span>
   <p class="f_content"><input type="text" name="property_name" class="input" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['property_name'];?>
" />
   <p class="f_title">所在地区：<span class="color999 fontSize12">（小区所在省市区）</span>
   <p class="f_content">
    <select id="province" name="province" onchange="javascript:setProvince(this.value);">
	 <option value="0">请选择所在省/直辖市</option>
	</select>
	<select id="city" name="city" onchange="javascript:setDistrict(this.value);">
	 <option value="0">请选择所在城市</option>
	</select>
	<select id="district" name="district">
	 <option value="0">请选择所在区县</option>
	</select>
   <p class="f_title">详细地址：<span class="color999 fontSize12">（小区详细地址）</span>
   <p class="f_content"><input type="text" name="address" class="input" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['address'];?>
"/>
   <p class="f_title">小区介绍：<span class="color999 fontSize12">（物业配套，交通配套，生活服务等）</span>
   <p class="f_content"><textarea name="intro" style="width:100%;height:200px"><?php echo $_smarty_tpl->tpl_vars['row']->value['intro'];?>
</textarea>
   <input type="hidden" name="lng" id="lng" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['lng'];?>
">
   <input type="hidden" name="lat" id="lat" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['lat'];?>
">
   <input type="hidden" name="act" value="act_default">

  <style type="text/css"> 
   #l-map {
    width: 605px;
    height: 320px;
    margin-top: 10px;
   }
  </style>
  <script src="http://api.map.baidu.com/api?v=1.5&ak=1b0ace7dde0245f796844a06fb112734"></script>
  <form action="" method="post" id="lbsForm" class="form" >									
	 <p class="f_title">地图标识：<span class="color999 fontSize12">（为方便业主绑定，请设置小区的经纬度）</span>												
	 <p class="f_content"><input type="text" id="micro_estate_setaddr" class="input float_l" style="margin-right:5px" required="required"/>	
	 <input type="button" class="btn" value="搜索" id="positioning">
	 <div id="l-map">
		<i class="icon-spinner icon-spin icon-large">地图加载中...</i>
	 </div>	
	 <div class="clear height5"></div>
	 <p class="f_content"> 
   经度：
   <input type="text" value="<?php if (empty($_smarty_tpl->tpl_vars['row']->value['lng'])){?>116.403694<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['row']->value['lng'];?>
<?php }?>" id="micro_estate_setjd" class="input" style="width:100px"/>	&ensp;			     
   纬度：
   <input type="text" value="<?php if (empty($_smarty_tpl->tpl_vars['row']->value['lat'])){?>39.916042<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['row']->value['lat'];?>
<?php }?>" id="micro_estate_setwd" class="input" style="width:100px"/>			
   </form>
   <p class="f_title"><input type="button" class="btn_primary" value="确认编辑" onclick="javascript:AjaxSubmit('intro');">
  </form>
   <script type="text/javascript">
	//是否从未保存过定位信息，如果从未保存过，并且有填地址信息，那么进入页面后自动定位
	var located = true;
	//定位坐标
	var destPoint = new BMap.Point($('#micro_estate_setjd').val(),$('#micro_estate_setwd').val());
	$(function(){		
		/**开始处理百度地图**/
		var map = new BMap.Map("l-map");
		map.centerAndZoom(new BMap.Point(destPoint.lng, destPoint.lat), 12);//初始化地图
		map.enableScrollWheelZoom();
		map.addControl(new BMap.NavigationControl());
		var marker = new BMap.Marker(destPoint);
		map.addOverlay(marker);//添加标注
		map.addEventListener("click", function(e){
			if(confirm("确认选择这个位置？")){
				destPoint = e.point;
				$('#micro_estate_setjd').val(destPoint.lng);
				$('#lng').val(destPoint.lng);
				$('#micro_estate_setwd').val(destPoint.lat);
				$('#lat').val(destPoint.lat);
				map.clearOverlays();
				var marker1 = new BMap.Marker(destPoint);  // 创建标注
				map.addOverlay(marker1); 
			}
		});
		
		var myValue;

		var local;
		function setPlace(){
		    map.clearOverlays();    //清除地图上所有覆盖物
		    local = new BMap.LocalSearch(map, { //智能搜索
		      renderOptions:{ map: map}
		    });
		    located = true;
		    local.setMarkersSetCallback(callback);
		    local.search(myValue);
		}
		
		function addEventListener(marker){
			marker.addEventListener("click", function(data){
				destPoint = data.target.getPosition(0);
			});
		}
		function callback(posi){
			$("#micro_estate_setaddr").removeAttr("disabled");
			for(var i=0;i<posi.length;i++){
				if(i==0){
					destPoint = posi[0].point;
				}
				posi[i].marker.addEventListener("click", function(data){
					destPoint = data.target.getPosition(0);
				});  
			}
		}
		
		$("#positioning").click(function(){
			if($("#micro_estate_setaddr").val() == ""){
				alert("请输地址！");
				return ;
			}
			$("#locate-btn").prop("disabled",true);
			local = new BMap.LocalSearch(map, { //智能搜索
				renderOptions:{ map: map}
			});
			located = true;
			local.setMarkersSetCallback(callback);
			local.search($("#micro_estate_setaddr").val());
			return false;
		});
		
		 $("#lbsForm").submit(function(){
			var cansv= true;
			$(this).find('input[type="text"],select,textarea').filter('[required="required"]').each(function(){
				if($.trim($(this).val())==''){
					cansv = false;
					$(this).css('backgroundColor','yellow');
					$(this).one('focus',function(){
						$(this).css('backgroundColor','transparent');
					});
				}
			});
			if(!cansv){
				tusi('请将信息填写完整');
			}
	    	return cansv;
	    });
	});	
	</script>
 <?php }?>
 
 <?php if ($_smarty_tpl->tpl_vars['act']->value=='qrscene'){?>
   <img src="http://xiaoqu.bangsoon.cn/property/intro?act=getqrscene">
 <?php }?>
 
</div>
</div>
<?php }} ?>