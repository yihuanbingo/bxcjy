<?php
/*
 * smarty配置信息
 * smarty 3.1.7
 * author yuanjiang @2.16.2013 
*/
if(!defined('IN_BS'))
{
  die('hacking attempt');
}
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT']); 
define('WEB_PATH','/');
require_once SERVER_PATH.WEB_PATH.'includes/Smarty.class.php';
$smarty=new Smarty;
$smarty->joined_template_dir=SERVER_PATH.WEB_PATH.'templates';
$smarty->compile_dir=SERVER_PATH.WEB_PATH.'templates_c';
$smarty->config_dir=SERVER_PATH.WEB_PATH.'config';
$smarty->caching = false ;   // 禁用缓存
$smarty->caching_dir = SERVER_PATH.WEB_PATH.'temp';
$smarty->left_delimiter='{';
$smarty->right_delimiter='}';

/*设置时区 东八区*/
date_default_timezone_set('Asia/Chongqing');

/* php错误报告 */
error_reporting(E_ERROR);

/* 数据库设置 */
define('HOST','localhost');
define('DB_USER','changsu');
define('DB_PASS','123456');
define('CHARSET','utf8');//编码
define('DB_NAME','bxcjy');
define('PREFIX','bxc_');//表前缀

/* 微信接口配置 */
define('APPID','wx91c5fd7d0669a634');
define('APPSECRET','70fd10a8dfbfdb8f218e3cd4307e90ad');
define('TOKEN','a23dfa3sdf34llk423oiu242342fasdf');

/* APIX话费充值APPKEY */
define('APIX_PHONE_APPKEY','307ae915fda04cdf4a1b4d9bea053f09');

define('ROOT_PATH',                     './');   // 图片上传根目录

define('CLIENT_HOST',                  'http://api.bangsoon.cn/');    //客户端响应服务器
define('WWW_HOST',                     'http://xiaoqu.bangsoon.cn/');         //PC端响应服务器

/* 短信宝接口设置 */
$smsapi = "api.smsbao.com"; //短信网关 
$charset = "utf8"; //文件编码 
$user = "bangsoon"; //短信平台帐号 
$pass = md5("www.bangsoon.cn"); //短信平台密码 

?>