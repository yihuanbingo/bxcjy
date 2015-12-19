<?php
/*
 * 通知管理
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);
require("../includes/init.php");
require("includes/cls_property.php");
Property::checkUserLogin();

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'default' ;
$community_id = $_SESSION['property']['community_id'];

/* 发新通知界面 */
if($act=='default')
{
	$key = isset($_REQUEST['key']) ? $Common->charFormat($_REQUEST['key']): 'default' ;
	$notice_id = isset($_REQUEST['notice_id']) ? intval($_REQUEST['notice_id']): 0;
   if($key=='update')
	{
		$notice_id = isset($_REQUEST['notice_id']) ? intval($_REQUEST['notice_id']): 0;
		$notice = $Mysql->getRow("select * from ".$Base->table('notice')." where notice_id=$notice_id and community_id=$community_id");
		$smarty->assign('notice',$notice);
		$smarty->assign('key',$key);
	}
}
/* 发新通知操作 */
elseif($act=='send_notice')
{
	$key = isset($_REQUEST['key']) ? $Common->charFormat($_REQUEST['key']): 'default' ;
	$title = isset($_POST['title']) ? $Common->charFormat($_POST['title']): '';
	$content = isset($_POST['content']) ? $_POST['content'] : '';
	$notice_id = isset($_REQUEST['notice_id']) ? intval($_REQUEST['notice_id']): 0;
	if(empty($title))
	{
		 $msg = array('error'=>1,'data'=>'通知标题不能为空！');
	}
	elseif(empty($content))
	{
		 $msg = array('error'=>1,'data'=>'通知详情不能为空！');
	}
	else
	{
		 $table = $Base->table('notice');
		 $data = array(
		'community_id'=>$community_id,
		'title'=>$title,
		'content'=>$content,
		'add_time'=>time(),
		);
		if($key=='default')
		{
			if($Mysql->insert($data,$table))
			{
				$msg = array('error'=>0,'data'=>'通知发送成功！','href'=>'/property/notice?act=log');
			}
			else
			{
				$msg = array('error'=>1,'data'=>'系统出错！');
			}
		}
		elseif($key=='update')
		{
			$where = array('notice_id'=>$notice_id);
			if($Mysql->update($data,$table,$where))
			{
				$msg = array('error'=>0,'data'=>'通知修改成功！','href'=>'/property/notice?act=log');
			}
			else
			{
				$msg = array('error'=>1,'data'=>'系统出错！');
			}
		}
	}
   $msg = $Json->encode($msg);
   echo $msg;
   exit;
}
/* 通知记录 */
elseif($act=='log')
{
   $pageNow = isset($_REQUEST['page']) ? intval($_REQUEST['page']): 1;
   $pageNum = 10;
   $log = Property::getNoticeLog($community_id,$pageNow,$pageNum);
   $pages = Property::setPage($pageNum,$pageNow,$log['resNum']); 
   $smarty->assign('log',$log);
   $smarty->assign('pages',$pages);
}
/* 预览 */
elseif($act=='preview')
{
   $notice_id = isset($_REQUEST['notice_id']) ? intval($_REQUEST['notice_id']): 0;
   $notice = $Mysql->getRow("select * from ".$Base->table('notice')." where notice_id=$notice_id and community_id=$community_id");
   if(!empty($notice))
   {
      $notice['add_time'] = date('Y-n-d',$notice['add_time']);
      $smarty->assign('notice',$notice);
   }
}
/* 删除 */
elseif($act=='delete')
{
   $notice_id = isset($_REQUEST['notice_id']) ? intval($_REQUEST['notice_id']): 0;
   $content = $Mysql->getOne("select content from ".$Base->table('notice')." where notice_id=$notice_id and community_id=$community_id"); 
   if(!empty($content))
   { 
      $pic = $Common->get_pic_html($content);  //信息中所有图片  
	  chdir('../');
	  foreach($pic as $v)
	  {
		 @unlink(substr($v,1));           //删除图片
	  } 
	  $Mysql->query("delete from ".$Base->table('notice')." where notice_id=$notice_id ");
	  $Common->base_header("Location:/property/notice?act=log\n");
   }
}
$smarty->assign('act',$act);
$smarty->assign('nav','notice');
chdir('../');
$smarty->display("property/notice.htm");

?>