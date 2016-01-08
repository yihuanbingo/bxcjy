<?php
/**
 * Created by PhpStorm.
 * User: changsu
 * Date: 2015/12/29
 * Time: 11:34
 */
define("IN_BS", true);

require("../includes/init.php");
require('includes/cls_admin.php');
require("../includes/PHPExcel/PHPExcel.php");
require("../includes/PHPExcel/PHPExcel/Writer/Excel2007.php");
require("../includes/PHPExcel/PHPExcel/Writer/Excel5.php");
Admin::checkAdminLogin();
$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']) : 'default';
$aid = $_SESSION['admin']['aid'];
$admin = new Admin();
$activity_id = isset($_REQUEST['activity_id']) ? $Common->charFormat($_REQUEST['activity_id']) : 0;
/* 充值记录列表 */
if ($act == 'default') {
    //todo
    $pageNow = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
    $pageNum = 15;

    $activity = isset($_REQUEST['activity']) ? $Common->charFormat($_REQUEST['activity']) : 0;
    $valifycode = isset($_REQUEST['valifycode']) ? $Common->charFormat($_REQUEST['valifycode']) : '';
    $tradeaccount = isset($_REQUEST['tradeaccount']) ? $Common->charFormat($_REQUEST['tradeaccount']) : '';
    $status = isset($_REQUEST['status']) ? intval($_REQUEST['status']) : -1;
    $activitylist = $admin->getAllActivity();
    $list = $admin->getRechargeRecord($pageNow, $pageNum, $activity, $valifycode, $tradeaccount, $status);
    $pages = Admin::setPage($pageNum, $pageNow, $list['resNum']);
    $smarty->assign('list', $list);
    $smarty->assign('pages', $pages);
    $smarty->assign('activitylist', $activitylist);
    $smarty->assign('activity', $activity);
    $smarty->assign('status', $status);
    $smarty->assign('tradeaccount', $tradeaccount);
    $smarty->assign('valifycode', $valifycode);
}

//导出
if ($act == 'export') {
    $activity = isset($_REQUEST['activity']) ? $Common->charFormat($_REQUEST['activity']) : 0;
    $valifycode = isset($_REQUEST['valifycode']) ? $Common->charFormat($_REQUEST['valifycode']) : '';
    $tradeaccount = isset($_REQUEST['tradeaccount']) ? $Common->charFormat($_REQUEST['tradeaccount']) : '';
    $status = isset($_REQUEST['status']) ? intval($_REQUEST['status']) : -1;
    $list = $admin->getRechargeRecordByCondition($activity, $valifycode, $tradeaccount, $status);
    $objPHPExcel = new PHPExcel();

    $objPHPExcel->getActiveSheet()->setCellValue('A1', '订单号');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', '活动名称');
    $objPHPExcel->getActiveSheet()->setCellValue('C1', '验证码');
    $objPHPExcel->getActiveSheet()->setCellValue('D1', '充值金额');
    $objPHPExcel->getActiveSheet()->setCellValue('E1', '交易平台');
    $objPHPExcel->getActiveSheet()->setCellValue('F1', '手机号');
    $objPHPExcel->getActiveSheet()->setCellValue('G1', '交易状态');
    $objPHPExcel->getActiveSheet()->setCellValue('H1', '返回消息');
    $objPHPExcel->getActiveSheet()->setCellValue('I1', '交易时间');
    for ($i = 2; $i <= count($list) + 1; $i++) {
        $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objPHPExcel->getActiveSheet()->setCellValueExplicit('A' . $i, $list[$i - 2]['orderid'], PHPExcel_Cell_DataType::TYPE_STRING);
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $list[$i - 2]['activity_name']);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $list[$i - 2]['valifycode']);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $list[$i - 2]['money_num']);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $list[$i - 2]['tradeplat']);
        $objPHPExcel->getActiveSheet()->setCellValueExplicit('F' . $i, $list[$i - 2]['tradeaccount'],PHPExcel_Cell_DataType::TYPE_STRING);
        if ($list[$i - 2]['tradestatus'] == 0) {
            $status = "充值中";
        } elseif ($list[$i - 2]['tradestatus'] == 1) {
            $status = "成功";
        } else {
            $status = "失败";
        }
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $status);
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $list[$i - 2]['message']);
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $list[$i - 2]['add_time']);
    }

    $date = date("ymdHis", time());
    $outputFileName = "交易记录" . $date . ".xls";
    $write = new PHPExcel_Writer_Excel5($objPHPExcel);
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
    header("Content-Type:application/force-download");
    header("Content-Type:application/vnd.ms-execl");
    header("Content-Type:application/octet-stream");
    header("Content-Type:application/download");;
    header('Content-Disposition:attachment;filename="' . $outputFileName . '"');
    header("Content-Transfer-Encoding:binary");
    $write->save('php://output');
    exit;
}

$smarty->assign('act', $act);
$smarty->assign('nav', 'rechargerecord');
chdir('../');
$smarty->display("admin/rechargerecord.htm");
?>