<?php
/*
 * 投诉建议
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);

require("../includes/init.php");
require('includes/cls_property.php');
Property::checkUserLogin();

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'default' ;
$community_id = $_SESSION['property']['community_id'];

/* 投诉建议记录 */
if($act=='default')
{
   $status = isset($_REQUEST['status']) ? intval($_REQUEST['status']): 0 ;
   $pageNow = isset($_REQUEST['page']) ? intval($_REQUEST['page']): 1;
   $pageNum = 10;
   $log = Property::getAdviceLog($community_id,$pageNow,$pageNum,$status);
   $pages = Property::setPage($pageNum,$pageNow,$log['resNum']); 
   $smarty->assign('status',$status);
   $smarty->assign('log',$log);
   $smarty->assign('pages',$pages);
}
/* 回复 */
elseif($act=='reply')
{
   $advice_id = isset($_POST['advice_id']) ? intval($_POST['advice_id']): 0;
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
      $advice_id = $Mysql->getOne("select advice_id from ".$Base->table('advice')." where advice_id=$advice_id and community_id=$community_id");
      if($advice_id)
      {
         $data = array('reply'=>$reply,'status'=>1,'reply_time'=>time());
		 $table = $Base->table('advice');
		 $where = array('advice_id'=>$advice_id);
		 if($Mysql->update($data,$table,$where))
		 {
		    $msg = array(
			'error'=>0,
			'data'=>'回复成功',
			'href'=>'/property/advice?status=1',
			);
		 }
      }
   }
   $msg = $Json->encode($msg);
   echo $msg;
   exit;
}
/* 修改投诉建议电话 */
elseif($act=='phone')
{
    $key = isset($_POST['key']) ? $Common->charFormat($_POST['key']): '' ;
	if($key == 'change')
	{
		$advice_phone = isset($_POST['advice_phone']) ? $Common->charFormat($_POST['advice_phone']) : '';
		$advice_mobile = isset($_POST['advice_mobile']) ? $Common->charFormat($_POST['advice_mobile']) : ''; 
		if(empty($advice_phone))
		{
		   $msg = array(
		    'error'=>1,
		    'data'=>'请输入投诉/建议电话',
		   );
		}
		elseif(empty($advice_mobile))
		{
		   $msg = array(
		    'error'=>1,
			'data'=>'请输入接收通知的手机',
		   );
		}
		elseif(!$Common->is_mobile($advice_mobile))
		{
		   $msg = array(
		    'error'=>1,
			'data'=>'接收通知的手机号格式不正确',
		   );
		}
		else
		{
			$data = array(
			         'advice_phone'=>$advice_phone,
					 'advice_mobile'=>$advice_mobile
					);
			$table = $Base->table('community');
			$where = array('community_id'=>$community_id);
			if($Mysql->update($data,$table,$where))
			{
				$msg = array(
				'error'=>0,
				'data'=>'修改成功',
				'href'=>'/property/advice?act=phone',
				);
			}
		}
		$msg = $Json->encode($msg);
		echo $msg;
		exit;
	}
	else
	{  
		$advice = $Mysql->getRow("select advice_phone, advice_mobile from ".$Base->table('community')." where community_id = ".$community_id); 
		$smarty->assign('advice',$advice);
	}
}

$smarty->assign('act',$act);
$smarty->assign('nav','advice');
chdir('../');
$smarty->display("property/advice.htm");

?>