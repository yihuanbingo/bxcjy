<?php
/*
 * 短信群发
 * author yuanjiang @2.16.2013
*/
define("IN_WD",true);
define("IN_BS",true);
require("../includes/init.php");
require("../includes/snoopy.php");
require('includes/cls_admin.php');
//Admin::checkAdminLogin();

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'default' ;
$aid = $_SESSION['admin']['aid'];

/* 短信群发 */
if($act=='default')
{
	$res = $Mysql->getAll("select community_id,community_name from ".$Base->table('community'));
	$smarty->assign('community',$res);	
}
if($act=='excel')
{
	//todo
}
elseif($act=='community_send')
{
	$community_id = isset($_POST['community']) ? intval($_POST['community']) : 0;
	$content = isset($_POST['content']) ? $Common->charFormat($_POST['content']) : '';
	$msg = array('error'=>1,'data'=>'系统错误');
	if($community_id!=0)
	{
		$res = $Mysql->getAll("select mobile from ".$Base->table('householder')." where community_id = ".$community_id);
		foreach($res as $k=>$v)
		{
			$phone = $phone.",".$Common->charFormat($v['mobile']);
			
		}
		$snoopy = new snoopy();
		$sendurl = "http://{$smsapi}/sms?u={$user}&p={$pass}&m={$phone}&c=".urlencode($content);
		$snoopy->fetch($sendurl);
		$result = $snoopy->results;
		$msg = array('error'=>0,'data'=>'发送成功','url'=>'/admin/message.php');
	}
	$msg = $Json->encode($msg);
	echo $msg;
	exit;
}
elseif($act=='excel_send')
{
	$content = isset($_POST['content']) ? $Common->charFormat($_POST['content']) : '';
   $file_tmp = isset($_FILES['phone']) ? $_FILES['phone'] : '' ;
	$msg = array('error'=>1,'data'=>'仅允许上传xls（excel2003）文件');
   if(!empty($file_tmp))   //有上传excel文件
   {  
		$file = $file_tmp['tmp_name'];
	   $file_type = $file_tmp['type'];
      /* 允许上传的文件类型 */
      if(!Admin::check_excel_type($file_type)) 
		{  
	     $msg = array('error'=>1,'data'=>'仅允许上传xls（excel2003）文件');
		}
		else 
		{
         require('../includes/excel/reader.php');
         $xls = new Spreadsheet_Excel_Reader(); 
         $xls->setOutputEncoding('utf-8');  //设置编码 
         $xls->read($file);  //解析文件
			$res = $xls->sheets[0]['cells'];
			$title = current($res);
			if($Common->charFormat($title[1])!='姓名' || $Common->charFormat($title[2])!='电话')
			{ 
				$msg = array('error'=>1,'data'=>'excel格式须为 姓名|电话 ');
			}
			else
			{
				foreach($res as $k=>$v)
				{
					$name = $Common->charFormat($v[1]);
					$phone_number = $Common->charFormat($v[2]);
					$phone = $phone.",".$phone_number;
				}
				$snoopy = new snoopy();
				$sendurl = "http://{$smsapi}/sms?u={$user}&p={$pass}&m={$phone}&c=".urlencode($content);
				$snoopy->fetch($sendurl);
				$result = $snoopy->results;
				$msg = array('error'=>0,'data'=>'发送成功','url'=>'/admin/message.php?act=excel');
			}
		}
	}
	$msg = $Json->encode($msg);
	echo $msg;
	exit;
}
$smarty->assign('nav','message'); 
$smarty->assign('act',$act);
chdir('../');
$smarty->display('admin/message.htm');
?>