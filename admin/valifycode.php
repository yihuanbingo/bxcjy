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

/* 活动列表 */
if($act=='default')
{
    //todo
    $pageNow = isset($_REQUEST['page']) ? intval($_REQUEST['page']): 1 ;
    $pageNum = 10;
    $list = Admin::getValify($pageNow,$pageNum);
    $pages = Admin::setPage($pageNum,$pageNow,$list['resNum']);
    $smarty->assign('list',$list);
    $smarty->assign('pages',$pages);
}
/* 新建活动 */
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
        $msg = array("error"=>1,"data"=>"系统错误");
        $name = isset($_POST['name']) ? $Common->charFormat($_POST['name']) : '';
        $descrpition = isset($_POST['descrpition']) ? $Common->charFormat($_POST['descrpition']) : '';
        $gift_type = isset($_POST['gift_type']) ? intval($_POST['gift_type']) : 0;
        $money_type = isset($_POST['money_type']) ? intval($_POST['money_type']) : 0;
        $money_num = isset($_POST['money_num']) ? doubleval($_POST['money_num']) : 0;
        $image_address = isset($_POST['image_address']) ? $Common->charFormat($_POST['image_address']) : '';

        if(empty($name))
        {
            $msg = array('error'=>1,'data'=>'请输入活动名称');
        }
        elseif($Mysql->getOne("select key_id from ".$Base->table('activity')." where name = '".$name."'"))
        {
            $msg = array("error"=>1,"data"=>"活动名已存在");
        }
        else
        {
            $data = array('name'=>$name,'descrpition'=>$descrpition,'gift_type'=>$gift_type,'money_type'=>$money_type,
                'money_num'=>$money_num,'image_address'=>$image_address);
            $table = $Base->table('activity');
            if($Mysql->insert($data,$table))
            {
                $msg = array("error"=>0,"data"=>"新建成功","href"=>"/admin/activity.php");
            }
        }
        $msg = $Json->encode($msg);
        echo $msg;
        exit;
    }
}
/* 删除账户 */
elseif($act=='delete_account')
{
    $account_id = isset($_POST['account_id']) ? $_POST['account_id'] : 0;
    $msg = array("error"=>1,"data"=>"系统错误，请重试");
    $sql = "delete from ".$Base->table('account')." where account_id = ".$account_id;
    if($Mysql->query($sql))
    {
        $msg = array("error"=>0,"data"=>"删除成功");
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