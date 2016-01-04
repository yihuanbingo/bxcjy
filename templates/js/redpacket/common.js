/**
 * 提示
 */
common = {
    alert: function (msg, duration) {
        if ($('.alert').size() > 0) {
            return false;
        }
        duration = isNaN(duration) ? 3000 : duration;
        var m = document.createElement('div');
        m.setAttribute('class', 'alert');
        m.innerHTML = msg;
        m.style.cssText = "width:60%; min-width:150px; background:#000; opacity:0.7; height:40px; color:#fff; line-height:40px; text-align:center; border-radius:5px; position:fixed; top:40%; left:20%; z-index:999999; font-weight:bold;";
        document.body.appendChild(m);
        setTimeout(function () {
            var d = 0.5;
            m.style.webkitTransition = '-webkit-transform ' + d + 's ease-in, opacity ' + d + 's ease-in';
            m.style.opacity = '0';
            setTimeout(function () {
                document.body.removeChild(m)
            }, d * 1000);
        }, duration);
    },
    hint: function (msg) {
        var htm = '<div id="fint-fix" style="position:fixed;top:0;z-index:999; width:100%;max-width:768px;height:100%;background:rgba(0,0,0,0.3);opacity:0;"> <div class="f-wrap" style="position:absolute;top:50%;left:50%;min-width:15rem;height:4rem;line-height:4rem;background:rgba(0,0,0,0.8);color:#fff;text-align:center;border-radius:6px;-webkit-transform:translate3d(-50%,-50%,0);-moz-transform:translate3d(-50%,-50%,0);transform:translate3d(-50%,-50%,0);">';
        var htm = htm + '<p>' + msg + '</p>';
        var htm = htm + '</div></div>';
        $('body').prepend(htm);
        $('#fint-fix').addClass('fadeIn');
        setTimeout(function () {
            $('#fint-fix').css('display', 'none').removeClass('fadeIn').remove();
        }, 2000)
    }
}