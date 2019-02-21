<?php

namespace App;

use App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
class User extends Authenticatable
{
    use Notifiable;
    //
    protected $fillable = [
        'name', 'password', 'email','avatar','third_id','openid'
    ];

    //用户的文章列表
    public function posts()
    {                   //posts表的外键user_id           //user表id
        return $this->hasMany(\App\Post::class, 'user_id', 'id');
    }

    //我的粉丝
    public function fans()
    {
        return $this->hasMany(\App\Fan::class, 'star_id', 'id');
    }

    //    我关注的star模型
    public function stars()
    {
        return $this->hasMany(\App\Fan::class, 'fan_id', 'id');
    }

    //    关注某人
    public function doFan($uid)
    {
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        return $this->stars()->save($fan);

    }

    //    取消关注
    public function doUnFan($uid)
    {
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        return $this->stars()->delete($fan);
    }

    //当前用户是否被uid关注
    public function hasFan($uid)
    {
        return $this->fans()->where('fan_id', $uid)->count();
    }

    //当前用户是否关注了uid
    public function hasStar($uid)
    {
        return $this->stars()->where('star_id', $uid)->count();
    }

    //用户收到的通知列表
    public function notices()
    {
        return $this->belongsToMany(Notice::class, 'user_notice', 'user_id', 'notice_id')->withPivot('user_id', 'notice_id');
    }
    //给用户发送通知
    public function addNotice($notice)
    {
        return $this->notices()->save($notice);
    }
    // 删除通知
    public function deleteNotice($notice)
    {
        return $this->notices()->detach($notice);
    }

    /**
     * 发送密码重置通知.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
