<?php

/**
 * url前半部分
 */
//$BASE_URL = "https://api.miaodiyun.com/20150822/";
$BASE_URL=env('MIAODI_BASE_URL');
/**
 * url中的accountSid。如果接口验证级别是主账户则传网站“个人中心”页面的“账户ID”，
 */
//$ACCOUNT_SID = "166033153bff4cc18ae4b74a8c9ee699"; // 主账户
//$AUTH_TOKEN = "6cc395146a994f1da18209e43dcbfe75";
$ACCOUNT_SID=env('MIAODI_ACCOUNT_SID');
$AUTH_TOKEN=env('MIAODI_AUTH_TOKEN');
/**
 * 请求的内容类型，application/x-www-form-urlencoded
 */
//$CONTENT_TYPE = "application/x-www-form-urlencoded";
$CONTENT_TYPE=env('MIAODI_CONTENT_TYPE');

/**
 * 期望服务器响应的内容类型，可以是application/json或application/xml
 */
/*$ACCEPT = "application/json";*/
$ACCEPT=env('MIAODI_ACCEPT');




