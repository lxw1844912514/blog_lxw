<?php

namespace App\Http\Controllers;

use App\Libraries\MiaoDi\HttpUtil;
use App\Rules\Ismobile;
use App\Rules\Uppercase;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected $redirectTo = '/posts';
    //登录页面
    public function index()
    {

        $msg=Cookie::get('user_message');
        if (\Auth::guard('web')->user()) {
//            dd(\Auth::guard('web')->user());

//            return \redirect('/posts');
        } else {
            return view('login.index');
        }
    }

    //登录行为
    public function login()
    {
        //验证
        $this->validate(\request(), [
            'email' => 'required|email',
            'password' => 'required|min:6|max:8',
            'is_remember' => 'integer'
        ]);
        //逻辑
        $user = request(['email', 'password']);
        $is_remember = boolval(request('is_remember'));
        if (\Auth::guard('web')->attempt($user, $is_remember)) {
            //登录成功记录cookie
//            $cookie=cookie('user_message',$user['email'],60);
            return redirect('/posts');
        }
        //渲染
        return \Redirect::back()->withErrors('邮箱密码不匹配');

    }



    //登出行为
    public function logout(Request $request)
    {
        \Auth::logout();
        Cookie::queue(Cookie::forget('user_message'));
        return \redirect('/login');
    }

    //手机登录页面
    public function phone()
    {
        /*$tel=\request()->old('tel');
        dd($tel);*/
        return view('login.phone');
    }

    //发送验证码
    public function sendSms(Request $request)
    {
        //验证
        $request->validate([
            'tel' => ['required', new Ismobile],
        ]);
        if ($tel = $request->input('tel')) {
            $res = User::where('tel', $tel)->first();
            if (empty($res)) {
                $request->flush();
                return back()->withInput()->withErrors('您还没有注册，请注册！');
            }
        }
        /**
         * url中{function}/{operation}?部分
         */
        $funAndOperate = "industrySMS/sendSMS";
        $http = new HttpUtil;
        // 生成body
        $body = $http->createBasicAuthData();
        // 在基本认证参数的基础上添加短信内容和发送目标号码的参数
        //$body['smsContent'] = "【青春阳光】登录验证码：123456，如非本人操作，请忽略此短信。";
        $body['templateid'] = '525754217';//模板id
        $code = rand(100000, 999999);
        $minutes = 15;
        $body['param'] = $code . ',' . $minutes;//验证码，5分钟
        $body['to'] = $tel;
        // 提交请求
        $result = $http->post($funAndOperate, $body);
        $resObj = json_decode($result);
        if ($resObj->respCode == '00000') {
            Cookie::queue('code', $code, $minutes);
            Cookie::queue('tel', $tel, $minutes);
//            return $resObj->respDesc;
//            Request::flashOnly('tel');
//           return response()->cookie('code', $code, 5 );
            sleep(10);
            return redirect('/phone')->withInput();
        } else {
            return \Redirect::back()->withErrors($resObj->respDesc);
        }
//        echo("<br/>result:<br/><br/>");
    }

    //手机登录逻辑
    public function phoneLogin(Request $request)
    {
        $this->validate(\request(), [
            'verify' => 'required|max:6|min:6'
        ]);

        $cookieCode = $request->cookie('code');
        $cookieTel = $request->cookie('tel');

        if (\request('verify') == $cookieCode) {//验证码正确

            $user = User::where('tel', $cookieTel)->first();
            Auth::login($user, false);
            //登录成功记录cookie
            $cookie=cookie('user_message',$user->tel,60);
            return \redirect('/posts')->cookie($cookie);

        } elseif (!isset($cookieCode)) {
            return \Redirect::back()->withErrors('验证码已过期');
        } else {
            return \Redirect::back()->withErrors('验证码错误');
        }


    }
}
