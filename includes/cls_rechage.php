<?php

class Recharge
{
    private $appkey;

    private $recharge_check_url = "http://p.apix.cn/apixlife/pay/phone/recharge_check";

    private $recharge_query_url = 'http://p.apix.cn/apixlife/pay/phone/recharge_query';

    private $phone_recharge_url = "http://p.apix.cn/apixlife/pay/phone/phone_recharge";

    private $order_state_url = "http://p.apix.cn/apixlife/pay/phone/order_state";

    private $user_balance_url = "http://p.apix.cn/apixlife/pay/phone/user_balance";

    private $order_list_url = "http://p.apix.cn/apixlife/pay/phone/order_list";

    public function __construct($appkey)
    {
        $this->appkey = $appkey;
    }

    /**
     * 根据手机号码及面额查询是否支持充值
     * @param  string $mobile [手机号码]
     * @param  int $pervalue [充值金额]
     * @return  boolean
     */
    public function recharge_check($phone, $price)
    {
        $url = $this->recharge_check_url;
        $url .= "?phone=" . $phone . "&price=" . $price;
        $response = $this->commoncurl($url);
        return $this->_returnArray($response);
    }

    /**
     * 根据手机号码和面额获取商品信息
     * @param  string $mobile [手机号码]
     * @param  int $pervalue [充值金额]
     * @return  array
     */
    public function recharge_query($phone, $price)
    {
        $url = $this->recharge_query_url;
        $url .= "?phone=" . $phone . "&price=" . $price;
        $response = $this->commoncurl($url);
        return $this->_returnArray($response);
    }

    /**
     * 提交话费充值
     * @param  [string] $mobile   [手机号码]
     * @param  [int] $pervalue [充值面额]
     * @param  [string] $orderid  [自定义单号]
     * @return  [array]
     */
    public function phone_recharge($phone, $price, $orderid)
    {
        $price = intval($price);
        $sign = md5($phone . $price . $orderid);//校验值计算
        $url = $this->phone_recharge_url;
        $url .= "?phone=" . $phone . "&price=" . $price . "&orderid=$orderid" . "&sign=$sign";
        $response = $this->commoncurl($url);
        return $this->_returnArray($response);
    }

    /**
     * 查询订单的充值状态
     * @param  [string] $orderid [自定义单号]
     * @return  [array]
     */
    public function order_state($orderid)
    {
        $url = $this->phone_recharge_url;
        $url .= "orderid=$orderid";
        $response = $this->commoncurl($url);
        return $this->_returnArray($response);
    }

    public function user_balance()
    {
        $url = $this->user_balance_url;
        $response = $this->commoncurl($url);
        return $this->_returnArray($response);
    }

    /**
     * 将JSON内容转为数据，并返回
     * @param string $content [内容]
     * @return array
     */
    public function _returnArray($content)
    {
        return json_decode($content, true);
    }

    /**
     * 请求接口返回内容
     * @param  string $url [请求的URL地址]
     * @param  string $params [请求的参数]
     * @param  int $ipost [是否采用POST形式]
     * @return  string
     */
    public function commoncurl($url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "apix-key: $this->appkey",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false;
        } else {
            return $response;
        }
    }
}

?>