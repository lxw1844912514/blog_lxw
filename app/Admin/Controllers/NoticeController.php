<?php

namespace App\Admin\Controllers;

use App\Notice;

class NoticeController extends Controller
{
    //通知列表
    public function index()
    {
        $notices = Notice::paginate(10);
        return view('admin/notice/index', compact('notices'));
    }

    //增加通知页面
    public function create()
    {
        return view('admin/notice/add');
    }

    //增加通知行为
    public function store()
    {
        $this->validate(request(), [
            'title' => 'required|min:3|string',
            'content' => 'required'
        ]);
        $notice = Notice::create(request(['title', 'content']));

        //创建发送逻辑
        dispatch(new \App\jobs\sendMessage($notice));

        return redirect('/admin/notices');
    }

    public function destroy(Notice $notice)
    {
        $notice->delete();
        return [
            'error' => 0,
            'msg' => '删除成功'
        ];
    }
}


