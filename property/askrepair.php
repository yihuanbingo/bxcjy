<?php
/*
 * 报修申请
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);

require("../includes/init.php");
require('includes/cls_property.php');
Property::checkUserLogin();

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'default' ;
$community_id = $_SESSION['property']['community_id'];

/* 提取报修记录 */
if($act=='default')
{
   $status = isset($_REQUEST['status']) ? intval($_REQUEST['status']): 0 ;
   $pageNow = isset($_REQUEST['page']) ? intval($_REQUEST['page']): 1;
   $pageNum = 10;
   $log = Property::getAskrepairLog($community_id,$pageNow,$pageNum,$status);
   $pages = Property::setPage($pageNum,$pageNow,$log['resNum']); 
   $smarty->assign('status',$status);
   $smarty->assign('log',$log);
   $smarty->assign('pages',$pages);
}
/* 回复 */
elseif($act=='reply')
{
   $ask_id = isset($_POST['ask_id']) ? intval($_POST['ask_id']): 0;
   $reply = isset($_POST['reply']) ? $Common->charFormat($_POST['reply']): '';
   if(empty($reply))
   {
      $msg = array(
	  'error'=>1,
	  'data'=>'请输入回复内容',
	  );
   }
   else
   {
      $ask_id = $Mysql->getOne("select ask_id from ".$Base->table('askrepair')." where ask_id=$ask_id and community_id=$community_id");
      if($ask_id)
      {
         $data = array('reply'=>$reply,'status'=>1,'reply_time'=>time());
		 $table = $Base->table('askrepair');
		 $where = array('ask_id'=>$ask_id);
		 if($Mysql->update($data,$table,$where))
		 {
		    $msg = array(
			'error'=>0,
			'data'=>'回复成功',
			'href'=>'/property/askrepair?status=1',
			);
		 }
      }
   }
   $msg = $Json->encode($msg);
   echo $msg;
   exit;
}
/* 修改报修电话 */
elseif($act=='phone')
{
    $key = isset($_POST['key']) ? $Common->charFormat($_POST['key']): '' ;
	if($key == 'change')
	{
		$repair_phone = isset($_POST['repair_phone']) ? $Common->charFormat($_POST['repair_phone']) : '';
		$repair_mobile = isset($_POST['repair_mobile']) ? $Common->charFormat($_POST['repair_mobile']) : ''; 
		if(empty($repair_phone))
		{
		   $msg = array(
		    'error'=>1,
		    'data'=>'请输入报修电话',
		   );
		}
		elseif(empty($repair_mobile))
		{
		   $msg = array(
		    'error'=>1,
			'data'=>'请输入接收通知的手机',
		   );
		}
		elseif(!$Common->is_mobile($repair_mobile))
		{
		   $msg = array(
		    'error'=>1,
			'data'=>'接收通知的手机号格式不正确',
		   );
		}
		else
		{
			$data = array(
			         'repair_phone'=>$repair_phone,
					 'repair_mobile'=>$repair_mobile
					);
			$table = $Base->table('community');
			$where = array('community_id'=>$community_id);
			if($Mysql->update($data,$table,$where))
			{
				$msg = array(
				'error'=>0,
				'data'=>'修改成功',
				'href'=>'/property/askrepair?act=phone',
				);
			}
		}
		$msg = $Json->encode($msg);
		echo $msg;
		exit;
	}
	else
	{  
		$repair = $Mysql->getRow("select repair_phone, repair_mobile from ".$Base->table('community')." where community_id = ".$community_id); 
		$smarty->assign('repair',$repair);
	}
}

$smarty->assign('act',$act);
$smarty->assign('nav','askrepair');
chdir('../');
$smarty->display("property/askrepair.htm");

?>