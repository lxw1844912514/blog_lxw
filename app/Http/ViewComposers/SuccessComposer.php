<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\AdminUser;

class SuccessComposer
{
    /**
     * 用户 repository 实现。
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * 创建一个新的 profile composer。
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(AdminUser $users)
    {
        // 依赖关系由服务容器自动解析...
        $this->users = $users;
    }

    /**
     * 将数据绑定到视图。
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        //TODO 该方法暂未成功  视图合成器
//        echo 'ddddd';
//        dd('function compose');
//        $count=$this->users->count();
//        dd($count);
        $view->with('count', $this->users->count());
    }
}