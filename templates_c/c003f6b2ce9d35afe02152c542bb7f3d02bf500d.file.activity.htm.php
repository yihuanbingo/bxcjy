<?php /* Smarty version Smarty-3.1.7, created on 2015-12-19 16:20:03
         compiled from ".\templates\admin\activity.htm" */ ?>
<?php /*%%SmartyHeaderCode:3617566bf44be99049-63672627%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c003f6b2ce9d35afe02152c542bb7f3d02bf500d' => 
    array (
      0 => '.\\templates\\admin\\activity.htm',
      1 => 1450513193,
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
    'r' => 0,
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
            function deleteAccount(id) {
                if (confirm("确定要删除这个账号吗？")) {
                    $.post("/admin/account.php", {
                                act: 'delete_account', account_id: id
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
                <th width="240px">活动名称</th>
                <th width="100px">送礼方式</th>
                <th width="240px">送出金额类型</th>
                <th width="240px">送出金额</th>
                <th width="240px">活动url</th>
                <th width="120px">操作</th>
            </tr>
            <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value['res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value){
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
            <td><?php echo $_smarty_tpl->tpl_vars['l']->value['name'];?>
</td>
            <td><?php if ($_smarty_tpl->tpl_vars['l']->value['gift_type']==0){?>话费<?php }else{ ?>其他<?php }?></td>
            <td><?php if ($_smarty_tpl->tpl_vars['l']->value['money_type']==0){?>固定金额<?php }else{ ?>随机金额<?php }?></td>
            <?php if ($_smarty_tpl->tpl_vars['l']->value['money_type']==0){?>
            <td><?php echo $_smarty_tpl->tpl_vars['l']->value['money_num'];?>
</td>
            <?php }else{ ?>
            <td><?php echo $_smarty_tpl->tpl_vars['l']->value['money_min'];?>
-<?php echo $_smarty_tpl->tpl_vars['l']->value['money_max'];?>
</td>
            <?php }?>
            <td><?php echo $_smarty_tpl->tpl_vars['l']->value['activi_url'];?>
</td>
            <!--<td>-->
            <!--<a href="javascript:void(0)" onclick="javascript:deleteAccount(<?php echo $_smarty_tpl->tpl_vars['l']->value['account_id'];?>
);">-->
            <!--<img src="/templates/images/icon/icon_trash.gif" title="删除">-->
            <!--</a>-->
            <!--</td>-->
            <td align="center">
                <div id="edit_view_<?php echo $_smarty_tpl->tpl_vars['r']->value['info_id'];?>
">
                    <a href="/admin/info.php?key=operate&info_id=<?php echo $_smarty_tpl->tpl_vars['r']->value['info_id'];?>
">
                        <img src="/templates/images/icon/icon_edit.gif" title="编辑">
                    </a>&ensp;
                    <a href="javascript:void(0)" onclick="javascript:deleteInfo(<?php echo $_smarty_tpl->tpl_vars['r']->value['info_id'];?>
);">
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

            <p class="f_content"><input type="text" name="name" class="input">

            <p class="f_title">活动描述：

            <p class="f_content">
                <textarea type="text" name="descrpition" class="input"></textarea>

            <p class="f_title">送礼方式：

            <p class="f_content">
                <select name="type" id="gift_type">
                    <option value="1">话费</option>
                </select>
            <p class="f_title">送出金额类型：

            <p class="f_content">
                <select name="type" id="money_type">
                    <option value="1">固定金额</option>
                    <option value="2">随机金额</option>
                </select>
            <p class="f_title">送出金额数：

            <p class="f_content"><input type="text" name="money_num" class="input">

            <p class="f_title">图片地址：

            <p class="f_content"><input type="text" name="image_address" class="input">

                <input name="act" value="add_activity" style="display:none">
                <input name="key" value="do_add" style="display:none">

            <p class="f_title">
                <input type="button" class="btn_primary" value="确认" onclick="javascript:AjaxSubmit('add_activity');">
        </form>
        <?php }?><?php }} ?>