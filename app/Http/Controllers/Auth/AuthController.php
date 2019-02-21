<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\ThirdLogin;
use App\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class AuthController extends Controller
{
    public function weibo()
    {
        return Socialite::driver('weibo')->redirect();
        // return \Socialite::with('WeiBo')->scopes(array('email'))->redirect();
    }

    //微博授权页面
    public function callback()
    {
        $code=request('code');
        if (!$code) return \redirect('/login')->with('取消授权成功');
//        dd($code);
        $oauthUser = Socialite::driver('weibo')->user();
//        dd($oauthUser);
        $sina_id = (int)$oauthUser->getId();
        $name = $oauthUser->getName();
        $nickname = $oauthUser->getNickname();
        $email = $oauthUser->getEmail();
        $sina_avatar = $oauthUser->getAvatar();

        /* //从 Token（OAuth2）中获取用户信息
         $token = $oauthUser->token;
         $user = Socialite::driver('WeiBo')->userFromToken($token);
         dd($user);*/

        $where['sina_id'] = $sina_id;
        $userDetail = ThirdLogin::where($where)->first();
        //若sina_id用户不存在，向third_login表中添加用户信息的同时，向user表中也添加条信息，
        //将user信息与third_login，方便前台登录查询
        if (empty($userDetail)) {
            $user = ThirdLogin::create(compact('sina_id', 'name', 'nickname', 'email', 'sina_avatar'));

            $name = $user->nickname;
            $avatar = $user->sina_avatar;
            $email = $user->email;
            $third_id = $user->sina_id;
            $password = 0;
            User::create(compact('name', 'password', 'email', 'avatar', 'third_id'));

            //使用Auth::login（实例，true）授权登录  ,这部分代码不能拿出去优化
            $is_user = user::where('third_id', $user->sina_id)->first();
            Auth::login($is_user, $remember = false);
            if (\Auth::check()) {//授权成功
                //登录成功记录cookie
                $cookie=cookie('user_message',$is_user->third_id,60);
                return \redirect('/posts')->cookie($cookie);
            } else {
                return \Redirect::back()->withErrors('授权失败');
            }
//            User::third_login($user);
        } else {

            $is_user = user::where('third_id', $userDetail->sina_id)->first();
            Auth::login($is_user, $remember = false);
            if (\Auth::check()) {//授权成功
                //登录成功记录cookie
                $cookie=cookie('user_message',$is_user->third_id,60);
                return \redirect('/posts')->cookie($cookie);
            } else {
                return \Redirect::back()->withErrors('授权失败');
            }

//            User::third_login($userDetail);
//          return Redirect::back()->withErrors('微博用户'.$userDetail->nickname.'已存在');
        }
    }

    //微博取消授权(暂时不用，被取代)
    public function wbCancle()
    {
        return \Redirect::back()->withError('取消授权成功');
    }

    //qq授权页面
    public function qqlogin()
    {
        return Socialite::driver('qq')->redirect();
        // return \Socialite::with('WeiBo')->scopes(array('email'))->redirect();
    }

    //qq回调地址
    public function qqcallback()
    {
        $user = Socialite::driver('qq')->user();
        /*$accessTokenResponseBody = $user->accessTokenResponseBody;
        dd($accessTokenResponseBody);*/
        // dd($user);

        $openid = $user->getId();
        $name = $user->getNickname();
        $email = $user->getEmail();
        $avatar = $user->getAvatar();
        $password = 0;

        $res = User::where('openid', $openid)->first();
//        dd($res);
        if (empty($res)) {//不存在
            $userModel = User::create(compact('name', 'email', 'avatar', 'password', 'openid'));
//dd($userModel);
            Auth::login($userModel, false);
            if (\Auth::check()) {//授权成功
                /*$uu=Auth::user();
                dd($uu);*/
                //登录成功记录cookie
                $cookie=cookie('user_message',$userModel->openid,60);
                return \redirect('/posts')->cookie($cookie);
            } else {
                return \Redirect::back()->withErrors('授权失败');
            }
        } else {//存在
            $is_user = user::where('openid', $res->openid)->first();
            Auth::login($is_user, false);

            if (\Auth::check()) {//授权成功
                /*  $uu=Auth::user();
                  dd($uu);*/
                $cookie=cookie('user_message',$is_user->openid,60);
                return \redirect('/posts')->cookie($cookie);
            } else {
                return \Redirect::back()->withErrors('授权失败');
            }
        }

    }







    //使用微博账号信息登录系统  展示微博账号信息
    /* public function third_login($user)
     {
         $is_user = user::where('third_id', $user->sina_id)->first();

         Auth::guard('web')->login($is_user, $remember = false);
         if (\Auth::check()) {//授权成功

             $user = Auth::user();
             echo 'true';

             return \redirect('http://test.open.lixiaowang.top/posts');
             dd($user);

         } else {

             $user = Auth::user();
             echo 'false';

             return \Redirect::back()->withErrors('授权失败');
             dd($user);

         }

     }*/
}