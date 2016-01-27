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
Admin::checkAdminLogin();

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'default' ;
$aid = $_SESSION['admin']['aid'];
$admin = new Admin();
/* 活动列表 */
if($act=='default')
{
    //todo
    $pageNow = isset($_REQUEST['page']) ? intval($_REQUEST['page']): 1 ;
    $pageNum = 10;
    $list = Admin::getActivityList($pageNow,$pageNum);
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
        $name = isset($_POST['name']) ? $Common->charFormat($_REQUEST['name']) : '';
        $descrpition = isset($_REQUEST['descrpition']) ? $Common->charFormat($_REQUEST['descrpition']) : '';
        $activity_rule = isset($_REQUEST['activity_rule']) ? $_REQUEST['activity_rule'] : '';
        $gift_type = isset($_REQUEST['gift_type']) ? intval($_REQUEST['gift_type']) : 0;
        $money_type = isset($_REQUEST['money_type']) ? intval($_REQUEST['money_type']) : 0;
        $money_num = isset($_REQUEST['money_num']) ? doubleval($_REQUEST['money_num']) : 0;
        $image_address = isset($_REQUEST['image_address']) ? $Common->charFormat($_REQUEST['image_address']) : '';

        $money_rule = '';
        if($money_type==0)
        {
            $money_rule = $money_num;
        }
        else
        {
            if($gift_type==0)
            {
                $huafei0 = isset($_REQUEST['huafei0']) ? intval($_REQUEST['huafei0']) : 0;
                $huafei1 = isset($_REQUEST['huafei1']) ? intval($_REQUEST['huafei1']) : 0;
                $huafei2 = isset($_REQUEST['huafei2']) ? intval($_REQUEST['huafei2']) : 0;
                $huafei5 = isset($_REQUEST['huafei5']) ? intval($_REQUEST['huafei5']) : 0;
                $huafei10 = isset($_REQUEST['huafei10']) ? intval($_REQUEST['huafei10']) : 0;
                $huafei20 = isset($_REQUEST['huafei20']) ? intval($_REQUEST['huafei20']) : 0;
                $money_rule = "0:".$huafei0."|1:".$huafei1."|2:".$huafei2."|5:".$huafei5."|10:".$huafei10."|20:".$huafei20;
            }
        }

        if(empty($name))
        {
            $msg = array('error'=>1,'data'=>'请输入活动名称');
        }
        else
        {
            $key_id = $Common->get_orderid("hd");
            $activi_url = "http://hd.bxcjy.com/?activity_id=".$key_id;
            $data = array('key_id'=>$key_id, 'name'=>$name,'descrpition'=>$descrpition, 'activity_rule'=>$activity_rule,
                'gift_type'=>$gift_type,'money_type'=>$money_type, 'image_address'=>$image_address,'money_rule'=>$money_rule,
                'activi_url'=>$activi_url,'add_time'=>date('Y-m-d H:i:s'));
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

/* 修改活动 */
if($act=='edit_activity')
{
    $key = isset($_REQUEST['key']) ? $Common->charFormat($_REQUEST['key']) : '';
    $activity_id = isset($_REQUEST['activity_id']) ? $Common->charFormat($_REQUEST['activity_id']) : '';
    $activity = $admin->getActivity($activity_id);
    if(empty($key))
    {
        //随机
        if($activity['money_type']==1)
        {
            $ruleres = array();
            $rulearr = explode('|', $activity['money_rule']);
            foreach ($rulearr as $v) {
                $arr = explode(':', $v);
                $ruleres[$arr[0]] = $arr[1];
            }
            $smarty->assign("ruleres",$ruleres);
        }
    }
    elseif($key=='do_edit')
    {
        $msg = array("error"=>1,"data"=>"系统错误");
        $name = isset($_POST['name']) ? $Common->charFormat($_REQUEST['name']) : '';
        $descrpition = isset($_REQUEST['descrpition']) ? $Common->charFormat($_REQUEST['descrpition']) : '';
        $activity_rule = isset($_REQUEST['activity_rule']) ? $_REQUEST['activity_rule'] : '';
        $gift_type = isset($_REQUEST['gift_type']) ? intval($_REQUEST['gift_type']) : 0;
        $money_type = isset($_REQUEST['money_type']) ? intval($_REQUEST['money_type']) : 0;
        $money_num = isset($_REQUEST['money_num']) ? doubleval($_REQUEST['money_num']) : 0;
        $image_address = isset($_REQUEST['image_address']) ? $Common->charFormat($_REQUEST['image_address']) : '';

        $money_rule = '';
        if($money_type==0)
        {
            $money_rule = $money_num;
        }
        else
        {
            if($gift_type==0)
            {
                $huafei0 = isset($_REQUEST['huafei0']) ? intval($_REQUEST['huafei0']) : 0;
                $huafei1 = isset($_REQUEST['huafei1']) ? intval($_REQUEST['huafei1']) : 0;
                $huafei2 = isset($_REQUEST['huafei2']) ? intval($_REQUEST['huafei2']) : 0;
                $huafei5 = isset($_REQUEST['huafei5']) ? intval($_REQUEST['huafei5']) : 0;
                $huafei10 = isset($_REQUEST['huafei10']) ? intval($_REQUEST['huafei10']) : 0;
                $huafei20 = isset($_REQUEST['huafei20']) ? intval($_REQUEST['huafei20']) : 0;
                $money_rule = "0:".$huafei0."|1:".$huafei1."|2:".$huafei2."|5:".$huafei5."|10:".$huafei10."|20:".$huafei20;
            }
        }

        if(empty($name))
        {
            $msg = array('error'=>1,'data'=>'请输入活动名称');
        }
        else
        {
            $data = array('name'=>$name,'descrpition'=>$descrpition,'activity_rule'=>$activity_rule, 'gift_type'=>$gift_type,
                'money_type'=>$money_type, 'image_address'=>$image_address,'money_rule'=>$money_rule);
            $table = $Base->table('activity');
            $where = array('key_id'=>$activity_id);
            if($Mysql->update($data,$table,$where))
            {
                $msg = array("error"=>0,"data"=>"修改成功","href"=>"/admin/activity.php");
            }
        }
        $msg = $Json->encode($msg);
        echo $msg;
        exit;
    }
    $smarty->assign('activity',$activity);
    $smarty->assign('act',$act);
    $smarty->assign('nav','activity');
    chdir('../');
    $smarty->display("admin/activity_edit.htm");
    exit;
}

/* 删除活动 */
elseif($act=='delete_activity')
{
    $activity_id = isset($_POST['activity_id']) ? $_POST['activity_id'] : '';
    $msg = array("error"=>1,"data"=>"系统错误，请重试");
    $sql = "delete from ".$Base->table('activity')." where key_id = '$activity_id'";
    if($Mysql->query($sql))
    {
        $msg = array("error"=>0,"data"=>"删除成功");
    }
    $msg = $Json->encode($msg);
    echo $msg;
    exit;
}

$smarty->assign('act',$act);
$smarty->assign('nav','activity');
chdir('../');
$smarty->display("admin/activity.htm");

?>