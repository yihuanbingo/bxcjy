<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/12
 * Time: 16:46
 */
define("IN_BS",true);

require("../includes/init.php");
require('includes/cls_admin.php');
//Admin::checkAdminLogin();

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'default' ;
$aid = $_SESSION['admin']['aid'];

/* 验证码列表 */
if($act=='default')
{
    //todo
    $pageNow = isset($_REQUEST['page']) ? intval($_REQUEST['page']): 1 ;
    $pageNum = 10;
    $activity = isset($_REQUEST['activity']) ? intval($_REQUEST['activity']) : 0;
    $valifycode = isset($_REQUEST['valifycode']) ? $Common->charFormat($_REQUEST['valifycode']) : '';
    $list = Admin::getValify($pageNow,$pageNum,$activity,$valifycode);
    $pages = Admin::setPage($pageNum,$pageNow,$list['resNum']);
    $activitylist = Admin::getAllActivity();
    $smarty->assign('list',$list);
    $smarty->assign('pages',$pages);
    $smarty->assign('activitylist',$activitylist);
    $smarty->assign('activity',$activity);
    $smarty->assign('valifycode',$valifycode);
}
/* �½�� */
if($act=='add_activity')
{
    $key = isset($_REQUEST['key']) ? $Common->charFormat($_REQUEST['key']) : '';
    if(empty($key))
    {
        $community = $Mysql->getAll("select community_id,community_name from ".$Base->table('community'));
        $smarty->assign('community',$community);
    }
    elseif($key=='do_add')
    {
        $msg = array("error"=>1,"data"=>"ϵͳ����");
        $name = isset($_POST['name']) ? $Common->charFormat($_POST['name']) : '';
        $descrpition = isset($_POST['descrpition']) ? $Common->charFormat($_POST['descrpition']) : '';
        $gift_type = isset($_POST['gift_type']) ? intval($_POST['gift_type']) : 0;
        $money_type = isset($_POST['money_type']) ? intval($_POST['money_type']) : 0;
        $money_num = isset($_POST['money_num']) ? doubleval($_POST['money_num']) : 0;
        $image_address = isset($_POST['image_address']) ? $Common->charFormat($_POST['image_address']) : '';

        if(empty($name))
        {
            $msg = array('error'=>1,'data'=>'����������');
        }
        elseif($Mysql->getOne("select key_id from ".$Base->table('activity')." where name = '".$name."'"))
        {
            $msg = array("error"=>1,"data"=>"����Ѵ���");
        }
        else
        {
            $data = array('name'=>$name,'descrpition'=>$descrpition,'gift_type'=>$gift_type,'money_type'=>$money_type,
                'money_num'=>$money_num,'image_address'=>$image_address);
            $table = $Base->table('activity');
            if($Mysql->insert($data,$table))
            {
                $msg = array("error"=>0,"data"=>"�½��ɹ�","href"=>"/admin/activity.php");
            }
        }
        $msg = $Json->encode($msg);
        echo $msg;
        exit;
    }
}
/* ɾ���˻� */
elseif($act=='delete_account')
{
    $account_id = isset($_POST['account_id']) ? $_POST['account_id'] : 0;
    $msg = array("error"=>1,"data"=>"ϵͳ����������");
    $sql = "delete from ".$Base->table('account')." where account_id = ".$account_id;
    if($Mysql->query($sql))
    {
        $msg = array("error"=>0,"data"=>"ɾ���ɹ�");
    }
    $msg = $Json->encode($msg);
    echo $msg;
    exit;
}
$smarty->assign('act',$act);
$smarty->assign('nav','valifycode');
chdir('../');
$smarty->display("admin/valifycode.htm");

?>