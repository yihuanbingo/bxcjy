<?php

if (!defined('IN_BS')) {
    die('hacking attempt');
}

require_once("cls_common.php");

class Redpacket
{
    function getMoneyNum($activity)
    {
        $money = 0;
        switch ($activity['money_type']) {
            case 0:
                $money = $activity['money_num'];
                break;
            case 1:
                $money = mt_rand($activity['money_min'] * 100, $activity['money_max'] * 100) / 100;
                break;
            default:
                $money = $activity['money_num'];
        }

        return $money;
    }
}


?>