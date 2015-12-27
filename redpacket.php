<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/13
 * Time: 22:12
 */
define("IN_BS", true);
require("includes/init.php");
require("admin/includes/cls_admin.php");
require("includes/cls_rechage.php");
require("includes/cls_phonegift.php");
$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']) : 'default';
$vcode = isset($_REQUEST['vcode']) ? $Common->charFormat($_REQUEST['vcode']) : '';
$prize = array("name" => 12);
$msg = array("result" => 0, "error" => 1, "data" => "系统错误");
$admin = new Admin();
$activity_id = isset($_REQUEST['activity_id']) ? intval($_REQUEST['activity_id']) : 0;
$code = isset($_REQUEST['code']) ? $Common->charFormat($_REQUEST['code']) : '';
$activityres = $admin->getActivity($activity_id);
$coderes = $admin->getValifyCode($code, $activity_id);
/* 抽取红包 */
if ($act == "draw") {
    if ($activityres) {
        if ($coderes['isvalid'] == 1) {
            $msg = array("result" => 0, "error" => 1, "data" => "验证码已禁用");
        } else {
            if ($coderes['is_used'] == 1) {
                $msg = array("result" => 0, "error" => 1, "data" => "验证码已使用", "money" => $coderes['money_num']);
            } else {
                //看看是否验证过
                if ($coderes['is_valified'] == 0) {
                    $moneynum = 0;
                    switch ($activityres['gift_type']) {
                        case 0:
                            $phonegift = new Phonegift($activityres, $coderes);
                            $moneynum = $phonegift->getMoneyNum();
                            break;
                        default:
                            echo $Json->encode(array("result" => 0, "error" => 1, "data" => "不支持的礼物方式"));
                            exit;
                    }

                    $res = $admin->updateValifyCodeMoney($code, $activity_id, $moneynum);
                    if ($res) {
                        $msg = array("result" => 0, "error" => 0, "data" => "验证成功", "money" => $moneynum);
                    } else {
                        $msg = array("result" => 0, "error" => 1, "data" => "系统错误，请重试");
                    }
                } else {
                    $msg = array("result" => 0, "error" => 1, "data" => "验证码已验证", "money" => $coderes['money_num']);
                }
            }
        }
    } else {
        $msg = array("result" => 0, "error" => 1, "data" => "活动不存在");
    }

    echo $Json->encode($msg);
} else if ($act == "receive") {
    $account = isset($_REQUEST['account']) ? $Common->charFormat($_REQUEST['account']) : '';
    switch ($activityres['gift_type']) {
        // 话费
        case "0":
            $phonegift = new Phonegift($activityres,$coderes);
            $asd = $phonegift->recharge($account);
            break;
        default:
            $msg = array("result" => 0, "error" => 1, "data" => "未支持的礼物方式");
    }
}

echo "jsonpReturn(" . $Json->encode(array("name" => "asd")) . ");";
//return $Json->encode($msg);
exit;
?>