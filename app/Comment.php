<?php

namespace App;

use App\Model;

class Comment extends Model
{
    //评论所属文章（一对多反向）
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    //评论所属人（一对多反向）
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
