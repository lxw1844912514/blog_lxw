<?php

namespace App;

use App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    protected $guarded = [];//不可以注入数据字段
    protected $appends = ['init_pwd'];

    //加上下面这一句，相当于把$rememberTokenName清空，
    protected $rememberTokenName = '';
    //用户有哪些权限
    public function roles()
    {
        return $this->belongsToMany(\App\AdminRole::class, 'admin_role_user', 'user_id', 'role_id')->withPivot(['user_id', 'role_id']);
    }

    //判断用户是否有某个或者某些角色
    public function isInRoles($roles)
    {
        //判断传进来的角色是否跟这些角色有交集，count 如果为0的话，经过!!转变为false,非0就是为true
        return !!$roles->intersect($this->roles)->count();
    }

    //给用户分配角色
    public function assignRole($role)
    {
        return $this->roles()->save($role);
    }
    
    //取消用户分配的角色
    public function deleteRole($role)
    {
        return $this->roles()->detach($role);//删除关系而不是删除角色和权限，
    }

    //用户是否有权限
    //就是判断这个用户拥有的角色 跟 拥有某个（某些）权限的角色是否有交集
    public function hasPermission($permission)
    {
        return $this->isInRoles($permission->roles);
    }
}
