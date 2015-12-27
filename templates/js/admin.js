/**
 * Created by changsu on 2015/12/20.
 */
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