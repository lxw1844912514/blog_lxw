<?php

namespace App;

use App\Model;

class Tag extends Model
{

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['name','post_id','status'];

    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;


    //文章模块(一对多)(一个标签使用于多篇文章)
    public function posts()
    {
        return $this->hasMany('App\Post')->orderBy('created_at','desc');
    }

    //添加多个标签
    static public function addTags($tags,$post)
    {
        // 通过 name 和文章id 查找标签，不存在则创建一个实例
        foreach ( explode(',',$tags) as $tag_name ){
            $tagobj = Tag::firstOrNew(['name' => $tag_name]);

            $tagobj->post_id=$post->id;

            $tagobj->save();

//            $tagobj = Tag::updateOrCreate(['name' => $tag_name],['post_id'=>$post->id]);
//            $tagobj->save();


            $post->tag_id.=$tagobj->id.',';
        }
    }

//


}
