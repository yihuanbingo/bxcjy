<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/13
 * Time: 22:12
 */
define("IN_BS", true);
require("includes/init.php");
$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']) : 'default';
$vcode = isset($_REQUEST['vcode']) ? $Common->charFormat($_REQUEST['vcode']) : '';
$prize = array("name"=>12);
$msg = array("result" => 0, "error" => 1, "data" => "系统错误","prize"=>$prize);
/* 活动列表 */
if ($act == 'default')
{

}
else
{

}

echo  "jsonpReturn(".$Json->encode(array("name"=>"asd")).");";
//return $Json->encode($msg);
exit;
?>