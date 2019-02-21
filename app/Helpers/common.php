<?php
// 打印测试数据
if (!function_exists('p')){
    function p()
    {
        $var_arr = func_get_args();
        echo '<pre>';
        foreach ( $var_arr as $key => $value ) {
            print_r($value);
        }
        echo '</pre>';
    }
}

/**
 * 太平洋网络IP地址
 * 返回值  成功：err为空
 */
if (!function_exists('get_Ip_Bypconline')){
    function get_Ip_Bypconline()
    {
        $whois_url = "http://whois.pconline.com.cn/ipJson.jsp?json=true";
        $ip_info = json_decode(iconv('GBK', 'UTF-8', file_get_contents($whois_url)), true);

        if (!empty($ip_info['err'])) {
            return false;
        }

        return $ip_info['ip']  ;
    }
}