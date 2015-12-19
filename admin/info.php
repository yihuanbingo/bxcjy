<?php
/*
 * 文章管理
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);

require("../includes/init.php");
require('includes/cls_admin.php');
//Admin::checkAdminLogin();

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'infolist' ;
$aid = $_SESSION['admin']['aid'];


/* 文章列表 */
if($act=='infolist')
{
	$key = isset($_REQUEST['key']) ? $Common->charFormat($_REQUEST['key']): '';
	/* 新增或编辑 */
	if($key=='operate')
	{
	   $sql = "select cat_id, cat_name from ".$Base->table('info_cat')." order by cat_id asc ";
	   $cats = $Mysql->getAll($sql);
	   $sql_info = "select title,cat_id,content,info_id from ".$Base->table('info')." where info_id = ". $_REQUEST['info_id'];
	   $info=$Mysql->getRow($sql_info);
	   $smarty->assign('cats',$cats);
	   $smarty->assign('info',$info);
	}
	else
	{
	   $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']): 1; 
	   $pageNum = 10;
	   $list = Admin::getInfoList($page,$pageNum);
	   $pages = Admin::setPage($pageNum,$page,$list['resNum']); 
       $smarty->assign('list',$list);
       $smarty->assign('pages',$pages);
	}
	$smarty->assign('key',$key);
	$smarty->assign('$info_title',$info_title);

}
/* 文章分类列表 */
elseif($act=='infocatlist')
{
	$infocat = Admin::getInfoCat();
	$smarty->assign('infocat',$infocat);
}
/* 插入、编辑文章 */
elseif($act=='doinfo')
{
	
}
/* 插入文章分类 */
elseif($act=='doinfocat')
{
	$cat_name = isset($_POST['cat_name']) ? $Common->charFormat($_POST['cat_name']): '';
	if(empty($cat_name))
	{
		$msg = array('error'=>1,'data'=>'请填写文章分类');
	}
	else
	{
		$table = $Base->table('info_cat');
		$data = array(
				'cat_name'=>$cat_name,
		);
		if($Mysql->insert($data,$table))
		{
			$msg = array('error'=>0,'data'=>'新建分类成功','href'=>'/admin/info.php?act=infocatlist');
		}
	}
	$msg = $Json->encode($msg);
	echo $msg;
	exit;
}
/*修改文章文类*/
elseif($act=='updateinfocat')
{
	$cat_id = isset($_REQUEST['cat_id']) ? intval($_REQUEST['cat_id']): 0 ;
	$sql = "select cat_id from ".$Base->table('info_cat')." where cat_id=$cat_id ";
	$cat_id = $Mysql->getOne($sql);
	$msg = array('error'=>1,'data'=>'系统错误，请求失败');
	if($cat_id)
	{
		$cat_name = isset($_POST['cat_name']) ? $Common->charFormat($_POST['cat_name']): '';
		if(empty($cat_name))
		{
			$msg = array('error'=>1,'data'=>'请填写文章分类');
		}
		else 
		{
			$data = array(
				'cat_id'=>$cat_id,
				'cat_name'=>$cat_name
			);
			$table = $Base->table('info_cat');
			$where = array('cat_id'=>$cat_id);
			if($Mysql->update($data,$table,$where))
			{
				$msg = array('error'=>0,'data'=>'修改成功');
			}
		}
	}
	$msg = $Json->encode($msg);
	echo $msg;
	exit;
}
/*删除文章分类*/
elseif($act=='deleteinfocat')
{
	$cat_id = isset($_REQUEST['cat_id']) ? intval($_REQUEST['cat_id']): 0 ;
	$sql = "delete from ".$Base->table('info_cat')." where cat_id=$cat_id";
	$msg = array('error'=>1,'data'=>'系统错误，请求失败');
	$sql_info = "select info_id from ".$Base->table('info')."where cat_id=$cat_id limit 1";
	if($Mysql->getCount($sql_info)!=0)
	{
		$msg = array('error'=>1,'data'=>'该分类有文章，请先删除文章');
	}
	else
	{
		if($Mysql->query($sql))
		{
			$msg = array('error'=>0,'data'=>'删除成功，现在刷新');
		}
	}
	$msg = $Json->encode($msg);
	echo $msg;
	exit;
}
/* 新增或编辑文章 */
elseif($act=='operate')
{
   $info_id = isset($_POST['info_id']) ? intval($_POST['info_id']): 0 ;
   $title = empty($_POST['title']) ? '': $Common->charFormat($_POST['title']);
   $content = empty($_POST['content']) ? '' : $_POST['content'] ;
   $cat_id = is_numeric($_POST['cat_id']) ? intval($_POST['cat_id']) : 0 ;
   if(empty($title))
   {
      $msg = array('error'=>1,'data'=>'请填写文章标题');
   }
   elseif(empty($content))
   {
      $msg = array('error'=>1,'data'=>'请填写文章内容');
   }
   elseif($cat_id<1)
   {
      $msg = array('error'=>1,'data'=>'请选择文章分类');
   }
   else
   {
      $data = array(
	  'title'=>$title,
	  'cat_id'=>$cat_id,
	  'content'=>$content,
	  );
	  $table = $Base->table('info');
      if($info_id==0)   //新增
      {
         $data['add_time'] = time();
		 if($Mysql->insert($data,$table))
		 {
		    $msg = array('error'=>0,'data'=>'成功添加一篇文章','href'=>'/admin/info.php');
		 }
      }
      else   //编辑
      {
	     /* 编辑时检查新原来的图片是否在新的content中，若不在则删除 */
	     $content_old = $Mysql->getOne("select content from ".$Base->table('info')." where info_id=$info_id");
		 $pic_old = $Common->get_pic_html($content_old);
		 $pic  = $Common->get_pic_html($content);
		 chdir('../');
		 foreach($pic_old as $v)
		 {
		    if(!in_array($v,$pic))
			@unlink(substr($v,1));
		 }
         $where = array('info_id'=>$info_id);
		 if($Mysql->update($data,$table,$where))
		 {
		    $msg = array('error'=>0,'data'=>'编辑成功','href'=>'/admin/info.php');
		 }
      }
   }
   $msg = $Json->encode($msg);
   echo $msg;
   exit;
}
/*删除文章*/
elseif($act=='deleteinfo')
{

	$info_id = isset($_REQUEST['info_id']) ? intval($_REQUEST['info_id']): 0 ;
	$sql_delete = "delete from ".$Base->table('info')." where info_id=$info_id";
	$content = $Mysql->getOne("select content from ".$Base->table('info')." where info_id=$info_id");
	$msg = array('error'=>1,'data'=>'系统错误，更新失败');
	if(!empty($content))
	{
		$pic = $Common->get_pic_html($content);  //信息中所有图片
		chdir('../');
		foreach($pic as $v)
		{
			@unlink(substr($v,1));           //删除图片
		}
		$Mysql->query($sql_delete);
		$msg = array('error'=>0,'data'=>'删除成功，现在刷新');
	}
	$msg = $Json->encode($msg);
	echo $msg;
	exit;
}

$smarty->assign('act',$act);
$smarty->assign('nav','info');
chdir('../');
$smarty->display("admin/info.htm");

?>