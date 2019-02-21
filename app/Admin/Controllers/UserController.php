<?php

namespace App\Admin\Controllers;

use App\AdminRole;
use App\AdminUser;
use App\Jobs\SendEmail;
use App\Mail\ResetPwd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use League\Flysystem\Config;


class UserController extends Controller
{
    //管理员列表
    public function index(Request $request)
    {
        $users = AdminUser::where('status', 1)->orderBy('id')->paginate(10);
        $admin=$request->user();
//        dd($admin);
        //dd(public_path());//"D:\phpstudy\PHPTutorial\WWW\laravel\blog\public"
        return view('admin/user/index', compact('users','admin'));
    }

    //增加管理员页面
    public function create()
    {
        return view('admin/user/add');
    }


    //增加管理员 逻辑
    public function store()
    {
        $this->validate(\request(), [
            'name' => 'required|min:3|unique:admin_users,name',
            'password' => 'required',
            'email' => 'required|email|unique:admin_users,email',
        ]);

        $name = request('name');
        $password = bcrypt(request('password'));
        $email = request('email');
        AdminUser::create(compact('name', 'password', 'email'));

        return redirect('/admin/users');
    }

    //编辑管理员
    public function edit(AdminUser $user)
    {

        return view('admin/user/edit', compact('user'));
    }

    //编辑管理员 逻辑
    public function storeEdit(Request $request, AdminUser $user)
    {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'avatar' => 'image'
        ]);

        $name = \request('name');
        if ($name != $user->name) {
            if (AdminUser::where('name', $name)->count() > 0) {
                return back()->withErrors(array('message' => '用户名已存在'));
            }
            $user->name = $name;
        }
        if ($request->file('avatar')) {
            $path = $request->file('avatar')->storePublicly(date('Y-m-d', time()));
            $user->avatar = '/storage/' . $path;
        }
        if (request('password')) {
            $user->password = bcrypt(\request('password'));
        }
        $user->email = request('email');

        $user->save();
        return redirect('/admin/users');
    }

    //删除管理员
    public function destroy(AdminUser $user)
    {

        $user->delete();
//        return redirect('/admin/users');
        return [
            'error' => 0,
            'msg' => '删除管理员成功'
        ];
    }

    //只要定义一个获取器  访问器
    public function getInitPwdAttribute()
    {
        return $this->attributes['initPwd'];
    }

    //重置密码逻辑
    public function resetPassword(Request $request, AdminUser $user)
    {
        $initPwd = env('INIT_PWD');
        $user->password = bcrypt($initPwd);
        $user->save();
        //TODO  一定在save后，否则报错在数据库找不到该字段
        $user->init_pwd = $initPwd;
        //重置密码的同时 发送邮件通知后台管理人员
        $adminUser = config('constants.ADMIN_EMAIL');
//        dd(\config('constants.ADMIN_USER'));
        // 方法一：直接发送
       /* Mail::to($user)
            ->cc($adminUser)//抄送人
      //    ->bcc($adminUser)//暗抄送
            ->send(new ResetPwd($user));*/
//dd($user->init_pwd);
        //方法二：队列延迟分发 将邮件消息加入队列
        //创建发送逻辑  php artisan queue:work 启动队列
        $this->dispatch(new SendEmail($user));
//        Mail::to($user)->cc($adminUser)->queue(new ResetPwd($user));

        return back();
    }


    //软删除 修改管理员状态
    public function status(AdminUser $user)
    {
        $this->validate(\request(), [
            'status' => 'required|in:1,-1'
        ]);

        $user->status = \request('status');
        $user->save();
        return [
            'error' => 0,
            'msg' => '管理员状态修改成功'
        ];
    }


    //用户角色页面
    public function role(AdminUser $user)
    {
        $roles = AdminRole::all();
        $myRoles = $user->roles;
        return view('admin/user/role', compact('roles', 'myRoles', 'user'));
    }

    //储存角色
    public function storeRole(AdminUser $user)
    {
        $this->validate(request(), [
            'roles' => 'required|array'
        ]);

        $roles = AdminRole::findMany(request('roles'));
        $myRoles = $user->roles;

        //要增加的权限
        $addRoles = $roles->diff($myRoles);
        foreach ($addRoles as $role) {
            $user->assignRole($role);
        }
        //要删除的权限
        $deleteRoles = $myRoles->diff($roles);
        foreach ($deleteRoles as $role) {
            $user->deleteRole($role);
        }

        return redirect('admin/users');
    }

}


