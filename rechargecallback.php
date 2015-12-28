<?php
/**
 * Created by PhpStorm.
 * User: changsu
 * Date: 2015/12/28
 * Time: 16:38
 */

define("IN_BS", true);
require("includes/init.php");
require("admin/includes/cls_admin.php");
require("includes/cls_rechage.php");
require("includes/cls_phonegift.php");

$state = isset($_REQUEST['state']) ? $Common->charFormat($_REQUEST['state']) : '0';
$orderid = isset($_REQUEST['orderid']) ? $Common->charFormat($_REQUEST['orderid']) : '';
$ordertime = isset($_REQUEST['ordertime']) ? $Common->charFormat($_REQUEST['ordertime']) : '';
$sign = isset($_REQUEST['sign']) ? $Common->charFormat($_REQUEST['sign']) : '';
$err_msg = isset($_REQUEST['err_msg']) ? $Common->charFormat($_REQUEST['err_msg']) : '';

