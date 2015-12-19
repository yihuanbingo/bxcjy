<?php
/*
 * 小区介绍
 * author yuanjiang @2.16.2013
*/
define("IN_BS",true);
require("../includes/init.php");
require("includes/cls_property.php");
Property::checkUserLogin();

$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']): 'default' ;
$community_id = $_SESSION['property']['community_id'];

/* 小区介绍 */
if($act=='default')
{
   $sql = "select community_name, property_name, province, city, district, address, lng, lat, intro ".
          "from ".$Base->table('community')." where community_id = $community_id ";
   $row = $Mysql->getRow($sql); 
   $smarty->assign('row',$row);
   $smarty->assign('province',$row['province']);
   $smarty->assign('city',$row['city']);
   $smarty->assign('district',$row['district']);
}
/* 小区介绍操作 */
elseif($act=='act_default')
{
   $community_name = isset($_POST['community_name']) ? $Common->charFormat($_POST['community_name']):'';
   $property_name = isset($_POST['property_name']) ? $Common->charFormat($_POST['property_name']): '';
   $province = intval($_POST['province']);
   $city = intval($_POST['city']);
   $district = intval($_POST['district']);
   $address = isset($_POST['address']) ? $Common->charFormat($_POST['address']): '';
   $lng = isset($_POST['lng']) ? $Common->charFormat($_POST['lng']): '';
   $lat = isset($_POST['lat']) ? $Common->charFormat($_POST['lat']): '';
   $intro = isset($_POST['intro']) ? $_POST['intro']: '' ;
   if(empty($community_name))
   {
      $msg = array(
	  'error'=>1,
	  'data'=>'请填写小区名称',
	  );
   }
   elseif(empty($property_name))
   {
      $msg = array(
	  'error'=>1,
	  'data'=>'请填写物业名称',
	  );
   }
   elseif($province==0 || $city==0 || $district ==0)
   {
      $msg = array(
	  'error'=>1,
	  'data'=>'请选择所在省市区',
	  );
   }
   elseif(empty($address))
   {
      $msg = array(
	  'error'=>1,
	  'data'=>'请填写小区详细地址',
	  );
   }
   elseif(empty($lng) || empty($lat))
   {
      $msg = array(
	  'error'=>1,
	  'data'=>'请点选小区经度和纬度',
	  );
   }
   elseif(empty($intro))
   {
      $msg = array(
	  'error'=>1,
	  'data'=>'请填写小区介绍信息',
	  );
   }
   else
   {
      /* 删除用户已删除的图片，清理服务器空间 */
      $intro_old = $Mysql->getOne("select intro from ".$Base->table('community')." where community_id=$community_id ");
	  $pic_old = $Common->get_pic_html($intro_old);  //原来的图片数组  
	  $pic_now = $Common->get_pic_html(stripslashes($intro));   //现在的图片数组，stripslashes()去掉php自动添加的转义符
	  foreach($pic_old as $v)
	  {
		  if(!in_array($v,$pic_now))
		  {
		      $old = getcwd();    // Save the current directory
              chdir('../');
              @unlink(substr($v,1));           //删除图片
              chdir($old);
		  }
	  }
	  /* 删除用户已删除的图片，清理服务器空间 end */
      $data = array(
	  'community_name'=>$community_name,
	  'property_name'=>$property_name,
	  'province'=>$province,
	  'city'=>$city,
	  'district'=>$district,
	  'address'=>$address,
	  'lng'=>$lng,
	  'lat'=>$lat,
	  'intro'=>$intro,
	  );
	  $table = $Base->table('community');
	  $where = array('community_id'=>$community_id);
	  if($Mysql->update($data,$table,$where))
	  {
	     $msg = array(
		 'error'=>0,
		 'data'=>'恭喜，小区信息编辑成功',
		 );
	  }
   }
   $msg = $Json->encode($msg);
   echo $msg;
   exit;
}
/* 展示二给码参数图片 */
elseif($act=='qrscene')
{
   /*
   function createImg($bg,$logo,$dir)
   {
      $bg_img = Imagecreatefromjpeg($bg);
	  $logo_img =  Imagecreatefrompng($logo);
	  imagecopy($bg_img,$logo_img,179,179,0,0,72,72);
	  Imagejpeg($bg_img,$dir.'qrscene_'.$GLOBALS['community_id'].'.jpg');
   }
   $dir = '../data/qrscene/201406/';
   $qr = 'http://property.bangsoon.cn/property/qrscene.php';
   createImg($qr,$logo='../templates/images/logo_qr.png',$dir);
   $smarty->assign('qrscene', $dir.'qrscene_'.$community_id.'.jpg');
   */
   
}
/* 取得二维码参数图片*/
elseif($act=='getqrscene')
{
   require('../includes/cls_Wx.php');
   $qr = Wx::getqr($community_id);
   echo $qr;
   exit;
}


$smarty->assign('act',$act);
$smarty->assign('nav','intro');
chdir('../');
$smarty->display("property/intro.htm");

?>