<?php


Route::prefix('admin')->group(function () {

    //登录页面
    Route::get('/', '\App\Admin\Controllers\LoginController@index');
    Route::get('/login', '\App\Admin\Controllers\LoginController@index')->name('login');
    //登录逻辑
    Route::post('/login', '\App\Admin\Controllers\LoginController@login');
    //登出
    Route::get('/logout', '\App\Admin\Controllers\LoginController@logout');

    // 需要登陆的
    Route::group(['middleware' => 'auth:admin'], function () {
        //首页
        Route::get('/index', '\App\Admin\Controllers\HomeController@index');

        Route::group(['middleware' => 'can:category'], function () {
            //栏目模块
            Route::get('/categorys', '\App\Admin\Controllers\CategoryController@index');
            Route::get('/categorys/add', '\App\Admin\Controllers\CategoryController@add');
            Route::post('/categorys/store', '\App\Admin\Controllers\CategoryController@store');
            Route::get('/categorys/{category}/edit', '\App\Admin\Controllers\CategoryController@edit');
            Route::post('/categorys/{category}/editStore', '\App\Admin\Controllers\CategoryController@editStore');
            Route::post('/categorys/{category}/status', '\App\Admin\Controllers\CategoryController@status');
        });

        Route::group(['middleware' => 'can:system'], function () {
            //管理人员模块
            Route::get('/users', '\App\Admin\Controllers\UserController@index');
            Route::get('/users/create', '\App\Admin\Controllers\UserController@create');
            Route::post('/users/store', '\App\Admin\Controllers\UserController@store');
            Route::get('/users/{user}/edit', '\App\Admin\Controllers\UserController@edit');
            Route::post('/users/{user}/edit', '\App\Admin\Controllers\UserController@storeEdit');
            Route::get('/users/{user}/resetPassword', '\App\Admin\Controllers\UserController@resetPassword');
//            Route::post('/users/{user}/resetPassword', '\App\Admin\Controllers\UserController@storePassword');
            Route::post('/users/{user}/status', '\App\Admin\Controllers\UserController@status');
            Route::get('/users/{user}/delete', '\App\Admin\Controllers\UserController@destroy');
            Route::get('/users/{user}/role', '\App\Admin\Controllers\UserController@role');
            Route::post('/users/{user}/role', '\App\Admin\Controllers\UserController@storeRole');

            //角色
            Route::get('/roles', '\App\Admin\Controllers\RoleController@index');
            Route::get('/roles/create', '\App\Admin\Controllers\RoleController@create');
            Route::post('/roles/store', '\App\Admin\Controllers\RoleController@store');
            Route::get('/roles/{role}/permission', '\App\Admin\Controllers\RoleController@permission');
            Route::post('/roles/{role}/permission', '\App\Admin\Controllers\RoleController@storePermission');

            //权限
            Route::get('/permissions', '\App\Admin\Controllers\PermissionController@index');
            Route::get('/permissions/create', '\App\Admin\Controllers\PermissionController@create');
            Route::post('/permissions/store', '\App\Admin\Controllers\PermissionController@store');

        });

        Route::group(['middleware' => 'can:post'], function () {
            //文章模块
            Route::get('/posts', '\App\Admin\Controllers\PostController@index');
            Route::get('/posts/{post}/edit', '\App\Admin\Controllers\PostController@edit');
            Route::post('/posts/{post}/update', '\App\Admin\Controllers\PostController@update');
            Route::post('/posts/{post}/status', '\App\Admin\Controllers\PostController@status');

        });

        Route::group(['middleware' => 'can:tag'], function () {
            //标签模块
            Route::get('/tags', '\App\Admin\Controllers\TagController@index');
            Route::get('/tags/create', '\App\Admin\Controllers\TagController@create');
            Route::post('/tags/store', '\App\Admin\Controllers\TagController@store');
            Route::get('/tags/{tag}/edit', '\App\Admin\Controllers\TagController@edit');
            Route::post('/tags/{tag}/editStore', '\App\Admin\Controllers\TagController@editStore');
            Route::post('/tags/{tag}/delete', '\App\Admin\Controllers\TagController@delete');
        });

        Route::group(['middleware' => 'can:topic'], function () {
            //专题模块
            Route::resource('topics', '\App\Admin\Controllers\TopicController', ['only' => ['index', 'create', 'store', 'destroy']]);
        });

        Route::group(['middleware' => 'can:notice'], function () {
            //通知模块
            Route::resource('notices', '\App\Admin\Controllers\NoticeController', ['only' => ['index', 'create', 'store', 'destroy']]);
        });

        Route::group(['middlewre' => 'can:file'], function () {
            Route::get('/files  ', '\App\Admin\Controllers\ExcelController@index');
            Route::get('/files/export', '\App\Admin\Controllers\ExcelController@export');
            Route::get('/files/downloadExcel', '\App\Admin\Controllers\ExcelController@downloadExcel');
            Route::post('/files/import', '\App\Admin\Controllers\ExcelController@import');//导入
        });

    });
});