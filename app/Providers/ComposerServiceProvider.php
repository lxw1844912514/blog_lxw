<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;


class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        // 使用基于类的 composer...
        View::composer(
            'success', 'App\Http\ViewComposers\SuccessComposer'
        );

        /*view()->share('sitename','Laravel学院');
        view()->composer('admin.layout.footer',function($view){
            $view->with('user',array('name'=>'test','avatar'=>'/path/to/test.jpg'));
        });*/

        // 在 footer 视图中绑定 location 数据
       /* view()->composer('admin.layout.footer', function($view) use ($request) {
            $location = geoip($request->ip());
            $view->with('location', $location->country.' - '.$location->state_name.' - '.$location->city);
//            $view->with('location', 'beijing - '.'beijing - chaoyang');
        });*/
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
