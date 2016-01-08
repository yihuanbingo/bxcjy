<?php

/**
 * Created by PhpStorm.
 * User: changsu
 * Date: 2015/12/23
 * Time: 20:00
 */
require_once("cls_rechage.php");
require_once("cls_common.php");
require_once("cls_json.php");

class Phonegift
{
    /*
     * 1:30|2:20|5:20|10:20|20:10
     * */
    private $money_rule;

    private $activity;

    private $valifycode;

    public function __construct($activity, $valifycode)
    {
        $this->activity = $activity;
        $this->valifycode = $valifycode;
    }

    public function getMoneyNum()
    {
        if (empty($this->activity['money_rule'])) {
            return 0;
        } else {
            //固定金额
            if ($this->activity['money_type'] == '0') {
                return floatval($this->activity['money_rule']);
            } else {
                //随机金额
                $ruleres = array();
                $rulearr = explode('|', $this->activity['money_rule']);
                foreach ($rulearr as $v) {
                    $arr = explode(':', $v);
                    $ruleres[$arr[0]] = $arr[1];
                }

                $standard = 0;
                //随机数1-100
                $randnum = mt_rand(1, 100);
                foreach ($ruleres as $k => $v) {
                    if ($randnum > $standard && $randnum <= ($standard + intval($v))) {
                        return floatval($k);
                    }

                    $standard = $standard + intval($v);
                }

                return 0;
            }
        }
    }

    public function recharge($phone)
    {
        $msg = array("result" => 0, "error" => 1, "data" => "系统错误，请重试");
        $common = new Common();
        $admin = new Admin();
        $json = new Services_JSON();
        $orderid = $common->get_orderid(0);
        $recharge = new Recharge(APIX_PHONE_APPKEY);
        $check = $recharge->recharge_check($phone, $this->valifycode['money_num']);
        if ($check['Code'] == '0') {

            $res = $recharge->phone_recharge($phone, $this->valifycode['money_num'], $orderid,"http://hd.bxcjy.com/rechargecallback.php");
            $data = array('orderid' => $orderid, 'activity_id' => $this->valifycode['activity_id'],
                'activity_name' => $this->valifycode['activity_name'], 'valifycode' => $this->valifycode['valifycode'],
                'money_num' => $this->valifycode['money_num'], 'tradeplat' => 'APIX', 'tradeaccount' => $phone,
                'tradestatus' => $res['Code'] == '0' ? 0 : intval($res['Code']),
                'message' =>preg_replace("#\\\u([0-9a-f]+)#ie","iconv('UCS-2','UTF-8', pack('H4', '\\1'))",$json->encode($res)) ,
                'add_time'=>date('Y-m-d H:i:s'));
            $table = $GLOBALS['Base']->table('rechargerecord');
            $GLOBALS['Mysql']->insert($data, $table);
            if ($res && $res['Code'] == '0') {
                $msg = array("result" => 1, "error" => 0, "data" => "充值成功");
            } else {
                $msg = array("result" => 0, "error" => 1, "data" => "充值失败");
            }
        } else {
            $msg = array("result" => 0, "error" => 1, "data" => $check['Msg']);
        }

        return $msg;
    }
}

?>