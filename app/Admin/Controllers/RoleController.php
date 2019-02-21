<?php

namespace App\Admin\Controllers;

use App\AdminPermission;
use App\AdminRole;
use \App\AdminUser;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    //角色列表
    public function index()
    {
        $roles = AdminRole::paginate(10);
        return view('admin/role/index', compact('roles'));
    }

    //创建角色
    public function create()
    {
        return view('admin/role/add');
    }

    //创建角色行为
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'description' => 'required'
        ]);

        AdminRole::create(request(['name', 'description']));

        return redirect('admin/roles');
    }

    //角色和权限关系页面
    public function permission(AdminRole $role)
    {
        //获取所有权限
        $permissions = AdminPermission::all();
        //获取当前角色权限
        $myPermissions = $role->permissions;
        return view('admin/role/permission',compact('permissions','myPermissions','role'));
    }

    //储存角色和权限的行为
    public function storePermission(AdminRole $role)
    {
        $this->validate(request(),[
           'permissions'=>'required|array',
        ]);

        $permissions=AdminPermission::findMany(request('permissions'));
        $myPermissions=$role->permissions;   //permissions函数不能带括号
        //给角色赋予权限
        $addPermissions=$permissions->diff($myPermissions);
        foreach ($addPermissions as $permission){
            $role->grantPermission($permission);
        }
        //取消角色某个权限
        $deletePermissions=$myPermissions->diff($permissions);
        foreach ($deletePermissions as $permission) {
            $role->deletePermission($permission);
        }
        return \redirect('admin/roles');
    }


}


