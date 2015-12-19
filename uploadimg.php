<?php
/*
 * 上传图片插件
 @ return array('error'=>,'url'=>)
 @ yuanjiang  9.5.2013
 */
define("IN_BS",true);
require('includes/init.php');
require('includes/cls_image.php');

/* 定义操作 */
$act = isset($_REQUEST['act']) ? $Common->charFormat($_REQUEST['act']) : false ;

/* 未上传文件 */
if(empty($_FILES)===true)
{
   die('hacking attempt');
}

/*
 ======================================= 具体操作 ===============================================
*/
$dir_name = '/images/';
$picSize = $_FILES['imgFile']['size'];   //图片尺寸
list($picWidth, $picHeight) = getimagesize($_FILES['imgFile']['tmp_name']);   //图片高宽
 

/* 通知详情的图片 */
if($act=='notice' || $act=='intro' || $act=='info' || $act=='lifenav')
{
   $maxSize =  1*1024*1024 ;
   $dir_name .= $act ;
   if($picSize>$maxSize)    // 检查图片大小 
   {
      $msg['error'] = 1;
      $msg['message'] = '上传图片不能大于1M' ;
   }
   else
   {
      $cls_image = new cls_image('#ffffff',$dir_name);
      $upload = isset($_FILES['imgFile']) ? $_FILES['imgFile'] : '' ;
      $msg = $cls_image-> upload_image($upload, $dir = '', $img_name = '');  
      if($msg['error']==0)
      {
		 $msg['url'] = $msg['msg'];
		 if($picWidth>640)      //上传图片超过640px，则生成缩略图
		 { 
		    $msg['msg'] = substr($msg['msg'],1);
		    $msg['url'] = $cls_image->make_thumb($msg['msg'],$width=640,$height=0,$path='',$pic='');
			@unlink($msg['msg']);   // 删除原图，只保留缩略图 
		 }
      }
	  else
	  {
		 $msg['message'] = $msg['msg'];
	  }
   }
}
$msg =  $Json->encode($msg);
echo $msg;
exit;
?>