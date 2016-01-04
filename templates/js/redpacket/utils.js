var regexEnum =
{
    intege: "^-?[1-9]\\d*$",					//整数
    intege1: "^[1-9]\\d*$",					//正整数
    intege2: "^-[1-9]\\d*$",					//负整数
    num: "^([+-]?)\\d*\\.?\\d+$",			//数字
    num1: "^[1-9]\\d*|0$",					//正数（正整数 + 0）
    num2: "^-[1-9]\\d*|0$",					//负数（负整数 + 0）
    decmal: "^([+-]?)\\d*\\.\\d+$",			//浮点数
    decmal1: "^[1-9]\\d*.\\d*|0.\\d*[1-9]\\d*$",　　	//正浮点数
    decmal2: "^-([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*)$",　 //负浮点数
    decmal3: "^-?([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*|0?.0+|0)$",　 //浮点数
    decmal4: "^[1-9]\\d*.\\d*|0.\\d*[1-9]\\d*|0?.0+|0$",　　 //非负浮点数（正浮点数 + 0）
    decmal5: "^(-([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*))|0?.0+|0$",　　//非正浮点数（负浮点数 + 0）

    email: "^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+$", //邮件
    color: "^[a-fA-F0-9]{6}$",				//颜色
    url: "^http[s]?:\\/\\/([\\w-]+\\.)+[\\w-]+([\\w-./?%&=]*)?$",	//url
    chinese: "^[\\u4E00-\\u9FA5\\uF900-\\uFA2D]+$",					//仅中文
    ascii: "^[\\x00-\\xFF]+$",				//仅ACSII字符
    zipcode: "^\\d{6}$",						//邮编
    mobile: "^[0-9]{11}$",				//手机
    ip4: "^(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)$",	//ip地址
    notempty: "^\\S+$",						//非空
    picture: "(.*)\\.(jpg|bmp|gif|ico|pcx|jpeg|tif|png|raw|tga)$",	//图片
    rar: "(.*)\\.(rar|zip|7zip|tgz)$",								//压缩文件
    date: "^\\d{4}(\\-|\\/|\.)\\d{1,2}\\1\\d{1,2}$",					//日期
    qq: "^[1-9]*[1-9][0-9]*$",				//QQ号码
    tel: "^(([0\\+]\\d{2,3}-)?(0\\d{2,3})-)?(\\d{7,8})(-(\\d{3,}))?$",	//电话号码的函数(包括验证国内区号,国际区号,分机号)
    username: "^\\w+$",						//用来用户注册。匹配由数字、26个英文字母或者下划线组成的字符串
    letter: "^[A-Za-z]+$",					//字母
    letter_u: "^[A-Z]+$",					//大写字母
    letter_l: "^[a-z]+$",					//小写字母
    idcard: "^[1-9]([0-9]{14}|[0-9]{17})$"	//身份证
}
var aCity = {
    11: "北京",
    12: "天津",
    13: "河北",
    14: "山西",
    15: "内蒙古",
    21: "辽宁",
    22: "吉林",
    23: "黑龙江",
    31: "上海",
    32: "江苏",
    33: "浙江",
    34: "安徽",
    35: "福建",
    36: "江西",
    37: "山东",
    41: "河南",
    42: "湖北",
    43: "湖南",
    44: "广东",
    45: "广西",
    46: "海南",
    50: "重庆",
    51: "四川",
    52: "贵州",
    53: "云南",
    54: "西藏",
    61: "陕西",
    62: "甘肃",
    63: "青海",
    64: "宁夏",
    65: "新疆",
    71: "台湾",
    81: "香港",
    82: "澳门",
    91: "国外"
}

var Utils = new Object();
Utils.htmlEncode = function (text) {
    return text.replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
}

Utils.trim = function (text) {
    if (typeof(text) == "string") {
        return text.replace(/^\s*|\s*$/g, "");
    }
    else {
        return text;
    }
}

Utils.isEmpty = function (val) {
    switch (typeof(val)) {
        case 'string':
            return Utils.trim(val).length == 0 ? true : false;
            break;
        case 'number':
            return val == 0;
            break;
        case 'object':
            return val == null;
            break;
        case 'array':
            return val.length == 0;
            break;
        default:
            return true;
    }
}

Utils.isNumber = function (val) {
    var reg = /^[\d|\.|,]+$/;
    return reg.test(val);
}

Utils.isInt = function (val) {
    if (val == "") {
        return false;
    }
    var reg = /\D+/;
    return !reg.test(val);
}

Utils.isDate = function (val) {
    if (val == "") {
        return false;
    }
    var r = eval("regexEnum.date");
    return (new RegExp(r, 'i')).test(val);
}

Utils.isEmail = function (email) {
    var reg1 = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)/;

    return reg1.test(email);
}

Utils.isTel = function (tel) {
    var reg = /^[\d|\-|\s|\_]+$/; //只允许使用数字-空格等

    return reg.test(tel);
}
Utils.isMobile = function (mobile) {
    //var reg = /^[1][3-8][0-9]{9}$/; //只允许使用数字-空格等
    var reg = /^[1][0-9]{10}$/; //只允许使用数字-空格等

    return reg.test(mobile);
}
Utils.isUrl = function (url) {
    //var reg = /^[1][3-8][0-9]{9}$/; //只允许使用数字-空格等
    var reg = /^http[s]?:\/\/([\w-]+\.)+[\w-]+([\w-./?%&=]*)?$/; //只允许使用数字-空格等

    return reg.test(url);
}


Utils.fixEvent = function (e) {
    var evt = (typeof e == "undefined") ? window.event : e;
    return evt;
}

Utils.srcElement = function (e) {
    if (typeof e == "undefined") e = window.event;
    var src = document.all ? e.srcElement : e.target;

    return src;
}

Utils.isTime = function (val) {
    var reg = /^\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}$/;

    return reg.test(val);
}

Utils.x = function (e) { //当前鼠标X坐标
    return Browser.isIE ? event.x + document.documentElement.scrollLeft - 2 : e.pageX;
}

Utils.y = function (e) { //当前鼠标Y坐标
    return Browser.isIE ? event.y + document.documentElement.scrollTop - 2 : e.pageY;
}

Utils.request = function (url, item) {
    var sValue = url.match(new RegExp("[\?\&]" + item + "=([^\&]*)(\&?)", "i"));
    return sValue ? sValue[1] : sValue;
}

//----------------------------------------------
Utils.isChinese = function (val) {
    //return regexEnum.chinese.test(val);
    return val.match(regexEnum.chinese) == null ? false : true;
}

Utils.isCard = function (sId) {
    var iSum = 0;
    var info = "";
    if (!/^\d{17}(\d|x)$/i.test(sId)) return false;
    sId = sId.replace(/x$/i, "a");
    if (aCity[parseInt(sId.substr(0, 2))] == null) return fasle;
    sBirthday = sId.substr(6, 4) + "-" + Number(sId.substr(10, 2)) + "-" + Number(sId.substr(12, 2));
    var d = new Date(sBirthday.replace(/-/g, "/"));
    if (sBirthday != (d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate()))return false;
    for (var i = 17; i >= 0; i--) iSum += (Math.pow(2, i) % 11) * parseInt(sId.charAt(17 - i), 11);
    if (iSum % 11 != 1) return false;
    return true;
}

//是否为有效证件
Utils.isCertificateNo = function (type, val) {
    if (type == 1) { //省份证
        return Utils.isCard(val);
    }
    return true;
}

//----------------------------------------------

Utils.$ = function (name) {
    return document.getElementById(name);
}