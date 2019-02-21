<?php

namespace App;


class AdminRole extends Model
{
    protected $table = 'admin_roles';

    /*
     * belongToMany参数
     * 第一个：关联的关系   \App\AdminPermission::class
     * 第二个：关系的表名  admin_permission_roles
     * 第三个：当前模型在表中的外键 role_id
     * 第四个：目标模型在表中的关系permission_id
     *
     * withpivot()设置要检索的pivot表上的列
     * */
    //当前角色的所有权限(多对多关系)
    public function permissions()
    {
        return $this->belongsToMany(\App\AdminPermission::class, 'admin_permission_role', 'role_id', 'permission_id')->withPivot(['permission_id', 'role_id']);
    }

    //给角色赋予权限
    public function grantPermission($permission)
    {
        return $this->permissions()->save($permission);
    }

    //取消角色赋予的权限
    public function deletePermission($permission)
    {
        return $this->permissions()->detach($permission);
    }

    //判断角色是否有某个权限
    //$permission 是否contains包含在$this->permissions()权限集合中
    public function hasPermission($permission)
    {
        return $this->permissions()->contains($permission);
    }
}
