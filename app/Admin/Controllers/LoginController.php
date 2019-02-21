<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\AdminUser;


class LoginController extends Controller
{
    //登录页面
    public function index()
    {
            if (Auth::guard('admin')->user()) {
//            \Auth::guard('admin')->once();
//             dd(\Auth::guard('admin')->user());
            return redirect('/admin/users');

        } else {
            return view('admin.login.index');
        }
    }

    //登录逻辑
    public function login()
    {
        $this->validate(\request(), [
            'name' => 'required|min:3',
            'password' => 'required',
            'captcha' => 'required|captcha',  //后面的这个captcha，是验证的不用写逻辑
        ]);

        $adminUser = request(['name', 'password']);
        if (Auth::guard('admin')->attempt($adminUser)) {
//            dd($adminUser);

            $last_login_ip=get_Ip_Bypconline();
            $last_login_time=date('Y-m-d H:i:s',time());
            AdminUser::where(['name'=>request('name')])->update(compact('last_login_ip','last_login_time'));
            //登录成功记录cookie
//            $adminMsg = join(',', $adminUser);
//            $cookie = cookie('admin_user', $adminMsg, 60);

            return redirect('/admin/index');
        }
        return \Redirect::back()->withErrors('账号密码不匹配');
    }


    //登出
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
//        Cookie::queue(Cookie::forget('admin_user'));
        return \redirect('/admin/login');
    }
}


