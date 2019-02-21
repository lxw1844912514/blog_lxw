<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     *
     * 后执行
     */
    public function boot()
    {
        \Carbon\Carbon::setLocale('zh');
        /**
         * 加载自定义函数库
         */
        require app_path('Helpers/common.php');

//        View::share('messages', ['success']);//共享一段数据给应用程序的所有视图

        //       767/4=191
        Schema::defaultStringLength(191);
        Blade::component('components.alert','alert');
//        Blade::withoutDoubleEncoding();
        DB::listen(function ($query){
            $query->sql;
        });

        View::composer('layout.sidebar',function ($view){

            $topics=\App\Topic::all();
            $view->with('topics',$topics);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     *
     * 先执行
     */
    public function register()
    {
        //
    }
}
