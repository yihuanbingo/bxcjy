<?php
/*
 * 首页
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);    
require("includes/init.php");    

$Common->base_header("Location:/property/\n");





class setMenu extends Common
{
   static $menu_url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=";
   
   /*
    * 获取access_token
   */
   static function getAccess_token()
   { 
       
       $token_url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.APPID.'&secret='.APPSECRET;
       $access_token = parent::file_get($token_url);
	   $access_token = $GLOBALS['Json']->decode($access_token);
	   $access_token = $access_token->access_token;
	   return $access_token;
   }
    /*
    * post自定义菜单
	* menuArr：json解析后的菜单数组
   */
   static function resetmenu($access_token,$menuArr)
   {
      $menu_url = self::$menu_url.$access_token;
	  echo $menuArr."<br>";
	  $res = parent::file_post($menu_url,$menuArr);
	  echo $res;
   }
  
   
}

$signature = isset($_GET['signature']) ? $Common->charFormat($_GET['signature']): false ;
$timestamp = isset($_GET['timestamp']) ? $Common->charFormat($_GET['timestamp']): false ;
$nonce = isset($_GET['nonce']) ? $Common->charFormat($_GET['nonce']): false ;
$echoStr = isset($_GET['echostr']) ? $_GET['echostr']: false ;

$access_token = setMenu::getAccess_token();
if(!empty($access_token))
{
   $_SESSION['wx']['access_token'] = $access_token;
 
   $menuArr = array(
   'button'=>array(
                   array('type'=>'view','name'=>urlencode('小区论坛'),'url'=>CLIENT_HOST."bbs/"), 
   			       array('name'=>urlencode('悦享生活'),'sub_button'=>array(				                                           	                                                                 array('type'=>'view','name'=>urlencode('天天有礼'),'url'=>'http://3g.inbai.com/interface/signin/signin.jsp'),
				                                                 array('type'=>'view','name'=>urlencode('生活百事通'),'url'=>CLIENT_HOST.'lifenav.html'),														
																 array('type'=>'view','name'=>urlencode('居家指南'),'url'=>CLIENT_HOST.'info.html'),	
																 //array('type'=>'view','name'=>urlencode('test'),'url'=>CLIENT_HOST.'test.php'),									
																 )),								                                 
				  array('name'=>urlencode('物业服务'),'sub_button'=>array(	
				                                                 array('type'=>'view','name'=>urlencode('我的物业'),'url'=>CLIENT_HOST.'myproperty.html'),                                          
																 array('type'=>'view','name'=>urlencode('物业通知'),'url'=>CLIENT_HOST.'notice.html'),
																 array('type'=>'view','name'=>urlencode('报修申请'),'url'=>CLIENT_HOST.'askrepair.html'),
																 array('type'=>'view','name'=>urlencode('投诉建议'),'url'=>CLIENT_HOST.'advice.html'),
															     array('type'=>'view','name'=>urlencode('选择小区'),'url'=>CLIENT_HOST.'communityintro.html'),
				                                                 )),											 
   ),
   );  
   $menuArr = urldecode(stripslashes($Json->encode($menuArr)));  
   setMenu::resetmenu($_SESSION['wx']['access_token'],$menuArr);
}


//签名验证成功
if(wx_checkSignature::checkSignature($signature, $timestamp, $nonce))   
{
   echo $echoStr;
   exit;
}


?>