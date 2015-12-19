<?php

if(!defined('IN_BS'))
{
  die('hacking attempt');
}

/*
* 启用微信api接口
*/
class Wx  extends Common {

   private static $member_url = "https://api.weixin.qq.com/cgi-bin/user/info?";
   
   private static $qr_ticket_url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=";
   private static $qr_url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=";

   private static $mediaposturl = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=";
   
   /*
    * 获取access_token
   */
   private static function getAccess_token()
   {   
       $token_url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.APPID.'&secret='.APPSECRET;
       $access_token = parent::file_get($token_url);
	   $access_token = json_decode($access_token);  
	   return $access_token;   
   } 
   
   /*
   * 获取有效的access_token
   */
  static function setAccess_token()
   {
       $expire =  time() + 60;   //防止响应延时，access_token提前1分钟过期
       $sql = "select access_token from ".$GLOBALS['Base']->table('access_token')." where expire > $expire limit 0, 1 "; 
	   $access_token = $GLOBALS['Mysql']->getOne($sql); 
	   /* 数据库中access_token可用 */
	   if($access_token)
	   {  
	      return $access_token;
	   }    
	   /* 重新获取access_token，并保存数据库 */
       else
	   {
	      $access_token = self::getAccess_token();
		  $sql = "update ".$GLOBALS['Base']->table('access_token')." set access_token='".$access_token->access_token."', expire=".(time()+$access_token->expires_in)." ";
		  $GLOBALS['Mysql']->query($sql);
          return $access_token->access_token;  
	   }
   }
   
   /*
   * 获取二维码ticket
   */
   private static function getqrticket($scene_id)
   {
       $qr_ticket_url  = self::$qr_ticket_url.self::setAccess_token();
	   $keysArr = '{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": '.$scene_id.'}}}';
       $ticket = parent::file_post($qr_ticket_url,$keysArr);
	   $ticket = $GLOBALS['Json']->decode($ticket);
	   return $ticket->ticket;
   }
   
   /*
   * 获取二维码图片
   */
   public function getqr($scene_id)
   { 
      $qr_url =  self::$qr_url;
	  $qr_url .= self::getqrticket($scene_id);   
	  $qr = parent::file_get($qr_url);
	  return $qr;
   }
   
   /*
   * 上传多媒体文件
   */
   public function uploadmedia($type, $data)
   {
      $mediaposturl = self::$mediaposturl.self::setAccess_token()."&type=".$type; 
	  $result = parent::file_post($mediaposturl,$data);
	  return $result;
   }
   
}

?>