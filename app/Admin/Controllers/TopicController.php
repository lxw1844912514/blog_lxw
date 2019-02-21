<?php

namespace App\Admin\Controllers;

use App\Topic;

class TopicController extends Controller
{
    //专题列表
    public function index()
    {
        $topics=Topic::paginate(10);
        return view('admin/topic/index',compact('topics'));
    }
    //增加专题页面
    public function create()
    {
        return view('admin/topic/add');
    }
    //增加专题行为
    public function store()
    {
        $this->validate(request(),[
            'name'=>'required|min:3|string'
        ]);
        Topic::create(request(['name']));

        return redirect('/admin/topics');
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();
        return [
            'error'=>0,
            'msg'=>'删除成功'
        ];
    }
}


