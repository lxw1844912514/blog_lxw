<?php

namespace App;


class AdminPermission extends Model
{
    //
    protected $table='admin_permissions';

    public function roles()
    {
        return $this->belongsToMany(\App\AdminPermission::class,'admin_permission_role','permission_id','role_id')->withPivot(['permission_id','role_id']);
    }
}
