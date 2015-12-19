<?php
/*
 * 物业后台专用类
 * author yuanjiang @2.16.2013
*/
if(!defined('IN_BS'))
{
  die('hacking attempt');
}
 
class Property extends Common
{

   /*
   * 检查用户是否登录
   */
   static function checkUserLogin()
   {
	  self::checkCookie();
      if(isset($_SESSION['property']))
	  {
         $GLOBALS['smarty']->assign('online',$_SESSION['property']);
	  }
	  else
	  {
	     parent::base_header("Location:/property/login\n");
	  }
   }
   /*检查COOKIE*/
   static function checkCookie()
   {
	  if(isset($_COOKIE['property']) && !isset($_SESSION['property']))
	   {
		   
		   $cookie = unserialize($_COOKIE['property']);
		   if($user = $GLOBALS['Mysql']->getRow("select community_id, account from ".$GLOBALS['Base']->table('account')." where type=1 and account = '".$cookie['account']."' and passwd = '".$cookie['passwd']."'"))
		   {
		       $_SESSION['property'] = $user ;
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
         $GLOBALS['smarty']->display("property/NoExistHouseholder.htm");
   	  }	 
   }
   
   /*
   * 检查上传文件类型
   * param String file_name
   * return boolean
   */
   static function check_excel_type($file_name)
   {
      return $file_name == 'application/vnd.ms-excel' || $file_name == 'application/octet-stream' ;     
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
   * 提取物业费记录
   */
   function getPropertyLog($community_id,$pageNow,$pageNum,$pay_late,$status,$keywords)
   { 
      $start = ($pageNow-1)*$pageNum;
	  $sql = "select blp.*, bh.house_number, bh.house_owner, bh.mobile from ".$GLOBALS['Base']->table('log_property')." as blp, ".$GLOBALS['Base']->table('householder')." as bh ".
	          "where blp.householder_id=bh.householder_id and bh.community_id=$community_id ";
	  if($status==0)   //欠费
	  {
	     $sql .= "and blp.pay_late<$pay_late ";   
	  }		  
	  if($status==1)   //正常
	  {
	     $sql .= "and blp.pay_late>=$pay_late ";
	  }
	  if(!empty($keywords))
	  {
	     $sql .= "and (bh.house_number like '%$keywords%' || bh.house_owner like '%$keywords%' || bh.mobile like '%$keywords%') ";
	  }
	  $sql .= "order by bh.householder_id asc ";
	  $resNum = $GLOBALS['Mysql']->getCount($sql);
	  $sql .= "limit $start, $pageNum ";  
	  $res = $GLOBALS['Mysql']->getAll($sql);
	  foreach($res as $k=>$v)
	  {
	     $res[$k]['status'] = time() < strtotime('next month',$v['pay_late']) ? 1: 0 ;  //strtotime为缴费时的下个月第一天
	     if($res[$k]['status']==0) //欠费，则计算欠费多少
		 {
		    $res[$k]['arrearage'] = number_format(self::getMonthNum($v['pay_late'],time()) * $v['pay_month'],2); 
		 }
		 $res[$k]['pay_late'] = date('Y-m',$v['pay_late']);
	  }
	  $re['resNum'] = $resNum;
	  $re['res'] = $res;
	  return $re;
   }
   
   /*
   * 提取停车费记录
   */
   function getParkLog($community_id,$pageNow,$pageNum,$pay_late,$status,$keywords)
   { 
      $start = ($pageNow-1)*$pageNum;
	  $sql = "select blp.*, bh.house_number, bh.house_owner, bh.mobile from ".$GLOBALS['Base']->table('log_park')." as blp, ".$GLOBALS['Base']->table('householder')." as bh ".
	          "where blp.householder_id=bh.householder_id and bh.community_id=$community_id ";
	  if($status==0)   //欠费
	  {
	     $sql .= "and blp.pay_late<$pay_late ";   
	  }		  
	  if($status==1)   //正常
	  {
	     $sql .= "and blp.pay_late>=$pay_late ";
	  }
	  if(!empty($keywords))
	  {
	     $sql .= "and (bh.house_number like '%$keywords%' || bh.house_owner like '%$keywords%' || bh.mobile like '%$keywords%') ";
	  }
	  $sql .= "order by bh.householder_id asc ";
	  $resNum = $GLOBALS['Mysql']->getCount($sql);
	  $sql .= "limit $start, $pageNum ";  
	  $res = $GLOBALS['Mysql']->getAll($sql);
	  foreach($res as $k=>$v)
	  {
	     $res[$k]['status'] = time() < strtotime('next month',$v['pay_late']) ? 1: 0 ;  //strtotime为缴费时的下个月第一天
	     if($res[$k]['status']==0) //欠费，则计算欠费多少
		 {
		    $res[$k]['arrearage'] = number_format(self::getMonthNum($v['pay_late'],time()) * $v['pay_month'],2); 
		 }
		 $res[$k]['pay_late'] = date('Y-m',$v['pay_late']);
	  }
	  $re['resNum'] = $resNum;
	  $re['res'] = $res;
	  return $re;
   }
   
   /*
   * 提取代收快递记录
   */
   function getExpressLog($community_id,$pageNow,$pageNum,$status,$keywords)
   { 
      $start = ($pageNow-1)*$pageNum;
	  $sql = "select * from ".$GLOBALS['Base']->table('log_express')." ".
	          "where community_id=$community_id ";
	  if($status==0)   //欠费
	  {
	     $sql .= "and status=0 ";   
	  }		  
	  if($status==1)   //正常
	  {
	     $sql .= "and status=1 ";
	  }
	  if(!empty($keywords))
	  {
	     $sql .= "and (name like '%$keywords%' || phone like '%$keywords%' || express_sn like '%$keywords%') ";
	  }
	  $sql .= "order by log_id desc ";
	  $resNum = $GLOBALS['Mysql']->getCount($sql);
	  $sql .= "limit $start, $pageNum ";  
	  $res = $GLOBALS['Mysql']->getAll($sql);
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
	* 提取待解决报修申请数目
	*/
	static function getNoAskrepairNum($community_id)
	{
		$sql = "select * from ".$GLOBALS['Base']->table('askrepair')." where community_id=$community_id and status = 0";
		$num = $GLOBALS['Mysql']->getCount($sql);
		return $num;
	}
	/*
	* 提取待解决投诉建议数目
	*/
	static function getNoAdviceNum($community_id)
	{
		$sql = "select * from ".$GLOBALS['Base']->table('advice')." where community_id=$community_id and status = 0";
		$num = $GLOBALS['Mysql']->getCount($sql);
		return $num;
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