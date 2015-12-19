<?php
/*
 * 通知管理
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);
require("../includes/init.php");
require("includes/cls_represent.php");
represent::checkUserLogin();

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'default' ;
$community_id = $_SESSION['represent']['community_id'];

/* 发新通知界面 */
if($act=='default')
{
   //todo
}
/* 发新通知操作 */
elseif($act=='send_notice')
{
   $title = isset($_POST['title']) ? $Common->charFormat($_POST['title']): '';
   $content = isset($_POST['content']) ? $_POST['content'] : '';
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
	   if($Mysql->insert($data,$table))
	   {
	      $msg = array('error'=>0,'data'=>'通知发送正在发送，1个小时内完成','href'=>'/represent/notice?act=log');
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
   $log = represent::getNoticeLog($community_id,$pageNow,$pageNum);
   $pages = represent::setPage($pageNum,$pageNow,$log['resNum']); 
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
	  $Common->base_header("Location:/represent/notice?act=log\n");
   }
}
$smarty->assign('act',$act);
$smarty->assign('nav','notice');
chdir('../');
$smarty->display("represent/notice.htm");

?>