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
$admin = new Admin();
$activity_id = isset($_REQUEST['activity_id']) ? $Common->charFormat($_REQUEST['activity_id']) : '';
$code = isset($_REQUEST['code']) ? $Common->charFormat($_REQUEST['code']) : '';
$activityres = $admin->getActivity($activity_id);
$coderes = $admin->getValifyCode($code, $activity_id);
/* 抽取红包 */
if ($act == "draw") {
    if (!empty($_SESSION['draw_time']) && (time() - $_SESSION['draw_time']) < 2) {
        $msg = array("result" => $_SESSION['request_time'], "error" => 1, "data" => "请求过快");
        exit($Json->encode($msg));
    }

    if ($activityres) {
        if ($coderes) {
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
//                                $phonegift = new Phonegift($activityres, $coderes);
//                                $moneynum = $phonegift->getMoneyNum();
                                $moneynum = $coderes['money_num'];
                                break;
                            default:
                                echo $Json->encode(array("result" => 0, "error" => 1, "data" => "不支持的礼物方式"));
                                exit;
                        }

//                      $res = $admin->updateValifyCodeMoney($code, $activity_id, $moneynum);
                        $msg = array("result" => 0, "error" => 0, "data" => "验证成功", "money" => $moneynum);
                    } else {
                        $msg = array("result" => 0, "error" => 0, "data" => "验证码已验证", "money" => $coderes['money_num']);
                    }
                }
            }
        } else {
            $msg = array("result" => 0, "error" => 1, "data" => "验证码错误");
        }
    } else {
        $msg = array("result" => 0, "error" => 1, "data" => "活动不存在");
    }
} else if ($act == "receive") {
    if (!empty($_SESSION['receive_time']) && (time() - $_SESSION['receive_time']) < 3) {
        $msg = array("result" => $_SESSION['request_time'], "error" => 1, "data" => "请求过快");
        exit($Json->encode($msg));
    }

    $_SESSION['request_time'] = time();
    $account = isset($_REQUEST['account']) ? $Common->charFormat($_REQUEST['account']) : '';
    switch ($activityres['gift_type']) {
        // 话费
        case "0":
            $phonegift = new Phonegift($activityres, $coderes);
            $msg = $phonegift->recharge($account);
            break;
        default:
            $msg = array("result" => 0, "error" => 1, "data" => "未支持的礼物方式");
    }

    if ($msg["error"] == 0) {
        $admin->updateValifyCodeUseStatus($coderes["key_id"], 1, $account);
    }
}

echo $Json->encode($msg);
//echo json_encode($msg, JSON_UNESCAPED_UNICODE);
exit;
?>