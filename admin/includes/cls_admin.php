<?php
/*
 * 管理后台专用类
 * @author 袁桨 
 * @date 06302014
 * @qq 932625974
*/
if(!defined('IN_BS'))
{
  die('hacking attempt');
}
 
class Admin extends Common
{
   /*
   * 检查用户是否登录
   */
   static function checkAdminLogin()
   {
      if(isset($_SESSION['admin']))
	  {
         $GLOBALS['smarty']->assign('admin',$_SESSION['admin']);
	  }
	  else
	  {
	     parent::base_header("Location:/admin/login.php\n");
	  }
   }
 
   /*
   *  管理通用翻页
   */
   static function setPage($pageNum=10,$pageNow=1,$allNum)
   {
      $pages = ceil($allNum/$pageNum);   // 总页数
   
      $page_pre = $pageNow>1 ? 'gotoPage('.($pageNow-1).');': 'void(0);' ;
      $page_next = $pageNow<$pages ? 'gotoPage('.($pageNow+1).');' : 'void(0)' ;
      $re['page_pre'] = $page_pre;
      $re['page_next'] = $page_next;
      $re['pageNow'] = $pageNow;
      $re['pages'] = $pages;
      return $re;
   } 
   /*
    * 获取文章分类列表
    */
   static function getInfoCat()
   {
   		$sql = "select cat_id,cat_name from ".$GLOBALS['Base']->table('info_cat')."order by cat_id";
   		$resNum = $GLOBALS['Mysql']->getCount($sql);
   		$res = $GLOBALS['Mysql']->getAll($sql);
   		$re['res'] = $res;
   		return $res;
   		
   }
   
   /*
   * 获取文章列表
   */
   static function getInfoList($pageNow,$pageNum)
   {
      $start = ($pageNow -1)*$pageNum;
	  $sql = "select * from ".$GLOBALS['Base']->table('info')." order by info_id asc ";
	  $resNum = $GLOBALS['Mysql']->getCount($sql);
	  $sql .= "limit $start, $pageNum ";
	  $res = $GLOBALS['Mysql']->getAll($sql);
	  foreach($res as $k=>$v)
	  {
	  	$sql_cat = "select cat_name from ".$GLOBALS['Base']->table('info_cat')."where cat_id = ".$v['cat_id'];
	  	$res[$k]['cat_name'] = $GLOBALS['Mysql']->getOne($sql_cat); 
	  }
	  foreach($res as $k=>$v)
	  {
	  	$res[$k]['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
	  }
	  $arr['resNum'] = $resNum;
	  $arr['res'] = $res;
	  return $arr;
   }
   
   /*
   * 获取图文信息列表
   */
   static function getGraphicList($pageNow,$pageNum)
   {
      $start = ($pageNow -1)*$pageNum;
	  $sql = "select * from ".$GLOBALS['Base']->table('masssend_graphic')." order by gid desc ";
	  $resNum = $GLOBALS['Mysql']->getCount($sql);
	  $sql .= "limit $start, $pageNum ";
	  $res = $GLOBALS['Mysql']->getAll($sql);
	  foreach($res as $k=>$v)
	  {
	     $res[$k]['thumb'] = $GLOBALS['Mysql']->getOne("select src from ".$GLOBALS['Base']->table('masssend_pic')." where thumb_media_id='".$v['thumb_media_id']."'");
		 $sub = $GLOBALS['Mysql']->getAll("select * from ".$GLOBALS['Base']->table('masssend_graphic')." where parent_id=".$v['gid']." ");
		 if(!empty($sub))
		 {
		    $res[$k]['sub'] = $sub;
		 }
	  }
	  $arr['resNum'] = $resNum;
	  $arr['res'] = $res;
	  return $arr;
   }
   
   /*
   * 获取图稿信息详情
   */
   static function getGraphic($gid)
   {
      $sql = "select * from ".$GLOBALS['Base']->table('masssend_graphic')." where gid=$gid ";
	  $row = $GLOBALS['Mysql']->getRow($sql);
	  if($row)
	  {
	     $row['thumb'] = $GLOBALS['Mysql']->getOne("select src from ".$GLOBALS['Base']->table('masssend_pic')." where thumb_media_id='".$row['thumb_media_id']."'");
	  }
	  return $row;
   }
   
   /* 提取小区列表 */
   static function getCommunityList($pageNow, $pageNum, $keywords)
   {
      $start = ($pageNow -1)*$pageNum;
	  $sql = "select community_id, community_name, province, city, district, address from ".$GLOBALS['Base']->table('community')." order by community_id desc ";
	  $resNum = $GLOBALS['Mysql']->getCount($sql);
	  $sql .= "limit $start, $pageNum ";
	  $res = $GLOBALS['Mysql']->getAll($sql);
	  foreach($res as $k=>$v)
	  {
	     $res[$k]['province'] = $GLOBALS['Mysql']->getOne("select region_name from ".$GLOBALS['Base']->table('region')." where region_id = ".$v['province']."");
		 $res[$k]['city'] = $GLOBALS['Mysql']->getOne("select region_name from ".$GLOBALS['Base']->table('region')." where region_id=".$v['city']."");
		 $res[$k]['district'] = $GLOBALS['Mysql']->getOne("select region_name from ".$GLOBALS['Base']->table('region')." where region_id=".$v['district']."");  
	  }
	  $arr = array('resNum'=>$resNum,'res'=>$res);
	  return $arr;
   }
	
	/* 提取行政区划列表 */
	static function getRegionList($province,$city,$district,$subdistrict,$neighborhood)
	{
		$sql = "select * from ".$GLOBALS['Base']->table('region')." where parent_id = ";
		$province_list = $GLOBALS['Mysql']->getAll($sql."0");
		$arr['province_list'] = $province_list;
		if($province>0)
		{
			$city_list = $GLOBALS['Mysql']->getAll($sql.$province);
			$arr['city_list'] = $city_list;
			if($city>0)
			{
				$district_list = $GLOBALS['Mysql']->getAll($sql.$city);
				$arr['district_list'] = $district_list;
				if($district>0)
				{
					$subdistrict_list = $GLOBALS['Mysql']->getAll($sql.$district);
					$arr['subdistrict_list'] = $subdistrict_list;
					if($subdistrict>0)
					{
						$neighborhood_list = $GLOBALS['Mysql']->getAll($sql.$subdistrict);
						$arr['neighborhood_list'] = $neighborhood_list;
						if($neighborhood>0)
						{
							$community_list = $GLOBALS['Mysql']->getAll("select community_id,community_name from ".$GLOBALS['Base']->table('community')." where neighborhood = ".$neighborhood);
							$arr['community_list'] = $community_list;
						}
					}
				}
			}
		}
		return $arr;
	}
	/* 获取小区申请列表 */
	static function getCommunityApplyList($pageNow, $pageNum)
	{
		$start = ($pageNow -1)*$pageNum;
		$sql = "select * from ".$GLOBALS['Base']->table('community_apply')." order by status,apply_time desc ";
		$resNum = $GLOBALS['Mysql']->getCount($sql);
		$sql .= "limit $start, $pageNum ";
		$res = $GLOBALS['Mysql']->getAll($sql);
		foreach($res as $k=>$v)
		{
			$res[$k]['apply_time'] = date('Y-m-d H:i:s',$v['apply_time']);
		}
		$arr = array('resNum'=>$resNum,'res'=>$res);
		return $arr;	
	}
	/* 获取账户列表 */
	static function getAccoutList($pageNow,$pageNum)
	{
		$start = ($pageNow -1)*$pageNum;
		$sql = "select * from ".$GLOBALS['Base']->table('account');
		$resNum = $GLOBALS['Mysql']->getCount($sql);
		$sql .= "limit $start, $pageNum ";
		$res = $GLOBALS['Mysql']->getAll($sql);
		foreach($res as $k=>$v)
		{
			$res[$k]['community_name'] = $GLOBALS['Mysql']->getOne("select community_name from ".$GLOBALS['Base']->table('community')." where community_id = ".$v['community_id']);
			if($v['type']==1)
			{
				$res[$k]['type'] = "物业";
			}
			elseif($v['type']==2)
			{
				$res[$k]['type'] = "小区管理员";
			}
		}
		$arr = array('resNum'=>$resNum,'res'=>$res);
		return $arr;	
	}

	/* 获取活动列表 */
	static function getActivityList($pageNow,$pageNum)
	{
		$start = ($pageNow -1)*$pageNum;
		$sql = "select * from ".$GLOBALS['Base']->table('activity');
		$resNum = $GLOBALS['Mysql']->getCount($sql);
		$sql .= "limit $start, $pageNum ";
		$res = $GLOBALS['Mysql']->getAll($sql);
//		foreach($res as $k=>$v)
//		{
//			$res[$k]['community_name'] = $GLOBALS['Mysql']->getOne("select community_name from ".$GLOBALS['Base']->table('community')." where community_id = ".$v['community_id']);
//			if($v['type']==1)
//			{
//				$res[$k]['type'] = "物业";
//			}
//			elseif($v['type']==2)
//			{
//				$res[$k]['type'] = "小区管理员";
//			}
//		}

		$arr = array('resNum'=>$resNum,'res'=>$res);
		return $arr;
	}

	/* 获取所有活动 */
	static function getAllActivity()
	{
		$sql = "select * from ".$GLOBALS['Base']->table('activity');
		$res = $GLOBALS['Mysql']->getAll($sql);
		return $res;
	}

	static function getValify($pageNow,$pageNum,$activity=0,$valifycode='')
	{
		$start = ($pageNow -1)*$pageNum;
		$sql = "select * from ".$GLOBALS['Base']->table('valifycode');
		$where = "where isdelete=0 ";
		if($activity!=0)
		{
			$where .= "and activity_id=$activity ";
		}

		if(!empty($valifycode))
		{
			$where .= "and valifycode='$valifycode' ";
		}

        $sql .= $where;
		$resNum = $GLOBALS['Mysql']->getCount($sql);
		$sql .= "limit $start, $pageNum ";
		$res = $GLOBALS['Mysql']->getAll($sql);

		$arr = array('resNum'=>$resNum,'res'=>$res);
		return $arr;
	}
   /*
   * 检查上传文件类型
   * param String file_name
   * return boolean
   */
   static function check_excel_type($file_name)
   {
      //return $file_name == 'application/vnd.ms-excel' ;     
	  return true;
   }
}

?>