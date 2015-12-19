<?php
/*
 * 首页
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);
require("includes/init.php");
require('property/includes/cls_property.php');
require('represent/includes/cls_represent.php');
Property::checkCookie();
Represent::checkCookie();
if(isset($_SESSION['property']))
{
   $Common->base_header("Location:/property/");	
}
elseif(isset($_SESSION['represent']))
{
   $Common->base_header("Location:/represent/");
}
$smarty->display('index.htm');
?>