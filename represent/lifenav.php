<?php
/*
 * 生活导航管理
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);

require("../includes/init.php");
require('includes/cls_represent.php');
Represent::checkUserLogin();

class Lifenav extends Common{
   /* 
   * 提取生活导航列表 
   */
   public static function getLifenavList($pageNow,$pageNum,$cat_id=0,$community_id=0)
   {
      $start = ($pageNow -1)*$pageNum;
	  $sql = "select * from ".$GLOBALS['Base']->table('lifenav')." where lifenav_id>0 ";  
	  if($cat_id>0)
	  {
	     $sql .= "and cat_id=$cat_id ";
	  }
	  if($community_id>0)
	  {
	     $sql .= "and community_id=$community_id ";
	  }
	  $sql .= "order by sort_order asc, lifenav_id desc ";
	  $resNum = $GLOBALS['Mysql']->getCount($sql);
	  $sql .= "limit $start, $pageNum ";
	  $res = $GLOBALS['Mysql']->getAll($sql);
	  foreach($res as $k=>$v)
	  {
	     $res[$k]['content'] = unserialize($v['content']); 
	     $res[$k]['cat_name'] = $GLOBALS['Mysql']->getOne("select cat_name from ".$GLOBALS['Base']->table('lifenav_cat')." where cat_id=".$v['cat_id']."");
		 $res[$k]['community_name'] = $GLOBALS['Mysql']->getOne("select community_name from ".$GLOBALS['Base']->table('community')." where community_id=".$v['community_id'].""); 
	  }
	  $arr['resNum'] = $resNum;
	  $arr['res'] = $res;
	  return $arr;
   } 
}

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'lifenav_cat' ;
$community_id = $_SESSION['represent']['community_id'];

/* 导航分类管理  */
if($act=='lifenav_cat')
{
   $cat_id = isset($_REQUEST['cat_id']) ? abs(intval($_REQUEST['cat_id'])) : 'list' ;
   $cat = $Mysql->getAll("select cat_id, cat_name, sort_order from ".$Base->table('lifenav_cat')." where parent_id=0 order by sort_order asc, cat_id asc ");
   foreach($cat as $k=>$v)
   {
	   $cat[$k]['sub_cat'] = $Mysql->getAll("select cat_id, cat_name, sort_order from ".$Base->table('lifenav_cat')." where parent_id=".$v['cat_id']." ".
		                                    "order by sort_order asc, cat_id asc ");
   } 
   $smarty->assign('cat',$cat);   //下面三个操作都需要提取所有分类
    /* 提取所有分类 */
   if($cat_id=='list')  
   {
      //todo
   }
   /* 编辑分类 */
   elseif($cat_id>0) 
   {
      $r = $Mysql->getRow("select cat_id, cat_name, parent_id, sort_order from ".$Base->table('lifenav_cat')." where cat_id=$cat_id ");
	  $smarty->assign('r',$r);  
   }
   /* 添加分类 */
   else 
   {
      //todo   
   }
   $smarty->assign('cat_id',$cat_id);
}

/* 添加生活导航内容 */
elseif($act=='lifenav')
{
    $cat_id = isset($_REQUEST['cat_id']) ? abs(intval($_REQUEST['cat_id'])): 0 ;
	if($cat_id>0)   //添加生活导航
	{  
	  $sql = "select attr_id, attr_name, type, value, sort_order from ".$Base->table('lifenav_cat_attr')." where cat_id=$cat_id ".
	         "order by sort_order asc, attr_id asc ";
	  $attrs = $Mysql->getAll($sql); 
	  /* 将属性值整理成form元素 */
	  foreach($attrs as $k=>$v)
	  {
	     if($v['type']=='select' || $v['type']=='checkbox')
		 {
	        $attrs[$k]['value'] = explode(',',$v['value']); 
		 }	
	  }
	  $smarty->assign('attrs',$attrs);
	  $smarty->assign('cat_name',$Mysql->getOne("select cat_name from ".$Base->table('lifenav_cat')." where cat_id=$cat_id "));
	  $smarty->assign('cat_id',$cat_id);
	  $smarty->assign('community',$Mysql->getAll("select community_id, community_name from ".$Base->table('community')." order by community_id asc ")); 
	}	
	else   //生活导航列表
	{
	  $pageNow = isset($_REQUEST['page']) ? abs(intval($_REQUEST['page'])): 1 ;
	  $pageNum = 10;
	  $list = Lifenav::getLifenavList($pageNow,$pageNum,$cat_id,$community_id);
	  $pages = represent::setPage($pageNum,$pageNow,$list['resNum']);
	  $smarty->assign('lifenav',$list['res']);
	  $smarty->assign('pages',$pages);
	}
}
/* 添加操作 */
elseif($act=='add_lifenav')
{
   $cat_id = abs(intval($_POST['cat_id']));
   foreach($_POST as $k=>$v)
   {
      if(is_numeric($k))
      {
         $sql = "select attr_name, type from ".$Base->table('lifenav_cat_attr')." where attr_id=$k ";
         $attr = $Mysql->getRow($sql);
         if($attr['type']=='checkbox')
         {
         $content[$attr['attr_name']] = implode(',',$v);
         }
         else
         {
         $content[$attr['attr_name']] = $v;
         }
         $data['content'] = serialize($content);   //将数据序列化
      }
      else
      {
         $data[$k] = $v;
      }
   }
   $data['community_id'] = $community_id;
   $table = $Base->table('lifenav');
   if($Mysql->insert($data,$table))
   {
      $msg = array('error'=>0,'data'=>'成功添加生活导航','href'=>'/represent/lifenav.php');
   }
   $msg = $Json->encode($msg);
   echo $msg;
   exit;
}


$smarty->assign('act',$act);
$smarty->assign('nav','lifenav');
chdir('../');
$smarty->display("represent/lifenav.htm");

?>