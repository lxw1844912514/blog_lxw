<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;

class TopicController extends Controller
{
    //专题详情
    public function show(Topic $topic)
    {
        //带文章数的专题信息
        $topic=Topic::withCount('postTopics')->find($topic->id);

        //文章列表 创建时间倒序 前10个
        $posts=$topic->posts()->orderBy('created_at','desc')->take(10)->get();

        //我的文章不属于这篇专题
        $myposts=\App\Post::authBy(\Auth::id())->topicNotBy($topic->id)->get();

        return view('topic/show',compact('topic','posts','myposts'));
    }

    //投稿
    public function submit(Topic $topic)
    {
        $this->validate(\request(),[
            'post_ids'=>'required|array',
        ]);

        $topic_id = $topic->id;
        $post_ids= \request('post_ids');
        foreach ($post_ids as $post_id){
            \App\PostTopic::firstOrcreate(compact('post_id','topic_id'));
        }

        return back();
    }
}
