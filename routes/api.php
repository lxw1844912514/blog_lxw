<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('file/upload',function (Request $request){
    if ($request->hasFile('photo')&& $request->file('photo')->isValid()){
//        $photo=$request->file('photo');
        $photo=$request->photo;  #等同于上一行
        $extension=$photo->extension();
        $path=$request->photo->path();
        $name=$photo->getClientOriginalName();
        $error=$photo->getError();
//        $store=$photo->store('photo','public');
        $store=$photo->store('photo');
//        $store=$photo->storeAs('photo','test.jpg');
        $output=[
            'extension'=>$extension,
            'store'=>$store,
            'originalName'=>$name,
            'error'=>$error,
            'path'=>$path,
        ];
        dd($output);
    }
    exit('未获取到上传文件或上传过程出错');
});
