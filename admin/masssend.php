<?php
/*
 * 群发管理
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);

require("../includes/init.php");
require('includes/cls_admin.php');
//Admin::checkAdminLogin();

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'send' ;
$aid = $_SESSION['admin']['aid'];

/* 群发界面 */
if($act=='send')
{
   $sql = "select community_id, community_name from ".$Base->table('community')." order by community_id desc ";
   $res = $Mysql->getAll($sql);
   $smarty->assign('res',$res);
}
/* 群发操作 */
elseif($act=='act_send')
{
   $articles = isset($_POST['articles']) ? $Common->charFormat($_POST['articles']): '';
   $community_id = isset($_POST['community_id']) ? intval($_POST['community_id']): 0 ;
   $sendtime = isset($_POST['sendtime']) ? $Common->charFormat($_POST['sendtime']): '1970-01-01' ;
   if(empty($articles))
   {
      $msg = array('error'=>1,'data'=>'图文ID不能为空');
   }
   else
   {  
      $gids = explode('-',$articles);
	  foreach($gids as $k=>$v)
	  {
	     $single[$k] = $Mysql->getRow("select title, author, thumb_media_id, digest, content, content_source_url  from ".$Base->table('masssend_graphic')." where gid=$v ");
		 $single[$k]['title'] = urlencode($single[$k]['title']);
		 $single[$k]['author'] = urlencode($single[$k]['author']);
		 $single[$k]['digest'] = urlencode($single[$k]['digest']);
		 $scontent = $Common->set_pic_html($single[$k]['content']);
		 $single[$k]['content'] = str_replace('"',"'",$scontent);
		 $single[$k]['content'] =  urlencode($single[$k]['content']);
		 $single[$k]['show_cover_pic'] = 1;
	  } 
	  $ar['articles'] = $single; 
	  $ar = urldecode(stripslashes($Json->encode($ar)));    
	  $posturl = "https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token=";
	  include_once('../includes/cls_Wx.php'); 
	  $access_token = Wx::setAccess_token();
	  $posturl .= $access_token; 
	  $result = $Common->file_post($posturl,$ar); 
	  $result = $Json->decode($result); 
	  if($result->errcode>0)
	  {
	     $msg = array('error'=>1,'data'=>$result->errmsg);
	  }
	  else
	  {
	     //提取指定的openid列表
		 $sendtime = strtotime($sendtime);
		 $sql = "select openid from ".$Base->table('user')." where reg_time>$sendtime ";
		 if($community_id>0)
		 {
		    $sql .= "and community_id=$community_id ";
		 }
		 $openids = $Mysql->getAll($sql);
		 foreach($openids as $v)
		 {
		    $touser[] = $v['openid'];
		 } 
		 //$touser = array('ouzuvt1Pay8JlHfRb-nw9dRIgjj0','ouzuvt4fCq_E2UIARjr6CBi9oc2k');
		 $mpnews = array('media_id'=>$result->media_id);
		 $msgtype = "mpnews";
		 $data = array(
		 'touser'=>$touser,
		 'mpnews'=>$mpnews,
		 'msgtype'=>$msgtype
		 ); 
		 $data = $Json->encode($data); 
         $posturl = "https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=".$access_token;
		 $result = $Common->file_post($posturl,$data);
		 $result = $Json->decode($result);
		 if($result->errcode>0){
		    $msg = array('error'=>1,'data'=>$result->errmsg);
		 }
		 else{
		    $msg = array('error'=>0,'data'=>'群发成功，共发送 <font color="red">'.count($touser).'</font> 人');
		 }
	  }
   }
   $smarty->assign('msg',$msg);
}
/* 图文消息 */
elseif($act=='material')
{
   $gid = isset($_REQUEST['gid']) ? abs(intval($_REQUEST['gid'])): 'list' ;
   if($gid==='list')
   {
      $pageNow = 1;
	  $pageNum = 50;
	  $list = Admin::getGraphicList($pageNow,$pageNum);
	  $smarty->assign('list',$list);
   }
   else
   {
      /* 新增 */
      if($gid==0)
	  {
	  
	  }
	  /* 编辑 */
	  else
	  {
	     $desc = Admin::getGraphic($gid);
		 $smarty->assign('desc',$desc);
	  }
   } 
   $smarty->assign('gid',$gid);
}
/* 图文编辑、新增 */
elseif($act=='act_material')
{
   $gid = isset($_POST['gid']) ? intval($_POST['gid']) : 0 ;
   $parent_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : 0 ;
   $title = isset($_POST['title']) ? $Common->charFormat($_POST['title']): '' ;
   $author = isset($_POST['author']) ? $Common->charFormat($_POST['author']): '';
   $thumb_media_id = isset($_POST['thumb_media_id']) ? $Common->charFormat($_POST['thumb_media_id']): '' ;
   $digest = isset($_POST['digest']) ? $Common->charFormat($_POST['digest']) : '' ;
   $content = isset($_POST['content']) ? $_POST['content'] : '' ;
   $content_source_url = isset($_POST['content_source_url']) ? $_POST['content_source_url'] : '' ;
   if(empty($title))
   {
      $msg = array('error'=>1,'data'=>'标题不能为空');
   }
   elseif(empty($thumb_media_id))
   {
      $msg = array('error'=>1,'data'=>'封面图片ID不能为空');
   }
   elseif(empty($digest))
   {
      $msg = array('error'=>1,'data'=>'摘要不能为空');
   }
   elseif(empty($content))
   {
      $msg = array('error'=>1,'data'=>'正文不能为空');
   }
   else
   {
      $data = array(
	  'parent_id'=>$parent_id,
	  'title'=>$title,
	  'author'=>$author,
	  'thumb_media_id'=>$thumb_media_id,
	  'digest'=>$digest,
	  'content'=>$content,
	  'content_source_url'=>$content_source_url,
	  'created_at'=>time(),
	  );
	  $table = $Base->table('masssend_graphic');
      if($gid>0)   //更新
	  {
	     $where = array('gid'=>$gid);
	     if($Mysql->update($data,$table,$where))
		 {
		    $msg = array('error'=>0,'data'=>'更新成功，现在刷新','href'=>'/admin/masssend.php?act=material');   
		 }
	  }
	  else   //添加
	  {
	     if($Mysql->insert($data,$table))
		 {
		    $msg = array('error'=>0,'data'=>'添加成功，现在刷新','href'=>'/admin/masssend.php?act=material');
		 }
	  }
   }
   $msg = $Json->encode($msg);
   echo $msg;
   exit;   
}
/* 图片管理 */
elseif($act=='picture')
{			
   $pics = $Mysql->getAll("select * from ".$Base->table('masssend_pic')." order by pid desc ");
   foreach($pics as $k=>$v)
   {
      $pics[$k]['created_at'] = date('Y-m-d G:i:s',$v['created_at'] + 60*60*24*3 - 1000); //date('Y-m-d G:i:s',$v['created_at']);
	  if((time() - $v['created_at'] - 1000) >= 60*60*24*3 )   //提前1000秒过期
	  {
	     $pics[$k]['overdue'] = 1;
	  }
   }
   $smarty->assign('pics',$pics);
}
/* 上传图片素材 */
elseif($act=='act_picture')
{
   $file = isset($_FILES['imgFile']) ? $_FILES['imgFile'] : '' ;
   if(!empty($file))
   {
      $picsize = $file['size'];
	  $maxsize = 1024*64;
	  if($picsize>=$maxsize)
	  {
	     $msg = array('error'=>1,'message'=>'图片不能大于64KB');
	  }
	  elseif($file['type']!='image/jpeg' && $file['type']!='image/pjpeg')
	  {
	     $msg = array('error'=>1,'message'=>'只允许上传jpg图片');
	  }
	  else
	  {
	     chdir('../');
	     require('includes/cls_image.php');
		 $dirname = '/images/masssend';
		 $cls_image = new cls_image('#ffffff',$dirname);
         $msg = $cls_image-> upload_image($file, $dir = '', $img_name = ''); 
		 $data['src'] = $msg['msg'];
		 $table = $Base->table('masssend_pic');
		 if($Mysql->insert($data,$table))
		 {
		    require('includes/cls_Wx.php');
			$Wx = new Wx;
			$data = array('media'=>'@'.substr($msg['msg'],1));
			$result = $Wx->uploadmedia($type='thumb', $data);
            $result = $Json->decode($result);
			if($result->errcode>0)
			{
			   $msg = array('error'=>1,'message'=>$result->errmsg);
			}
			else
			{
			   $data = array(
			   'thumb_media_id'=>$result->thumb_media_id,
			   'created_at'=>$result->created_at
			   );
			   $where = array('src'=>$msg['msg']);
			   if($Mysql->update($data,$table,$where))
			   {
			      $msg['error'] = 0;   
				  $msg['url'] = $msg['msg'];
			   }
			}	
		 }		 
	  }
	  $msg = $Json->encode($msg);
      echo $msg;
      exit;
   }
}
/* 删除操作 */
elseif($act=='delete')
{
   $pid = isset($_REQUEST['pid']) ? intval($_REQUEST['pid']) : 0 ;
   $mid = isset($_REQUEST['mid']) ? intval($_REQUEST['mid']) : 0 ;
   $msg = array('error'=>1,'data'=>'Error：');
   /* 删除图片素材 */
   if($pid>0)
   {
      $sql = "select src from ".$Base->table('masssend_pic')." where pid=$pid ";
	  $src = $Mysql->getOne($sql);
	  if($src)
	  {
	     /* 删除图片 */
		 $olddir = getcwd();
		 chdir('../');
		 $src = substr($src,1);

		 if(@unlink($src))
		 {
		    if($Mysql->query("delete from ".$Base->table('masssend_pic')." where pid = $pid "))
			{
			   $msg = array('error'=>0,'data'=>'删除成功，现在刷新');   
			}
			else
			{
			   $msg['data'] .= '删除数据库记录失败';
			}
		 } 
		 else
		 {
		    $msg['data'] .= '删除图片资源失败';
		 }
		 chdir($olddir);
	  }
   }
   /* 删除图文消息 */
   elseif($mid>0)
   {
      $content = $Mysql->getOne("select content from ".$Base->table('masssend_material')." where mid= $mid ");
	  if($content)
	  {
	     
	  }
   }
   $msg = $Json->encode($msg);
   echo $msg;
   exit;
}
/* 刷新操作 */
elseif($act=='refresh')
{
   $pid = isset($_REQUEST['pid']) ? intval($_REQUEST['pid']) : 0 ;
   $src = $Mysql->getOne("select src from ".$Base->table('masssend_pic')." where pid=$pid ");
   if($src)
   {
            chdir('../');
            require('includes/cls_Wx.php');
			$Wx = new Wx;
			$data = array('media'=>'@'.substr($src,1));
			$result = $Wx->uploadmedia($type='thumb', $data);
            $result = $Json->decode($result);
			if($result->errcode>0)
			{
			   $msg = array('error'=>1,'data'=>$result->errmsg);
			}
			else
			{
               $data = array(
			   'thumb_media_id'=>$result->thumb_media_id,
			   'created_at'=>$result->created_at
			   );
			   $where = array('pid'=>$pid);
			   $table = $Base->table('masssend_pic');
			   if($Mysql->update($data,$table,$where))
			   {
			      $msg = array('error'=>0,'data'=>'图片刷新成功');   
			   }
			}	
   }
   else
   {
      $msg = array('error'=>1,'data'=>'error：图片不存在');
   }
   $msg = $Json->encode($msg);
   echo $msg;
   exit;
}

$smarty->assign('act',$act);
$smarty->assign('nav','masssend'); 
chdir('../');
$smarty->display("admin/masssend.htm");

?>