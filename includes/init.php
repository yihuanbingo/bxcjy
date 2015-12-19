<?php
/*
 * 将常用函数类集合
 * author yuanjiang @2.16.2013
*/
if(!defined('IN_BS')) 
{
 die('hacking attempt');
}

//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
error_reporting(E_ERROR);
/* 设置绝对路径，便于不同目录引用 */
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT']);
define('WEB_PATH','/');
/* 基本配置文件 */
require (SERVER_PATH.WEB_PATH.'config/config.php');

/* 语言库 */
require (SERVER_PATH.WEB_PATH.'languages/zh_cn/common.php');

/* 全局变量文件 */
require (SERVER_PATH.WEB_PATH.'includes/inc_constant.php');

/* 基本类 */
require (SERVER_PATH.WEB_PATH.'includes/cls_json.php');
require (SERVER_PATH.WEB_PATH.'includes/cls_mysql.php');
require (SERVER_PATH.WEB_PATH.'includes/cls_base.php');
require (SERVER_PATH.WEB_PATH.'includes/cls_common.php');

/* 初始化基本类 */
$Json = new Services_JSON ;
$link = mysqli_connect('localhost', 'root', '19940112', 'bxcjy');
$Mysql = new Mysql(HOST, DB_USER, DB_PASS, DB_NAME, CHARSET);
$Base = new Base(DB_NAME,PREFIX);
$Common = new Common;

/* 启用session */
session_start();

/* 前台调用 */
$smarty->assign('_lang',$_lang);

?>