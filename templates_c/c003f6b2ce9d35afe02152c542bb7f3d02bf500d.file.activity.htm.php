<?php /* Smarty version Smarty-3.1.7, created on 2016-01-08 00:10:11
         compiled from ".\templates\admin\activity.htm" */ ?>
<?php /*%%SmartyHeaderCode:3617566bf44be99049-63672627%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c003f6b2ce9d35afe02152c542bb7f3d02bf500d' => 
    array (
      0 => '.\\templates\\admin\\activity.htm',
      1 => 1452183007,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3617566bf44be99049-63672627',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_566bf44c47f28',
  'variables' => 
  array (
    'act' => 0,
    'list' => 0,
    'l' => 0,
    'activity' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_566bf44c47f28')) {function content_566bf44c47f28($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('admin/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div class="col_main">
    <div class="main_hd">
        <div class="title_tab">
            <ul class="tab_navs">
                <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='default'||'new_account'){?>class="selected"<?php }?>><a href="/admin/activity.php">活动列表</a></li>
            </ul>
        </div>
    </div>

    <div class="main_content">

        <?php if ($_smarty_tpl->tpl_vars['act']->value=='default'){?>
        <script type="text/javascript">
            function deleteActivity(id) {
                if (confirm("确定要删除这个活动吗？")) {
                    $.post("/admin/activity.php", {
                                act: 'delete_activity', activity_id: id
                            },
                            function (data) {

                                var data = json_decode(data);
                                if (data.error == 0) {
                                    alertMsg(data.data);
                                    setTimeout("window.location.reload();", 1000);
                                }
                                if (data.error == 1) {
                                    /* 弹出错误提示 */
                                    alertMsg(data.data);
                                }
                            });
                }
            }
        </script>
        <form action="/admin/activity.php" method="get" enctype="multipart/form-data" name="search">
            <input type="hidden" name="page" value="1">
        </form>
        <table class="info_list" cellspacing="1" width="100%">
            <tr>
                <th width="15%">活动ID</th>
                <th width="15%">活动名称</th>
                <th width="15%">描述</th>
                <th width="5%">送礼方式</th>
                <th width="5%">送出金额类型</th>
                <th width="15%">金额规则</th>
                <th width="20%">活动url</th>
                <th width="10">操作</th>
            </tr>
            <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value['res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value){
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
            <td><?php echo $_smarty_tpl->tpl_vars['l']->value['key_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['l']->value['name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['l']->value['descrpition'];?>
</td>
            <td><?php if ($_smarty_tpl->tpl_vars['l']->value['gift_type']==0){?>话费<?php }else{ ?>其他<?php }?></td>
            <td><?php if ($_smarty_tpl->tpl_vars['l']->value['money_type']==0){?>固定金额<?php }else{ ?>随机金额<?php }?></td>
            <td><?php echo $_smarty_tpl->tpl_vars['l']->value['money_rule'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['l']->value['activi_url'];?>
</td>
            <!--<td>-->
            <!--<a href="javascript:void(0)" onclick="javascript:deleteAccount(<?php echo $_smarty_tpl->tpl_vars['l']->value['account_id'];?>
);">-->
            <!--<img src="/templates/images/icon/icon_trash.gif" title="删除">-->
            <!--</a>-->
            <!--</td>-->
            <td align="center">
                <div>
                    <a href="/admin/activity.php?act=edit_activity&activity_id=<?php echo $_smarty_tpl->tpl_vars['l']->value['key_id'];?>
">
                        <img src="/templates/images/icon/icon_edit.gif" title="编辑">
                    </a>&ensp;
                    <a href="javascript:void(0)" onclick="javascript:deleteActivity('<?php echo $_smarty_tpl->tpl_vars['l']->value['key_id'];?>
');">
                        <img src="/templates/images/icon/icon_trash.gif" title="删除">
                    </a>
                </div>
            </td>
            </tr>
            <?php } ?>
        </table>
        <div class="clear height10"></div>
        <div class="float_r">
            <?php echo $_smarty_tpl->getSubTemplate ("admin/library/page.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </div>
        <a href="/admin/activity.php?act=add_activity"><input type="button" class="btn_primary" value="新建活动"></a>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['act']->value=='add_activity'){?>
        <form action="/admin/activity.php" method="post" enctype="multipart/form-data" id="add_activity" class="form">
            <p class="f_title">活动名称：<span class="color999 fontSize12">（活动名不多于30个字符）</span>

            <p class="f_content"><input type="text" id="name" name="name" class="input">

            <p class="f_title">活动描述：

            <p class="f_content">
                <textarea type="text" id="descrpition" name="descrpition" class="input"></textarea>

            <p class="f_title">送礼方式：

            <p class="f_content">
                <select name="gift_type" id="gift_type" onchange="selectGiftType()">
                    <option value="0">话费</option>
                </select>
            <p class="f_title">送出金额类型：

            <p class="f_content">
                <select name="money_type" id="money_type" onchange="selectMoneyType()">
                    <option value="0">固定金额</option>
                    <option value="1">随机金额</option>
                </select>
            <div id="gudingdiv" style="display: block">
            <p class="f_title">送出金额数：
            <p class="f_content"><input type="text" name="money_num" id="money_num" class="input">
            </div>
            <div id="suijidiv0" style="display: none">
            <p class="f_title">随机规则：
            <p class="f_content">
                &nbsp;&nbsp;0：<input type="text" class="smallinput" id="huafei0" name="huafei0">%
                &nbsp;&nbsp;1：<input type="text" class="smallinput" id="huafei1" name="huafei1">%
                &nbsp;&nbsp;2：<input type="text" class="smallinput" id="huafei2" name="huafei2">%
                &nbsp;&nbsp;5：<input type="text" class="smallinput" id="huafei5" name="huafei5">%
                10：<input type="text" class="smallinput" id="huafei10" name="huafei10">%
                <br>
                20：<input type="text" class="smallinput" id="huafei20" name="huafei20">%
            </div>
            <p class="f_title">图片地址：
            <p class="f_content"><input type="text" id="image_address" name="image_address" class="input">

                <input name="act" value="add_activity" style="display:none">
                <input name="key" value="do_add" style="display:none">
        </form>
        <p class="f_title">上传活动图片：
        <p class="f_content">
        <form id="uploadimg" action="/uploadimg.php?act=redpacket" method="post">
            <input name="imgFile" tabindex="-1" type="file"><input type="button" name="upload" id="upload" value="上传"
                                                                   onclick="uploadImage()">
        </form>
        <br>
        <p class="f_content"><img class="thumb" id="img" src="<?php echo $_smarty_tpl->tpl_vars['activity']->value['image_address'];?>
">
            <br><br>
        <p class="f_title">
            <input type="button" class="btn_primary" value="确认" onclick="addActivity();">
        <?php }?>

<?php }} ?>