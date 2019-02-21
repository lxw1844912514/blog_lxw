<?php

namespace App\Admin\Controllers;


use App\Tag;

class TagController extends Controller
{
    //标签列表
    public function index()
    {
        $tags=Tag::where('status',1)->paginate(5);
        return view('admin.tag.index',compact('tags'));
    }
    //添加标签
    public function create()
    {
        return view('admin.tag.add');

    }
    // 添加标签逻辑
    public function store(Tag $tag)
    {
        $this->validate(\request(),[
            'name'=>'required|max:25|unique:tags,name',

        ]);
        $tag->name=request('name');
        $tag->post_id=0;
        $tag->save();
        return redirect('/admin/tags');
    }

    //    修改标签
    public function edit(Tag $tag)
    {
        return view('admin.tag.edit',compact('tag'));
    }

//    修改逻辑
    public function editStore(Tag $tag)
    {
        $this->validate(\request(),[
            'name'=>'required|max:25|unique:tags,name',
        ]);
        $tag->name=request('name');
        $tag->post_id=0;  //TODO：无用可删除
        $tag->save();
        return redirect('/admin/tags');
    }

    // 删除标签
    public function delete(Tag $tag)
    {
//        Tag::destroy($tag->id);
        $tag->status='0';
        $tag->save();
        return [
            'status'=>1,
            'msg'=>'删除标签成功'
        ];
    }

}