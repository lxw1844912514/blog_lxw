<?php

namespace App\Http\Controllers;

use App\Rules\Ismobile;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //个人设置页面
    public function setting(User $user)
    {

        return view('user/setting', compact('user'));
    }

    //    个人设置行为
    public function settingStore(Request $request, User $user)
    {

        //验证
        $this->validate(\request(), [
            'name' => 'required|min:3',
            'avatar' => 'image',
            'tel' => ['required', new Ismobile],
//          'tel' => ['required','unique:users,tel', new Ismobile],
        ]);


        //逻辑

//        $this->authorize('settingStore',$user);   //验证授权
        $name = \request('name');
        if ($name != $user->name) {
            if (\App\User::where('name', $name)->count() > 0) {
                return back()->withErrors(array('message' => '用户名已经注册'));
            }
            $user->name = $name;
        }

        $tel = $request->input('tel');
        if ($tel != $user->tel) {
            if(User::where('tel',$tel)->count()>0){
                return back()->withErrors('该手机号已绑定，请重新绑定');
            }
            $user->tel = $tel;
        }

        if ($request->file('avatar')) {
            $path = $request->file('avatar')->storePublicly(date('Y-m-d', time()));
            $user->avatar = '/storage/' . $path;
        }

        $user->save();

        //渲染

        return back();
    }

    //个人中心
    public function show(User $user)
    {
        //这个人信息 包含关注数、粉丝数、文章数
        $user = User::withcount(['stars', 'fans', 'posts'])->find($user->id);
        //这个人的文章列表，创建时间最新的前10条
        $posts = $user->posts()->orderby('created_at', 'desc')->take(10)->get();
        //这个人的关注用户，包含关注数、粉丝数、文章数
        $stars = $user->stars;
        $susers = User::whereIn('id', $stars->pluck('star_id'))->withCount(['stars', 'fans', 'posts'])->get();
        //这个人的粉丝用户，包含关注数、粉丝数、文章数
        $fans = $user->fans;
        $fusers = User::whereIn('id', $fans->pluck('fan_id'))->withCount(['stars', 'fans', 'posts'])->get();


        return view('user/show', compact('user', 'posts', 'susers', 'fusers'));
    }

    //关注
    public function fan(User $user)
    {
        $me = \Auth::user();
        $me->doFan($user->id);
        return [
            'error' => 0,
            'msg' => '关注成功'
        ];
    }

    //取消关注
    public function unfan(User $user)
    {
        $me = \Auth::user();
        $me->doUnFan($user->id);
        return [
            'error' => 0,
            'msg' => '取消关注成功'
        ];
    }

    //修改密码
    public function updatePassword(User $user)
    {
//        dd($user);
        return view('user/updatePassword', compact('user'));
    }

    //重置密码逻辑
    public function storePassword(Request $request, User $user)
    {
        $this->validate(\request(), [
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6|max:8',
        ]);
        $email = \request('email');
        if ($email != $user->email) {
            if (\App\User::where('email', $email)->count() > 0) {
                return back()->withErrors(array('message' => '该邮箱已存在'));
            }
            $user->email = $email;
        }
        $user->password = bcrypt(request('password'));
        $user->save();


        return redirect('posts');

    }
}
