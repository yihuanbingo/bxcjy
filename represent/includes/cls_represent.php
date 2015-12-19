<?php
/*
 * 小区管理员后台专用类
 * author yuanjiang @2.16.2013
*/
if(!defined('IN_BS'))
{
  die('hacking attempt');
}
 
class Represent extends Common
{
   /*
   * 检查用户是否登录
   */
   static function checkUserLogin()
   {
      self::checkCookie();
      if(isset($_SESSION['represent']))
      {
         $GLOBALS['smarty']->assign('online',$_SESSION['represent']);
      }
      else
      {
        parent::base_header("Location:/represent/login\n");
      }
   }
   /*检查COOKIE*/
   static function checkCookie()
   {
     if(isset($_COOKIE['represent']) && !isset($_SESSION['represent']))
      {
         
         $cookie = unserialize($_COOKIE['represent']);
         if($user = $GLOBALS['Mysql']->getRow("select community_id, account from ".$GLOBALS['Base']->table('account')." where type=2 and account = '".$cookie['account']."' and passwd = '".$cookie['passwd']."'"))
         {
             $_SESSION['represent'] = $user ;
         }
      }
   }
   /*
    +--------------------------------------------------------
	+ 检查是否已上传业主信息
	+ 业主信息是执行多项操作的必要条件
	+--------------------------------------------------------
   */
   static function checkExistHouseholder($community_id,$nav)
   {
      if($GLOBALS['Mysql']->getOne("select householder_id from ".$GLOBALS['Base']->table('householder')." where community_id=$community_id limit 0, 1"))
	  {
	     return true;
	  }
	  else
	  {
         $GLOBALS['smarty']->assign('nav',$nav);
		 chdir('../');
         $GLOBALS['smarty']->display("represent/NoExistHouseholder.htm");
   	  }	 
   }
   
   /*
   * 检查上传文件类型
   * param String file_name
   * return boolean
   */
   static function check_excel_type($file_name)
   {
      return $file_name == 'application/vnd.ms-excel' ;     
   }
 
   /*
   * 物业管理通用翻页
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
    * 提取物业发送的通知记录
   */ 
   static function getNoticeLog($community_id,$pageNow,$pageNum)
   {
      $start = ($pageNow -1)*$pageNum;
      $sql = "select * from ".$GLOBALS['Base']->table('notice')." where community_id=$community_id order by notice_id desc ";
	  $resNum = $GLOBALS['Mysql']->getCount($sql);
	  $sql .= "limit $start, $pageNum ";
	  $res = $GLOBALS['Mysql']->getAll($sql);
	  foreach($res as $k=>$v)
	  {
	     $res[$k]['add_time'] = date('Y年n月d日',$v['add_time']);
		 $res[$k]['summary'] = mb_substr(parent::charFormat($v['content']),0,80); 
	  }
	  $re['resNum'] = $resNum;
	  $re['res'] = $res;
	  return $re;    
   }
   
   /*
   *提取关注着列表
   */
   static function getSubscriber($community_id,$pageNow,$pageNum)
   {
	   $start = ($pageNow -1)*$pageNum;
	   $sql = "select * from ".$GLOBALS['Base']->table('user')." where community_id = $community_id and subscribe = '1'";
	   $resNum = $GLOBALS['Mysql']->getCount($sql);
	   $sql .= "limit $start, $pageNum ";
	   $res = $GLOBALS['Mysql']->getAll($sql);
	   $re['resNum'] = $resNum;
	   $re['res'] = $res;
	   return $re;
	}
	
   /*
   * 提取业主列表
   */
   static function getHouseholder($community_id,$pageNow,$pageNum,$is_bind,$keywords)
   {
      $start = ($pageNow -1)*$pageNum;
	  $sql = "select * from ".$GLOBALS['Base']->table('householder')." where community_id=$community_id ";
	  if($is_bind>=0)
	  {
	     $sql .= "and is_bind = $is_bind ";
	  }
	  if(!empty($keywords))
	  {
	     $sql .= "and (house_number like '%$keywords%' || house_owner like '%$keywords%' || mobile like '%$keywords%') ";
	  }
	  $sql .= "order by householder_id asc ";
	  $resNum = $GLOBALS['Mysql']->getCount($sql);
	  $sql .= "limit $start, $pageNum ";
	  $res = $GLOBALS['Mysql']->getAll($sql);
	  foreach($res as $k=>$v)
	  {
	     $res[$k]['update_time'] = date('Y年n月d日',$v['update_time']); 
		 $res[$k]['wx_bind'] = $GLOBALS['Mysql']->getOne("user_id from ".$GLOBALS['Base']->table('user')." where householder_id=".$v['householder_id'].""); 
		 $res[$k]['bind_code'] = substr($v['mobile'],-6,6);   //手机号后6位作为绑定码
	  }		 
	  $re['resNum'] = $resNum;
	  $re['res'] = $res;
	  return $re;
   }
     
   /*
    * 计算2个时间段的月份差
	* @param $st开始时间 $et结束时间(时间戳格式)
	* @return $total 返回的差值 
   */
   static function getMonthNum($st, $et)
   {
	   $s_m = date('n', $st);
	   $e_m = date('n', $et);
	   $s_y = date('Y', $st);
	   $e_y = date('Y', $et);
	   $total = 12 - $s_m + ($e_y - $s_y - 1) * 12 + $e_m; //计算月份差
	   return $total;
   }
   
   /*
   * 提取报修申请
   */
   static function getAskrepairLog($community_id,$pageNow,$pageNum,$status)
   {
      $start = ($pageNow-1)*$pageNum;
	  $sql = "select * from ".$GLOBALS['Base']->table('askrepair')." where community_id=$community_id ";
	  if($status==0)
	  {
	     $sql .= "and status=0 ";
	  }
	  else
	  {
	     $sql .= "and status>0 ";
	  }
	  $sql .= "order by ask_id desc ";
	  $resNum = $GLOBALS['Mysql']->getCount($sql);
	  $sql .= "limit $start, $pageNum ";
	  $res = $GLOBALS['Mysql']->getAll($sql);
	  foreach($res as $k=>$v)
	  {
	     $res[$k]['add_time'] = date('Y年n月d日',$v['add_time']);
		 $res[$k]['reply_time'] = date('Y年n月d日',$v['reply_time']);  
	  }
	  $arr['resNum'] = $resNum;
	  $arr['res'] = $res;
	  return $arr;
   }
   
   /*
   * 提取投诉建议
   */
   static function getAdviceLog($community_id,$pageNow,$pageNum,$status)
   {
      $start = ($pageNow-1)*$pageNum;
	  $sql = "select * from ".$GLOBALS['Base']->table('advice')." where community_id=$community_id ";
	  if($status==0)
	  {
	     $sql .= "and status=0 ";
	  }
	  else
	  {
	     $sql .= "and status>0 ";
	  }
	  $sql .= "order by advice_id desc ";
	  $resNum = $GLOBALS['Mysql']->getCount($sql);
	  $sql .= "limit $start, $pageNum ";
	  $res = $GLOBALS['Mysql']->getAll($sql);
	  foreach($res as $k=>$v)
	  {
	     $res[$k]['add_time'] = date('Y年n月d日',$v['add_time']);
		 $res[$k]['reply_time'] = date('Y年n月d日',$v['reply_time']);  
	  }
	  $arr['resNum'] = $resNum;
	  $arr['res'] = $res;
	  return $arr;
   }
   /*
   * 获取用户信息
   */
   static function getUserInfo($community_id,$pageNow,$pageNum,$lineNum)
   {
      $start = ($pageNow-1)*$pageNum;
      $sql = "select nickname,headimgurl from ".$GLOBALS['Base']->table('user')." where community_id = '".$community_id."' ";
      $resNum = $GLOBALS['Mysql']->getCount($sql);
      $sql .= "order by user_id ";
      $sql .="limit $start,$pageNum" ;
      $res = $GLOBALS['Mysql']->getAll($sql);
      foreach($res as $k=>$v)
      {
         if(!empty($v['headimgurl']))
         {
            $res[$k]['headimgurl'] = substr($v['headimgurl'],0,-1);
            $res[$k]['headimgurl'] = $res[$k]['headimgurl']."64";
         }
      }
      $arr['resNum'] = $resNum;
      $arr['res'] = $res;
      return $arr;
   }
}
?>