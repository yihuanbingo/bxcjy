<?php
/*
 * 小区管理
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);

require("../includes/init.php");
require('includes/cls_admin.php');
//Admin::checkAdminLogin();

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'list' ;
$aid = $_SESSION['admin']['aid'];

/* 小区列表 */
if($act=='list')
{
   $pageNow = isset($_REQUEST['page']) ? intval($_REQUEST['page']): 1 ;
   $pageNum = 10;
   $list = Admin::getCommunityList($pageNow, $pageNum);
   $pages = Admin::setPage($pageNum,$pageNow,$list['resNum']);
   $smarty->assign('list',$list);
   $smarty->assign('pages',$pages);
}
/* 切换到物业后台 */
elseif($act=='switch')
{
   $cid = isset($_REQUEST['cid']) ? intval($_REQUEST['cid']) : 0 ;
   if($cid>0)
   {
      $row = $Mysql->getRow("select community_id, account from ".$Base->table('community')." where community_id=$cid ");
	  if($row)
	  {
	     /* 小区存在，则直接赋值，并跳转 */
	     $_SESSION['property'] = $row;
		 $Common->base_header("Location:/property\n");
	  }
	  else
	  {
	     die('hacking attempt!');
	  }
   }
}
/* 新增小区 */
elseif($act=='new_community')
{
	//todo
	$key = isset($_REQUEST['key']) ? $Common->charFormat($_REQUEST['key']) : '';
	$community_name = isset($_POST['community_name']) ? $Common->charFormat($_POST['community_name']) : '';
	$property_name = isset($_POST['property_name']) ? $Common->charFormat($_POST['property_name']) : '';
	$province = isset($_POST['province']) ? intval($_POST['province']) : 0;
	$city = isset($_POST['city']) ? intval($_POST['city']) : 0;
	$district = isset($_POST['district']) ? intval($_POST['district']) : 0;
	$subdistrict = isset($_POST['subdistrict']) ? intval($_POST['subdistrict']) : 0;
	$neighborhood = isset($_POST['neighborhood']) ? intval($_POST['neighborhood']) : 0;
	$address = isset($_POST['address']) ? $Common->charFormat($_POST['address']) : '';
	$advice_phone = isset($_POST['advice_phone']) ? $Common->charFormat($_POST['advice_phone']) : '';
	$repair_phone = isset($_POST['repair_phone']) ? $Common->charFormat($_POST['repair_phone']) : '';
	$apply_id = isset($_REQUEST['apply_id']) ? intval($_REQUEST['apply_id']) : 0;
	if(empty($key))
	{

	}
	if($key=='do')
	{
		//新增操作
		if(empty($community_name))
		{
			$msg = array('error'=>1,'data'=>'请输入小区名称');
		}
		elseif($Mysql->getOne("select community_id from ".$Base->table('community')." where community_name = '".$community_name."'"))
		{
			$msg = array('error'=>1,'data'=>'小区名已存在');
		}
		elseif(empty($property_name))
		{
			$msg = array('error'=>1,'data'=>'请输入物业名称');
		}
		elseif($province==0 || $city==0 || $district==0 || $subdistrict==0 || $neighborhood==0)
		{
			$msg = array('error'=>1,'data'=>'请选择所在省市区街道办社区');
		}
		elseif(empty($address))
		{
			$msg = array('error'=>1,'data'=>'请输入小区地址');
		}
		elseif(empty($advice_phone))
		{
			$msg = array('error'=>1,'data'=>'请输入投诉建议电话');
		}
		elseif(empty($repair_phone))
		{
			$msg = array('error'=>1,'data'=>'请输入报修申请电话');
		}
		else
		{
			$data = array('community_name'=>$community_name,'property_name'=>$property_name,
			'province'=>$province,'city'=>$city,'district'=>$district,'subdistrict'=>$subdistrict,'neighborhood'=>$neighborhood,
			'address'=>$address,'advice_phone'=>$advice_phone,'repair_phone'=>$repair_phone);
			$table = $Base->table('community');
			if($apply_id>0)
			{
				$data_apply = array('status'=>1);
				$table_apply = $Base->table('community_apply');
				$where_apply = array('apply_id'=>$apply_id);
				$Mysql->update($data_apply,$table_apply,$where_apply);
			}
			if($Mysql->insert($data,$table))
			{
				$msg = array('error'=>0,'data'=>'新增成功','href'=>'/admin/community.php');
			}
		}
		$msg = $Json->encode($msg);
		echo $msg;
		exit;
	}
	$smarty->assign('apply_id',$apply_id);
}
elseif($act=='community_apply')
{
   $pageNow = isset($_REQUEST['page']) ? intval($_REQUEST['page']): 1 ;
   $pageNum = 10;
   $list = Admin::getCommunityApplyList($pageNow, $pageNum);
   $pages = Admin::setPage($pageNum,$pageNow,$list['resNum']);
   $smarty->assign('applylist',$list);
   $smarty->assign('pages',$pages);
}
elseif($act=='delete_apply')
{
	$apply_id = $_REQUEST['apply_id'] ? intval($_REQUEST['apply_id']) : 0;
	if($apply_id>0)
	{
		if($Mysql->query("delete from ".$Base->table('community_apply')." where apply_id = ".$apply_id))
		{
			header("Location: /admin/community.php?act=community_apply");
		}
	}
}
$smarty->assign('act',$act);
$smarty->assign('nav','community');
chdir('../');
$smarty->display("admin/community.htm");

?>