<?php
//use WeiBo/saetv2.ex.class.php;
//require_once 'config/consta';
require_once __DIR__ . '/../app/Libraries/WeiBo/saetv2.ex.class.php';

define('WEIBO_KEY','2700687630');
define('WEIBO_SECRET','86ae955d5b607a58acdb079d79200836');
define('WEIBO_REDIRECT_URI','http://test.open.lixiaowang.top/callback.php');

$code = $_GET['code'];
//var_dump($code);die;

$keys['code'] = $code;
$keys['redirect_uri'] = WEIBO_REDIRECT_URI;
$obj = new \SaeTOAuthV2(WEIBO_KEY, WEIBO_SECRET);

$auth=$obj->getAccessToken($keys);

//var_dump($auth);die;

setcookie('accesstoken',$auth['access_token'],time()+$auth['expires_in']);
header('location:/posts');
//return redirect('/posts');

