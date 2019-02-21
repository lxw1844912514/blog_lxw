<?php

namespace App\Providers;

use App\AdminPermission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        /* 1.获取所有权限
         * 2.给每一个权限定义门类  $permission->name
         * 3.判断用户是否某一个权限 $user->hasPermission($permission);
         * */
        $permissions = AdminPermission::all();
        foreach ($permissions as $permission) {
            Gate::define($permission->name,function ($user) use($permission){
               return $user->hasPermission($permission);
            });
        }
    }
}
