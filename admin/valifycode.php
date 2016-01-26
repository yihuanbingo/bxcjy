<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/12
 * Time: 16:46
 */
define("IN_BS", true);

require("../includes/init.php");
require('includes/cls_admin.php');
require("../includes/PHPExcel/PHPExcel.php");
require("../includes/PHPExcel/PHPExcel/Writer/Excel2007.php");
require("../includes/PHPExcel/PHPExcel/Writer/Excel5.php");
//Admin::checkAdminLogin();

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']) : 'default';
$aid = $_SESSION['admin']['aid'];
$admin = new Admin();
/* 验证码列表 */
if ($act == 'default') {
    //todo
    $pageNow = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
    $pageNum = 15;
    $activity = isset($_REQUEST['activity']) ? $Common->charFormat($_REQUEST['activity']) : '';
    $valifycode = isset($_REQUEST['valifycode']) ? $Common->charFormat($_REQUEST['valifycode']) : '';
    $use_account = isset($_REQUEST['use_account']) ? $Common->charFormat($_REQUEST['use_account']) : '';

    $list = $admin->getValify($pageNow, $pageNum, $activity, $valifycode, $use_account);
    $activitylist = $admin->getAllActivity();
    $pages = Admin::setPage($pageNum, $pageNow, $list['resNum']);
    $smarty->assign('list', $list);
    $smarty->assign('pages', $pages);
    $smarty->assign('activitylist', $activitylist);
    $smarty->assign('activity', $activity);
    $smarty->assign('valifycode', $valifycode);
    $smarty->assign('use_account', $use_account);
}

if($act=='valid'){
    $msg = array('error' => 1, 'data' => '系统错误');
    $key_id = isset($_REQUEST['key_id']) ? intval($_REQUEST['key_id']) : 0;
    $isvalid = isset($_REQUEST['isvalid']) ? intval($_REQUEST['isvalid']) : 0;
    $validstatus = $isvalid==0?1:0;
    if($admin->updateValifyCodeIsValid($key_id,$validstatus))
    {
        $msg = array("error"=>0,"data"=>"禁用启用成功");
    }
    $msg = $Json->encode($msg);
    echo $msg;
    exit;
}

if ($act == 'product') {
    $key = isset($_REQUEST['key']) ? $Common->charFormat($_REQUEST['key']) : '';
    $msg = array('error' => 1, 'data' => '系统错误');
    if (empty($key)) {
        $activitylist = $admin->getAllActivity();
        $smarty->assign('activitylist', $activitylist);
    } else {
        $activity = isset($_REQUEST['activity']) ? $Common->charFormat($_REQUEST['activity']) : 0;
        $codedigit = isset($_REQUEST['codedigit']) ? intval($_REQUEST['codedigit']) : 6;
        $codecount = isset($_REQUEST['codecount']) ? intval($_REQUEST['codecount']) : 0;
        $res = $admin->productValifyCodeWithNum($activity, $codecount, $codedigit);
        if ($res) {
            $msg = array('error' => 0, 'data' => '生成成功', 'href' => '/admin/valifycode.php');
        } else {
            $msg = array('error' => 1, 'data' => '生成失败');
        }

        $msg = $Json->encode($msg);
        echo $msg;
        exit;
    }
}

//导出
if ($act == 'export') {
    $activity = isset($_REQUEST['activity']) ? $Common->charFormat($_REQUEST['activity']) : 0;
    $valifycode = isset($_REQUEST['valifycode']) ? $Common->charFormat($_REQUEST['valifycode']) : '';
    $use_account = isset($_REQUEST['use_account']) ? $Common->charFormat($_REQUEST['use_account']) : '';
    $list = $admin->getValifyByCondition($activity, $valifycode, $use_account);
    $objPHPExcel = new PHPExcel();

    $objPHPExcel->getActiveSheet()->setCellValue('A1', '活动ID');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', '活动名称');
    $objPHPExcel->getActiveSheet()->setCellValue('C1', '验证码');
    $objPHPExcel->getActiveSheet()->setCellValue('D1', '金额');
    $objPHPExcel->getActiveSheet()->setCellValue('E1', '是否使用');
    $objPHPExcel->getActiveSheet()->setCellValue('F1', '是否验证');
    $objPHPExcel->getActiveSheet()->setCellValue('G1', '使用账号');
    $objPHPExcel->getActiveSheet()->setCellValue('H1', '是否禁用');
    for ($i = 2; $i <= count($list) + 1; $i++) {
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $list[$i - 2]['activity_id']);
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $list[$i - 2]['activity_name']);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $list[$i - 2]['valifycode']);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $list[$i - 2]['money_num']);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $list[$i - 2]['is_used']==0?'未使用':'已使用');
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $list[$i - 2]['is_valified']==0?'未验证':'已验证');
        $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objPHPExcel->getActiveSheet()->setCellValueExplicit('G' . $i, $list[$i - 2]['use_account'], PHPExcel_Cell_DataType::TYPE_STRING);
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $list[$i - 2]['isvalid']==0?'启用':'禁用');
    }

    $date = date("ymdHis", time());
    $outputFileName = "验证码" . $date . ".xls";
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
$smarty->assign('nav', 'valifycode');
chdir('../');
$smarty->display("admin/valifycode.htm");

?>