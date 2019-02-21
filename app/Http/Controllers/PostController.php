<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Zan;
use Illuminate\Http\Request;


class PostController extends Controller
{
    //列表
    public function index()
    {
        /*$app =app();
        $log= $app->make('log');
        $log->info('post_message',['data'=>'this is a log test']);*/
//        使用with预加载
//        $posts = Post::orderby('created_at', 'desc')->withCount(['comments', 'zans'])->with('user')->paginate(5);

        $posts = Post::orderby('created_at', 'desc')->withCount(['comments', 'zans'])->paginate(5);
        $posts->load('user');
//        dd($posts);
        return view('post/index', compact('posts'));
//        return view('post/index',['lists'=>$lists]);
    }

    //详情
    public function show(Post $post)
    {
        //预加载评论(建议使用)
        $post->load('comments');
        $post->increment('view_count');
//        $post->visits()->increment();

        /*$refer=new Referer;
        $refer->put('google.com');
        $get= $refer->get();
        var_dump($get);*/

        /*logger('referer =======>');
        logger($post->visits()->refs());
        logger('<======== referer');

        logger('countries =======>');
        logger($post->visits()->countries());
        logger('<======== countries');*/

        return view('post/show', compact('post'));
//        return view('post/show',['title'=>'this is a title','isShow'=>false,]);
    }

    //创建
    public function create()
    {
        return view('post/create');
    }

    //创建
    public function store()
    {
        //方法一
        /* $post=new Post();
         $post->title=\request('title');
         $post->body=\request('body');
         $post->save();*/
//       $data=['title'=>\request('title'),'body'=>\request('body')];
//        $data= \request(['title','body']);
        // 方法二：

        //表单提交：三步
        // 第一步：验证
        $this->validate(\request(), [
            'title' => 'required|min:10|max:100|string',
            'body' => 'required|min:10|string',
        ]);
        //逻辑
        $user_id = \Auth::id();
        $params = array_merge(\request(['title', 'body']), compact('user_id'));
        $res = Post::create($params);
        //渲染
        return redirect('/posts');
    }

    //编辑页面
    public function edit(Post $post)
    {
        return view('post/edit', compact('post'));
    }

    //编辑 逻辑
    public function update(Post $post)
    {
        //验证
        $this->validate(\request(), [
            'title' => 'required|min:10|max:100|string',
            'body' => 'required|min:10|string',
        ]);
        //逻辑
        //验证授权
        $this->authorize('update', $post);

        $post->title = \request('title');
        $post->body = \request('body');
        $post->save();

        //渲染
        return redirect('posts/' . $post->id);
    }

    //删除
    public function delete(Post $post)
    {
        //TODO:用户权限验证
        //验证授权
        $this->authorize('delete', $post);

        $post->delete();
        return redirect('/posts');
    }

    // 上传图片
    public function imageUpload(Request $request)
    {
        $path = $request->file("wangEditorH5File")->storePublicly(date('Y-m-d', time()));
        return asset('storage/' . $path);
    }

    //提交评论
    public function comment(Post $post)
    {
        $this->validate(\request(), [
            'content' => 'required|min:4',
        ]);
        // 逻辑
        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content = \request('content');
        $post->comments()->save($comment);
        //渲染
        return back();
    }

    //赞模块
    public function zan(Post $post)
    {
        $param = [
            'user_id' => \Auth::id(),
            'post_id' => $post->id,
        ];
        Zan::firstOrCreate($param);
        return back();
    }

    //取消赞
    public function unzan(Post $post)
    {
        $post->zan(\Auth::id())->delete();
        return back();
    }

    //搜索
    public function search()
    {
        return view('post/search');
    }
}
