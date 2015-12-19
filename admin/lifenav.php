<?php
/*
 * 生活导航管理
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);

require("../includes/init.php");
require('includes/cls_admin.php');
//Admin::checkAdminLogin();

class Lifenav extends Common{
	/* 
	* 提取生活导航列表 
	*/
	public static function getLifenavList($pageNow,$pageNum,$cat_id=0,$community_id=0,$province=0,$city=0,$district=0,$subdistrict=0,$neighborhood=0)
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
	  if($province>0)
	  {
		  $sql .= "and province=$province ";
	  }
	  if($city>0)
	  {
		  $sql .= "and city=$city ";
	  }
	  if($district>0)
	  {
		  $sql .= "and district=$district ";
	  }
	  if($subdistrict>0)
	  {
		  $sql .= "and subdistrict=$subdistrict ";
	  }
	  if($neighborhood>0)
	  {
		  $sql .= "and neighborhood=$neighborhood ";
	  }
	  $sql .= "order by sort_order asc, lifenav_id desc ";
	  $resNum = $GLOBALS['Mysql']->getCount($sql);
	  $sql .= "limit $start, $pageNum ";
	  $res = $GLOBALS['Mysql']->getAll($sql);
	  foreach($res as $k=>$v)
	  {
	     $res[$k]['content'] = unserialize($v['content']); 
	     $res[$k]['cat_name'] = $GLOBALS['Mysql']->getOne("select cat_name from ".$GLOBALS['Base']->table('lifenav_cat')." where cat_id=".$v['cat_id']."");
		  if($v['province']>0)
		  {
			  $res[$k]['province'] = $GLOBALS['Mysql']->getOne("select region_name from ".$GLOBALS['Base']->table('region')." where region_id=".$v['province']);
		  }
		  if($v['city']>0)
		  {
			  $res[$k]['city'] = $GLOBALS['Mysql']->getOne("select region_name from ".$GLOBALS['Base']->table('region')." where region_id=".$v['city']);
		  }
		  if($v['district']>0)
		  {
			  $res[$k]['district'] = $GLOBALS['Mysql']->getOne("select region_name from ".$GLOBALS['Base']->table('region')." where region_id=".$v['district']);
		  }
		  if($v['subdistrict']>0)
		  {
			  $res[$k]['subdistrict'] = $GLOBALS['Mysql']->getOne("select region_name from ".$GLOBALS['Base']->table('region')." where region_id=".$v['subdistrict']);
		  }
		  if($v['neighborhood']>0)
		  {
			  $res[$k]['neighborhood'] = $GLOBALS['Mysql']->getOne("select region_name from ".$GLOBALS['Base']->table('region')." where region_id=".$v['neighborhood']);
		  }
		  if($v['community_id']>0)
		  {
		  	  $res[$k]['community_name'] = $GLOBALS['Mysql']->getOne("select community_name from ".$GLOBALS['Base']->table('community')." where community_id=".$v['community_id'].""); 
		  }
	  }
	  $arr['resNum'] = $resNum;
	  $arr['res'] = $res;
	  return $arr;
	} 
	public static function getLifenavApplyList($pageNow, $pageNum)
	{
		$start = ($pageNow -1)*$pageNum;
		$sql = "select * from ".$GLOBALS['Base']->table('lifenav_apply')." order by status,apply_time desc ";
		$resNum = $GLOBALS['Mysql']->getCount($sql);
		$sql .= "limit $start, $pageNum ";
		$res = $GLOBALS['Mysql']->getAll($sql);
		foreach($res as $k=>$v)
		{
			$res[$k]['apply_time'] = date('Y-m-d H:i:s',$v['apply_time']);
			$res[$k]['content'] = unserialize($v['content']);
		}
		$arr = array('resNum'=>$resNum,'res'=>$res);
		return $arr;		
	}
}

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'lifenav_cat' ;
$aid = $_SESSION['admin']['aid'];
{

}
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
/* 编辑、添加分类 */
elseif($act=='operateCat')
{
   $cat_id = isset($_POST['cat_id']) ? abs(intval($_REQUEST['cat_id'])): 0 ;
   $data = array(
           'cat_name' => isset($_POST['cat_name']) ? $Common->charFormat($_POST['cat_name']): '',
		   'parent_id' => abs(intval($_POST['parent_id'])),
		   'sort_order' => isset($_POST['sort_order']) ? abs(intval($_POST['sort_order'])): 50 ,
   );
   if(empty($data['cat_name']))
   {
      $msg = array('error'=>1,'data'=>'请填写生活导航名称');
   }
   else
   {
      $table = $Base->table('lifenav_cat');
      if($cat_id==0)
      {
          $Mysql->insert($data,$table);
      }
      else
      {
          $where = array('cat_id'=>$cat_id);
		  $Mysql->update($data,$table,$where);   
      }
	  $msg = array('error'=>0,'data'=>'操作成功','href'=>'/admin/lifenav.php');
   }	  
   $msg = $Json->encode($msg);
   echo $msg;
   exit;
}
/*删除分类*/
elseif($act=='deletecat')
{
	$cat_id = isset($_POST['cat_id']) ? abs(intval($_REQUEST['cat_id'])): 0 ;
	$sql = "select parent_id from".$Base->table('lifenav_cat')." where cat_id = ".$cat_id." limit 1";
	if($Mysql->getOne($sql)==0)
	{
		$sql_parent = "select * from ".$Base->table('lifenav_cat')." where parent_id = ".$cat_id." limit 1";
		if(($Mysql->getCount($sql_parent))!=0)
		{
			
			
			$msg = array('error'=>1,'data'=>'顶级分类，请先删除它的子分类');
		}
		else 
		{
			$Mysql->query("delete from ".$Base->table('lifenav_cat')." where cat_id = ".$cat_id);
			$msg = array('error'=>0,'data'=>'删除成功');
		}
		
	}
	else
	{
		$sql_lifenav = "select * from ".$Base->table('lifenav')." where cat_id = ".$cat_id." limit 1";
		
		if($Mysql->getCount($sql_lifenav)!=0)
		{
			$msg = array('error'=>1,'data'=>'该分类下有生活导航条目，请先删除');
		}
		else
		{
			$sql_attr = "select * from ".$Base->table('lifenav_cat_attr')." where cat_id = ".$cat_id." limit 1";
			if($Mysql->getCount($sql_attr)!=0)
			{
			$msg = array('error'=>1,'data'=>'该分类下有属性，请先删除属性');
			}
			else
			{
				
				$Mysql->query("delete from ".$Base->table('lifenav_cat')." where cat_id = ".$cat_id);
				$msg = array('error'=>0,'data'=>'删除成功');
			}
		}
		$msg = $Json->encode($msg);
		echo $msg;
		exit;
	}
}
/* 属性管理 */
elseif($act=='attr')
{
   $cat_id = isset($_REQUEST['cat_id']) ? abs(intval($_REQUEST['cat_id'])): 0 ;
   if($cat_id>0)
   {  
      $sql = "select attr_id, attr_name, type, value, sort_order from ".$Base->table('lifenav_cat_attr')." where cat_id=$cat_id ".
	         "order by sort_order asc, attr_id asc ";
	  $attrs = $Mysql->getAll($sql); 
	  $smarty->assign('attrs',$attrs);
	  $smarty->assign('cat_name',$Mysql->getOne("select cat_name from ".$Base->table('lifenav_cat')." where cat_id=$cat_id "));
	  $smarty->assign('cat_id',$cat_id);
   }
}
/* 添加属性 */
elseif($act=='add_attr')
{
   $cat_id = isset($_REQUEST['cat_id']) ? abs(intval($_REQUEST['cat_id'])): 0 ;
   if($cat_id>0)
   {
      $data = array(
	          'attr_name'=>isset($_POST['attr_name']) ? $Common->charFormat($_POST['attr_name']): '',
			  'cat_id'=>abs(intval($_POST['cat_id'])),
			  'type'=>$Common->charFormat($_POST['type']),
			  'value'=>$Common->charFormat($_POST['value']),
			  'sort_order'=> isset($_POST['sort_order']) ? abs(intval($_POST['sort_order'])): 50 ,
			  );
	  if(empty($data['attr_name']))
	  {
	     $msg = array('error'=>1,'data'=>'请填写属性名称');
	  }
	  elseif($data['cat_id']==0)
	  {
	     $msg = array('error'=>1,'data'=>'必须选择一个具体的分类');
	  }
	  else
	  {
	    $table = $Base->table('lifenav_cat_attr');
		 $Mysql->insert($data,$table);
		 $msg = array('error'=>0,'data'=>'添加成功','href'=>'/admin/lifenav.php?act=attr&cat_id='.$cat_id.'');
	  }		
	  $msg = $Json->encode($msg);
	  echo $msg;
	  exit;  
   }
}
/*删除属性*/
elseif($act=='delete_attr')
{
	$msg = array('error'=>1,'data'=>'系统错误，请求重试');
	$attr_id = isset($_REQUEST['attr_id']) ? intval($_REQUEST['attr_id']): 0 ;
	if($Mysql->query(" delete from ".$Base->table('lifenav_cat_attr')." where attr_id = ".$attr_id))
	{
		$msg = array('error'=>0,'data'=>'删除成功');
	}
	$msg = $Json->encode($msg);
	echo $msg;
	exit;
}
//生活导航列表
elseif($act=='lifenav')
{
	$pageNow = isset($_REQUEST['page']) ? abs(intval($_REQUEST['page'])): 1 ;
	$pageNum = 10;
	$list = Lifenav::getLifenavList($pageNow,$pageNum,$cat_id=0,$community_id=0);
	$pages = Admin::setPage($pageNum,$pageNow,$list['resNum']);
	$smarty->assign('lifenav',$list['res']);
	$smarty->assign('pages',$pages);
}
/* 添加生活导航内容 */
elseif($act=='add_lifenav')
{
	$key = isset($_REQUEST['key']) ? $Common->charFormat($_REQUEST['key']) : '';
	$cat_id = isset($_REQUEST['cat_id']) ? intval($_REQUEST['cat_id']) : 0;
	$community_id = isset($_POST['community_id']) ? intval($_POST['community_id']) : 0;
	$province = isset($_POST['province']) ? intval($_POST['province']) : 0;
	$city = isset($_POST['city']) ? intval($_POST['city']) : 0;
	$district = isset($_POST['district']) ? intval($_POST['district']) : 0;
	$subdistrict = isset($_POST['subdistrict']) ? intval($_POST['subdistrict']) : 0;
	$neighborhood = isset($_POST['neighborhood']) ? intval($_POST['neighborhood']) : 0;
	$cat = $Mysql->getAll("select cat_id, cat_name, sort_order from ".$Base->table('lifenav_cat')." where parent_id=0 order by sort_order asc, cat_id asc ");
	foreach($cat as $k=>$v)
	{
		$cat[$k]['sub_cat'] = $Mysql->getAll("select cat_id, cat_name, sort_order from ".$Base->table('lifenav_cat')." where parent_id=".$v['cat_id']." ".
														"order by sort_order asc, cat_id asc ");
	}
	if($key=='submit_cat')
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
	}
	/* 添加操作 */
	elseif($key=='do_add')
	{
		$msg = array('error'=>1,'data'=>'系统错误，请求重试'.$_POST['cat_id']);
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
		$table = $Base->table('lifenav');
		if($Mysql->insert($data,$table))
		{
		 $msg = array("error"=>0,"data"=>"成功添加生活导航");
		}
		$msg = $Json->encode($msg);
		echo $msg;
		exit;
	}
	$smarty->assign('cat',$cat);
	$smarty->assign('community',$Mysql->getAll("select community_id, community_name from ".$Base->table('community')." order by community_id asc ")); 
	$smarty->assign('cat_id',$cat_id);
	$smarty->assign('community_id',$community_id);
	$smarty->assign('province',$province);
	$smarty->assign('city',$city);
	$smarty->assign('district',$district);
	$smarty->assign('subdistrict',$subdistrict);
	$smarty->assign('neighborhood',$neighborhood);
}
/*删除生活导航*/
elseif($act=='delete_lifenav')
{
	$lifenav_id = isset($_REQUEST['lifenav_id']) ? intval($_REQUEST['lifenav_id']): 0 ;
	if($lifenav_id!=0)
	{
		$content = $Mysql->getOne("select content from ".$Base->table('lifenav')." where lifenav_id = ".$lifenav_id);
		$content = unserialize($content);
		$content = $content['商家简介'];
		if(!empty($content))
		{
			$pic = $Common->get_pic_html($content);  //信息中所有图片
			chdir('../');
			foreach($pic as $v)
			{
				@unlink(substr($v,1));           //删除图片
			}
		}
		$Mysql->query("delete from ".$Base->table('lifenav')." where lifenav_id = ".$lifenav_id);
		header("Location:/admin/lifenav.php?act=lifenav");
	}
}
/* 生活导航申请列表 */
if($act=='lifenav_apply')
{
	$pageNow = isset($_REQUEST['page']) ? intval($_REQUEST['page']): 1 ;
	$pageNum = 10;
	$list = Lifenav::getLifenavApplyList($pageNow, $pageNum);
	$pages = Admin::setPage($pageNum,$pageNow,$list['resNum']);
	$smarty->assign('applylist',$list);
	$smarty->assign('pages',$pages);
}
$smarty->assign('act',$act);
$smarty->assign('nav','lifenav');
chdir('../');
$smarty->display("admin/lifenav.htm");

?>