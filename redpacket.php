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
require("includes/cls_redpacket.php");
$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']) : 'default';
$vcode = isset($_REQUEST['vcode']) ? $Common->charFormat($_REQUEST['vcode']) : '';
$prize = array("name"=>12);
$msg = array("result" => 0, "error" => 1, "data" => "系统错误","prize"=>$prize);
$admin = new Admin();
$redpacket = new Redpacket();
/* 抽取红包 */
if ($act == "draw")
{
    $activity_id = isset($_REQUEST['activity_id']) ? intval($_REQUEST['activity_id']) : 0;
    $code = isset($_REQUEST['code']) ? $Common->charFormat($_REQUEST['code']) : '';
    $activityres = $admin->getActivity($activity_id);
    if($activityres)
    {
        $coderes = $admin->getValifyCode($code,$activity_id);
        if($coderes['isvalid']==1)
        {
            $msg = array("result" => 0, "error" => 1, "data" => "验证码已禁用");
        }
        else
        {
            if($coderes['is_used']==1)
            {
                $msg = array("result" => 0, "error" => 1, "data" => "验证码已使用","money"=>$coderes['money_num']);
            }
            else
            {
                //金额为0,没有抽取过的
                if($coderes['money_num']==0)
                {
                    $moneynum = $redpacket->getMoneyNum($activityres);
                    $res = $admin->updateValifyCodeMoney($code, $activity_id, $moneynum);
                    if ($res)
                    {
                        array("result" => 0, "error" => 0, "data" => "领取成功","money"=>$moneynum);
                    }
                    else
                    {
                        array("result" => 0, "error" => 1, "data" => "系统错误，请重试");
                    }
                }
                else
                {
                    $msg = array("result" => 0, "error" => 1, "data" => "验证码已使用","money"=>$coderes['money_num']);
                }
            }
        }
    }
    else
    {
        $msg = array("result" => 0, "error" => 1, "data" => "活动不存在");
    }
}
else if($act == "receive")
{
    $account = isset($_REQUEST['account']) ? $Common->charFormat($_REQUEST['account']) : '';

}

echo  "jsonpReturn(".$Json->encode(array("name"=>"asd")).");";
//return $Json->encode($msg);
exit;
?>