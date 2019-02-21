<?php

namespace App\Libraries\MiaoDi;
class HttpUtil
{
    //require_once("config.php");

    protected $BASE_URL;
    protected $ACCOUNT_SID;
    protected $AUTH_TOKEN;
    protected $CONTENT_TYPE ;
    protected $ACCEPT;
    protected $timestamp;

    function __construct()
    {
        $this->BASE_URL = env('MIAODI_BASE_URL');
        $this->ACCOUNT_SID = env('MIAODI_ACCOUNT_SID');
        $this->AUTH_TOKEN = env('MIAODI_AUTH_TOKEN');
        $this->CONTENT_TYPE = env('MIAODI_CONTENT_TYPE');
        $this->ACCEPT = env('MIAODI_ACCEPT');
        $this->timestamp = date("YmdHis");
    }

    /**
     * 创建url
     *
     * @param funAndOperate
     *            请求的功能和操作
     * @return
     */
    function createUrl($funAndOperate)
    {
        // 时间戳
        date_default_timezone_set("Asia/Shanghai");

        return $this->BASE_URL . $funAndOperate;
    }

    function createSig()
    {

        // 签名
        $sig = md5($this->ACCOUNT_SID . $this->AUTH_TOKEN . $this->timestamp );
        return $sig;
    }

    public function createBasicAuthData()
    {
        // 签名
        $sig = md5($this->ACCOUNT_SID . $this->AUTH_TOKEN . $this->timestamp );
        return array("accountSid" => $this->ACCOUNT_SID, "timestamp" => $this->timestamp , "sig" => $sig, "respDataType" => "JSON");
    }

    /**
     * 创建请求头
     * @param body
     * @return
     */
    function createHeaders()
    {
        $headers = array('Content-type: ' . $this->CONTENT_TYPE, 'Accept: ' . $this->ACCEPT);

        return $headers;
    }

    /**
     * post请求
     *
     * @param funAndOperate
     *            功能和操作
     * @param body
     *            要post的数据
     * @return
     * @throws IOException
     */
    public function post($funAndOperate, $body)
    {
//        global $CONTENT_TYPE, $ACCEPT;

        // 构造请求数据
        $url = $this->createUrl($funAndOperate);
        $headers = $this->createHeaders();

        /*echo("url:<br/>" . $url . "\n");
        echo("<br/><br/>body:<br/>" . json_encode($body));
        echo("<br/><br/>headers:<br/>");
        var_dump($headers);*/

        // 要求post请求的消息体为&拼接的字符串，所以做下面转换
        $fields_string = "";
        foreach ($body as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');

        // 提交请求
        $con = curl_init();
        curl_setopt($con, CURLOPT_URL, $url);
        curl_setopt($con, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($con, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($con, CURLOPT_HEADER, 0);
        curl_setopt($con, CURLOPT_POST, 1);
        curl_setopt($con, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($con, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($con, CURLOPT_POSTFIELDS, $fields_string);
        $result = curl_exec($con);
        curl_close($con);

        return "" . $result;
    }

}


