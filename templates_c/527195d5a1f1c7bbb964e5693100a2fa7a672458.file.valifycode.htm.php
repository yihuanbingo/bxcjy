<?php /* Smarty version Smarty-3.1.7, created on 2015-12-19 17:45:00
         compiled from ".\templates\admin\valifycode.htm" */ ?>
<?php /*%%SmartyHeaderCode:225045673e28d771603-33744754%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '527195d5a1f1c7bbb964e5693100a2fa7a672458' => 
    array (
      0 => '.\\templates\\admin\\valifycode.htm',
      1 => 1450518297,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '225045673e28d771603-33744754',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5673e28d98c70',
  'variables' => 
  array (
    'act' => 0,
    'activitylist' => 0,
    'l' => 0,
    'activity' => 0,
    'valifycode' => 0,
    'list' => 0,
    'r' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5673e28d98c70')) {function content_5673e28d98c70($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('admin/library/page_header.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div class="col_main">
    <div class="main_hd">
        <div class="title_tab">
            <ul class="tab_navs">
                <li <?php if ($_smarty_tpl->tpl_vars['act']->value=='default'||'new_account'){?>class="selected"<?php }?>><a href="/admin/activity.php">验证码列表</a></li>
            </ul>
        </div>
    </div>

    <div class="main_content">

        <?php if ($_smarty_tpl->tpl_vars['act']->value=='default'){?>
        <form action="/admin/valifycode.php" method="get" enctype="multipart/form-data" name="search">

            <input type="hidden" name="page" value="1">
            <p class="f_content">
            <table>
            <td align="right">活动：</td>
            <td style="padding-right: 20px">
                <select name="activity">
                    <option value="0">全部</option>
                    <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['activitylist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value){
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
                    <?php if ($_smarty_tpl->tpl_vars['l']->value['key_id']==$_smarty_tpl->tpl_vars['activity']->value){?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['l']->value['key_id'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['l']->value['name'];?>
</option>
                    <?php }else{ ?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['l']->value['key_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['l']->value['name'];?>
</option>
                    <?php }?>
                    <?php } ?>
                </select>
            </td>
            <td align="right">验证码：</td>
            <td style="padding-right: 20px"><input type="text" class="searchinput" name="valifycode" value="<?php echo $_smarty_tpl->tpl_vars['valifycode']->value;?>
"></td>
            <td><input type="submit" class="btn_primary" value="查询"></td>
            </table>
            </p>
        </form>
        <div class="clear height20"></div>
        <table class="info_list" cellspacing="1" width="100%">
            <tr>
                <th width="240px">活动ID</th>
                <th width="100px">验证码</th>
                <th width="240px">金额</th>
                <th width="240px">是否使用</th>
                <th width="240px">使用账号</th>
                <th width="120px">操作</th>
            </tr>
            <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value['res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value){
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
            <td><?php echo $_smarty_tpl->tpl_vars['l']->value['activity_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['l']->value['valifycode'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['l']->value['money_num'];?>
</td>
            <td><?php if ($_smarty_tpl->tpl_vars['l']->value['is_used']==0){?>已使用<?php }else{ ?>未使用<?php }?></td>
            <td><?php echo $_smarty_tpl->tpl_vars['l']->value['use_account'];?>
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