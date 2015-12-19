<?php
/*
 * 账户管理
 * author zoubin @2.16.2013
*/
define("IN_BS",true);

require("../includes/init.php");
require('includes/cls_admin.php');
//Admin::checkAdminLogin();

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'default' ;
$aid = $_SESSION['admin']['aid'];

/* 账户列表 */
if($act=='default')
{
	//todo
	$pageNow = isset($_REQUEST['page']) ? intval($_REQUEST['page']): 1 ;
	$pageNum = 10;
	$list = Admin::getAccoutList($pageNow,$pageNum);
	$pages = Admin::setPage($pageNum,$pageNow,$list['resNum']);
	$smarty->assign('list',$list);
	$smarty->assign('pages',$pages);
}
/* 新建账户 */
if($act=='new_account')
{
	$key = isset($_REQUEST['key']) ? $Common->charFormat($_REQUEST['key']) : '';
	if(empty($key))
	{
		$community = $Mysql->getAll("select community_id,community_name from ".$Base->table('community'));
		$smarty->assign('community',$community);
	}
	elseif($key=='do_add')
	{
		$msg = array("error"=>1,"data"=>"asd");
		$account = isset($_POST['account']) ? $Common->charFormat($_POST['account']) : '';
		$community_id = isset($_POST['community_id']) ? intval($_POST['community_id']) : 0;
		$passwd = $Common->md5Code("123456");
		$type = isset($_POST['type']) ? intval($_POST['type']) : 0;
		if(empty($account))
		{
			$msg = array('error'=>1,'data'=>'请输入账号');
		}
		elseif($Mysql->getOne("select account_id from ".$Base->table('account')." where account = '".$account."'"))
		{
			$msg = array("error"=>1,"data"=>"账户名已存在");
		}
		elseif($community_id==0)
		{
			$msg = array("error"=>1,"data"=>"请选择小区");
		}
		else
		{
			$data = array('account'=>$account,'passwd'=>$passwd,'type'=>$type,'community_id'=>$community_id);
			$table = $Base->table('account');
			if($Mysql->insert($data,$table))
			{
				$msg = array("error"=>0,"data"=>"新建成功","href"=>"/admin/account.php");
			}
		}
		$msg = $Json->encode($msg);
   		echo $msg;
   		exit;
	}
}
/* 删除账户 */
elseif($act=='delete_account')
{
	$account_id = isset($_POST['account_id']) ? $_POST['account_id'] : 0;
	$msg = array("error"=>1,"data"=>"系统错误，请重试");
	$sql = "delete from ".$Base->table('account')." where account_id = ".$account_id;
	if($Mysql->query($sql))
	{
		$msg = array("error"=>0,"data"=>"删除成功");
	}
	$msg = $Json->encode($msg);
	echo $msg;
	exit;
}
$smarty->assign('act',$act);
$smarty->assign('nav','account');
chdir('../');
$smarty->display("admin/account.htm");

?>