<?php

namespace App\Admin\Controllers;

use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use \App\Post;

class PostController extends Controller
{
    //文章列表页面
    public function index()
    {
        $posts = Post::withoutGlobalScope('avaiable')->where('status', '<>',-1)->orderBy('posts.created_at', 'desc')->paginate(5);
        return view('admin.post.index',compact('posts'));
    }

    //修改文章页面
    public function edit(Post $post)
    {
        $categorys=Category::where('status',1)->orderBy('sort','asc')->get();

        /*$tag_name='';
        foreach (explode(',',trim($post->tag_id,',')) as $tag){
            $tag_name .=Tag::where('id',$tag)->value('name').',';
        }*/
        //所有标签
        $tag_name=Tag::where('status',1)->get();

        // 当前文章拥有的标签
        $tags=$post->tags();
        return view('admin.post.edit',compact('post','categorys','tag_name','tags'));
    }

    //修改文章逻辑
    public function update(Request $request,Post $post)
    {

        $this->validate(\request(),[
           'title'=>'required|unique:posts|max:255|string',
           'body'=>'required',
            'pid'=>'required|integer',
//            'tag'=>'required|max:25|string',
            'time'=>'required|date '
        ]);



        // 给文章添加多个标签
//        dd($request['tag']);
        $tag=Tag::addTags($request['tag'],$post);

//dd($tag);
        $post->title=$request['title'];
        $post->body=$request['body'];
        $post->cid=$request['pid'];
        $post->created_at=$request['time'];
        $post->keyword=$request['keyword'];
        $post->desc=$request['describe'];
        $post->pic=$request['titlepic'];
        $post->status=$request['status'];
        $post->user_id=Auth::id();;

        $post->save();
        return \redirect('/admin/posts');
    }

    //修改文章状态
    public function status(Post $post)
    {
        $this->validate(\request(),[
            'status'=>'required|in:1,-1'
        ]);

        $post->status=\request('status');
        $post->save();

        return [
            'error'=>0,
            'msg'=>'审核通过'
        ];
    }
}


