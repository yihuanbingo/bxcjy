<?php
/*
 * 行政区划管理
*/
define("IN_BS",true);

require("../includes/init.php");
require('includes/cls_admin.php');
//Admin::checkAdminLogin();

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']) : 'region' ;
$province = isset($_POST['province']) ? intval($_POST['province']) : 0;
$city = isset($_POST['city']) ? intval($_POST['city']) : 0;
$district = isset($_POST['district']) ? intval($_POST['district']) : 0;
$subdistrict = isset($_POST['subdistrict']) ? intval($_POST['subdistrict']) : 0;
$neighborhood = isset($_POST['neighborhood']) ? intval($_POST['neighborhood']) : 0;
if($act=='region')
{
	//todo
}
/* 查看行政区划 */
if($act=='act_region')
{
	//todo
	$arr = Admin::getRegionList($province,$city,$district,$subdistrict,$neighborhood);
	if($neighborhood>0)
	{
		$smarty->assign('community_list',$arr['community_list']);
	}
	elseif($subdistrict>0)
	{
		$smarty->assign('regionlist',$arr['neighborhood_list']);
	}
	elseif($district>0)
	{
		$smarty->assign('regionlist',$arr['subdistrict_list']);
	}
	elseif($city>0)
	{
		$smarty->assign('regionlist',$arr['district_list']);
	}
	elseif($province>0)
	{
		$smarty->assign('regionlist',$arr['city_list']);
	}
	else
	{
		$smarty->assign('regionlist',$arr['province_list']);
	}
	$smarty->assign('selectlist',$arr);
	
}
/* 编辑行政区划 */
if($act=='update_region')
{
	//todo
	$msg = array('error'=>1,'data'=>'系统出错，请重试');	
	$region_name = isset($_POST['region_name']) ? $Common->charFormat($_POST['region_name']) : '';
	$region_id = isset($_POST['region_id']) ? intval($_POST['region_id']) : 0;
	$data = array('region_name'=>$region_name);
	$table = $Base->table('region');
	$where = array('region_id'=>$region_id);
	if($Mysql->update($data,$table,$where))
	{
		$msg = array('error'=>0,'data'=>'修改成功','province'=>$province,'city'=>$city,'district'=>$district,'subdistrict'=>$subdistrict,'neighborhood'=>$neighborhood);
	}
	$msg = json_encode($msg);
	echo $msg;
	exit;
}
/* 删除行政区划 */
if($act=='delete_region')
{
	//todo
	$msg = array('error'=>1,'data'=>'系统出错，请重试');	
	$region_id = isset($_REQUEST['region_id']) ? intval($_REQUEST['region_id']) : 0;
	$sql = "delete from ".$Base->table('region')." where region_id = ".$region_id;
	if($Mysql->query($sql))
	{
		$msg = array('error'=>0,'data'=>'删除成功','province'=>$province,'city'=>$city,'district'=>$district,'subdistrict'=>$subdistrict,'neighborhood'=>$neighborhood);
	}
	$msg = json_encode($msg);
	echo $msg;
	exit;
}
/* 新建新政区划 */
if($act=='new_region')
{
	$msg = array('error'=>1,'data'=>'系统出错，请重试');
	$region_name = isset($_POST['region_name']) ? $Common->charFormat($_POST['region_name']) : '';
	/*if($neighborhood>0)
	{
		$data = array('region_name'=>$region_name);
	}*/
	if($region_name=='')
	{
		$msg = array('error'=>1,'data'=>'请填写地区名');
	}
	else
	{
		if($subdistrict>0)
		{
			$data = array('region_name'=>$region_name,'parent_id'=>$subdistrict,'region_type'=>5);
		}
		elseif($district>0)
		{
			$data = array('region_name'=>$region_name,'parent_id'=>$district,'region_type'=>4);
		}
		elseif($city>0)
		{
			$data = array('region_name'=>$region_name,'parent_id'=>$city,'region_type'=>3);
		}
		elseif($province>0)
		{
			$data = array('region_name'=>$region_name,'parent_id'=>$province,'region_type'=>2);
		}
		else
		{
			$data = array('region_name'=>$region_name,'parent_id'=>0,'region_type'=>1);
		}
		$table = $Base->table('region');
		if($Mysql->insert($data,$table))
		{
			$msg = array('error'=>0,'data'=>'新建成功');
		}
	}	
	$msg = $Json->encode($msg);
	echo $msg;
	exit;
}
$smarty->assign('province',$province);
$smarty->assign('city',$city);
$smarty->assign('district',$district);
$smarty->assign('subdistrict',$subdistrict);
$smarty->assign('neighborhood',$neighborhood);
$smarty->assign('act',$act);
$smarty->assign('nav','region');
chdir('../');
$smarty->display("admin/region.htm");

?>