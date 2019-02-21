<?php

namespace App;

use App\Model;

class Topic extends Model
{
    //属于这专题的文章列表
    public function posts()
    {
        return $this->belongsToMany(\App\Post::class,'post_topics','topic_id','post_id');
    }
    
    //专题的文章数
    public function postTopics()
    {
        return $this->hasMany(\App\PostTopic::class,'topic_id','id');
    }    
}
