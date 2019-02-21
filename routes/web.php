<?php

/*Route::get('/', function () {
    return view('welcome',['website'=>'<strong>Laravel</strong>']);
});*/


//用户模块

//登录页面
Route::get('/', "\App\Http\Controllers\LoginController@index")->name('/');

Route::get('/login', "\App\Http\Controllers\LoginController@index")->name('login');
//登录行为
Route::post('/login', '\App\Http\Controllers\LoginController@login');
//登出行为
Route::get('/logout', '\App\Http\Controllers\LoginController@logout');
//注册页面
Route::get('/registers', '\App\Http\Controllers\RegisterController@index')->name('register');
//注册行为
Route::post('/register', '\App\Http\Controllers\RegisterController@register');

// 引导用户到新浪微博的登录授权页面
Route::get('auth/weibo', '\App\Http\Controllers\Auth\AuthController@weibo');
// 用户授权后新浪微博回调的页面
Route::get('auth/callback/', '\App\Http\Controllers\Auth\AuthController@callback');
// 微博取消授权登录
//Route::get('auth/wbCancle/', '\App\Http\Controllers\Auth\AuthController@wbCancle');

//qq登录授权页面
Route::get('auth/qq', 'Auth\AuthController@qqlogin');
//qq授权后回调的页面
Route::get('auth/qqcallback/', 'Auth\AuthController@qqcallback');
//手机快速登录页面
Route::get('/phone', "\App\Http\Controllers\LoginController@phone");
//发送短信
Route::post('/sendsms', "\App\Http\Controllers\LoginController@sendSms");
//手机登录处理
Route::post('/phone/login', "\App\Http\Controllers\LoginController@phoneLogin");



//忘记密码，重置密码
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
//绑定用户

Route::group(['middleware' => 'auth:web'], function () {
//个人设置页面
    Route::get('/user/{user}/setting', '\App\Http\Controllers\UserController@setting');
//个人设置行为
    Route::post('/user/{user}/setting', '\App\Http\Controllers\UserController@settingStore');
//修改密码
    Route::get('/user/{user}/updatePassword', '\App\Http\Controllers\UserController@updatePassword');
    Route::post('/user/{user}/updatePassword', '\App\Http\Controllers\UserController@storePassword');

//专题详情页面
    Route::get('/topic/{topic}', '\App\Http\Controllers\TopicController@show');
//投稿
    Route::get('/topic/{topic}/submit', '\App\Http\Controllers\TopicController@submit');
//通知页面
    Route::get('/notices','\App\Http\Controllers\NoticeController@index');

//文章模块
//文章列表
    Route::get('posts', '\App\Http\Controllers\PostController@index');

//创建文章
    Route::get('posts/create', '\App\Http\Controllers\PostController@create');
    Route::post('posts/', '\App\Http\Controllers\PostController@store');

//搜索
    Route::get('posts/search', '\App\Http\Controllers\PostController@search');

//文章详情
    Route::get('posts/{post}', '\App\Http\Controllers\PostController@show');

//修改
    Route::get('posts/{post}/edit', '\App\Http\Controllers\PostController@edit');
    Route::put('posts/{post}', '\App\Http\Controllers\PostController@update');
//删除(绑定模型)
    Route::get('posts/{post}/delete', '\App\Http\Controllers\PostController@delete');

//上传图片
    Route::post('posts/image/upload', '\App\Http\Controllers\PostController@imageUpload');


//提交评论
    Route::post('posts/{post}/comment', '\App\Http\Controllers\PostController@comment');
//赞
    Route::get('posts/{post}/zan', '\App\Http\Controllers\PostController@zan');
//取消赞
    Route::get('posts/{post}/unzan', '\App\Http\Controllers\PostController@unzan');


//个人中心
    Route::get('/user/{user}', '\App\Http\Controllers\UserController@show');
//关注
    Route::post('/user/{user}/fan', '\App\Http\Controllers\UserController@fan');
//取消关注
    Route::post('/user/{user}/unfan', '\App\Http\Controllers\UserController@unfan');
});


//后台路由
include_once('admin.php');

#后台路由 上下两种方法都可
/*Route::group(['prefix'=>'admin'],function (){
   Route::get('/login', function (){
       return 'this is log33333in';
   });
});*/


//Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');


