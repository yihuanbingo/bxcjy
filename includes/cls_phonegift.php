<?php

/**
 * Created by PhpStorm.
 * User: changsu
 * Date: 2015/12/23
 * Time: 20:00
 */
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
                    array_push($ruleres, array($arr[0] => $arr[1]));
                }

                $standard = 0;
                $randnum = mt_rand(0,100);
                foreach($ruleres as $k=>$v)
                {
                    if($randnum>=$standard&&$randnum<($standard+intval($v)))
                    {

                    }

                    $standard = $standard+intval($v);
                }
            }
        }
    }
}