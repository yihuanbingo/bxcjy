/**
 * Created by changsu on 2015/12/20.
 */
function addActivity() {
    var moneytype = $("#money_type option:selected").val();
    var gifttype = $("#gift_type option:selected").val();
    if (gifttype == "0" && moneytype == "1") {
        var huafei0 = Number($("#huafei0").val());
        var huafei1 = Number($("#huafei1").val());
        var huafei2 = Number($("#huafei2").val());
        var huafei5 = Number($("#huafei5").val());
        var huafei10 = Number($("#huafei10").val());
        var huafei20 = Number($("#huafei20").val());
        if (huafei0 >= 0 && huafei1 >= 0 && huafei2 >= 0 && huafei5 >= 0 && huafei10 >= 0 && huafei20 >= 0) {
            if ((huafei0 + huafei1 + huafei2 + huafei5 + huafei10 + huafei20) != 100) {
                alertMsg("所有随机规则值的总和要等于100");
                return false;
            }
        }
        else {
            alertMsg("随机规则要大于零");
            return false;
        }
    }

    if (gifttype == "0" && moneytype == "0") {
        var moneynum = $("#money_num").val();
        if (moneynum == "") {
            alertMsg("金额不能为空");
            return false;
        }
    }

    $("#add_activity").ajaxSubmit({
        success: function (data) {
            $("#loading").css("display", "none");
            var data = json_decode(data);
            if (data.error == 1) {
                //$("#ajaxMsg").html(data.data);
                //$("#ajaxMsg").show();
                alertMsg(data.data);
            }
            if (data.error == 0) {
                if (location == true)  // 不输出信息，直接跳转
                {
                    window.location.href = data.href;
                }
                else {
                    if (data.href)  // 输出信息，跳转其他页
                    {
                        //$("#alt_msg_btm").html('2秒后页面自动跳转');
                        alertMsg(data.data);
                        setTimeout(function () {
                            window.location.href = data.href
                        }, 2000);
                    }
                    else  // 输出信息，本页刷新
                    {
                        //$("#alt_msg_btm").html('2秒后页面自动刷新');
                        alertMsg(data.data);
                        setTimeout("window.location.reload();", 2000);
                    }
                }
            }
        }
    });
}

function editActivity() {
    var moneytype = $("#money_type option:selected").val();
    var gifttype = $("#gift_type option:selected").val();
    if (gifttype == "0" && moneytype == "1") {
        var huafei0 = Number($("#huafei0").val());
        var huafei1 = Number($("#huafei1").val());
        var huafei2 = Number($("#huafei2").val());
        var huafei5 = Number($("#huafei5").val());
        var huafei10 = Number($("#huafei10").val());
        var huafei20 = Number($("#huafei20").val());
        if (huafei0 >= 0 && huafei1 >= 0 && huafei2 >= 0 && huafei5 >= 0 && huafei10 >= 0 && huafei20 >= 0) {
            if ((huafei0 + huafei1 + huafei2 + huafei5 + huafei10 + huafei20) != 100) {
                alertMsg("所有随机规则值的总和要等于100");
                return false;
            }
        }
        else {
            alertMsg("随机规则要大于零");
            return false;
        }
    }

    if (gifttype == "0" && moneytype == "0") {
        var moneynum = $("#money_num").val();
        if (moneynum == "") {
            alertMsg("金额不能为空");
            return false;
        }
    }

    $("#edit_activity").ajaxSubmit({
        success: function (data) {
            $("#loading").css("display", "none");
            var data = json_decode(data);
            if (data.error == 1) {
                //$("#ajaxMsg").html(data.data);
                //$("#ajaxMsg").show();
                alertMsg(data.data);
            }
            if (data.error == 0) {
                if (location == true)  // 不输出信息，直接跳转
                {
                    window.location.href = data.href;
                }
                else {
                    if (data.href)  // 输出信息，跳转其他页
                    {
                        //$("#alt_msg_btm").html('2秒后页面自动跳转');
                        alertMsg(data.data);
                        setTimeout(function () {
                            window.location.href = data.href
                        }, 2000);
                    }
                    else  // 输出信息，本页刷新
                    {
                        //$("#alt_msg_btm").html('2秒后页面自动刷新');
                        alertMsg(data.data);
                        setTimeout("window.location.reload();", 2000);
                    }
                }
            }
        }
    });
}

/* 生成验证码 */
function productValifyCode() {
    $("#loading").css("display", "block");
    $("#product").attr("disabled", "true");
    $("#product_valifycode").ajaxSubmit({
        success: function (data) {
            $("#loading").css("display", "none");
            var data = json_decode(data);
            if (data.error == 1) {
                //$("#ajaxMsg").html(data.data);
                //$("#ajaxMsg").show();
                alertMsg(data.data);
            }
            if (data.error == 0) {
                if (location == true)  // 不输出信息，直接跳转
                {
                    window.location.href = data.href;
                }
                else {
                    if (data.href)  // 输出信息，跳转其他页
                    {
                        //$("#alt_msg_btm").html('2秒后页面自动跳转');
                        alertMsg(data.data);
                        setTimeout(function () {
                            window.location.href = data.href
                        }, 2000);
                    }
                    else  // 输出信息，本页刷新
                    {
                        //$("#alt_msg_btm").html('2秒后页面自动刷新');
                        alertMsg(data.data);
                        setTimeout("window.location.reload();", 2000);
                    }
                }
            }
        }
    });
}

function exportValifyCode() {
    var activity = $("#activity").val();
    var valifycode = $("#valifycode").val();
    var use_account = $("#use_account").val();
    window.location.href = "/admin/valifycode.php?act=export&activity=" + activity + "&valifycode=" + valifycode
        + "&use_account=" + use_account;
}

function exportRechargeRecord() {
    var activity = $("#activity").val();
    var valifycode = $("#valifycode").val();
    var tradeaccount = $("#tradeaccount").val();
    var status = $("#status").val();
    window.location.href = "/admin/rechargerecord.php?act=export&activity=" + activity + "&valifycode=" + valifycode
        + "&tradeaccount=" + tradeaccount + "&status=" + status;
}


function selectMoneyType() {
    var moneytype = $("#money_type option:selected").val();
    var gifttype = $("#gift_type option:selected").val();
    if (moneytype == "0") {
        //固定金额
        $("#gudingdiv").css("display", "block");
        $("#suijidiv" + gifttype).css("display", "none");
    }
    else {
        //随机金额
        $("#gudingdiv").css("display", "none");
        $("#suijidiv" + gifttype).css("display", "block");
    }
}