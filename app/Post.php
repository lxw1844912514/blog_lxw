<?php

namespace App;


use Laravel\Scout\Searchable;
use App\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use Searchable;

    //定义索引里面的type
    public function searchableAs()
    {
        return 'post';
    }

    //定义有哪些字段需要搜索
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
        ];
    }

    //关联用户(一对多反向)
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');

    }

    //评论模块（一对多）
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }

    //和用户关联
    public function zan($user_id)
    {
        return $this->hasOne(\App\Zan::class)->where('user_id', $user_id);
    }

    //文章的所有赞
    public function zans()
    {
        return $this->hasMany(\App\Zan::class);
    }

    //属于某个作者的文章
    public function scopeAuthBy($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    //文章与专题的关系
    public function postTopics()
    {
        return $this->hasMany(\App\PostTopic::class, 'post_id', 'id');
    }

    //不属于某个专题的文章
    public function scopeTopicNotBy($query, $topic_id)
    {
        return $query->doesntHave('postTopics', 'and', function ($que) use ($topic_id) {
            $que->where('topic_id', $topic_id);
        });
    }

    //全局scope的方式
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope("avaiable", function (Builder $builder) {
            $builder->whereIn('status', [0, 1]);
        });
    }



    //文章所属分类（多对一）
    public function categorys()
    {
     return $this->belongsTo('App\Category','cid','id')->withDefault(['name' => '暂无分类',]) ;
    }

    //   标签模块（ 多对多,一篇文章所有的标签）
    public function tags()
    {
        return $this->belongsToMany(\App\Tag::class,'admin_post_tag','post_id','tag_id');
    }





}


