<?php

namespace App\Admin\Controllers;


use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::where('status',1)->orderBy('sort','asc')->get();
        return view('admin.category.index',compact('categorys'));
    }

//    添加栏目页面
    public function add()
    {
        $categorys = Category::where('status',1)->orderBy('sort','asc')->get();
        return view('admin.category.add',compact('categorys'));
    }

    //添加栏目
    public function store(Request $request)
    {
        $this->validate(\request(),
            [
                'name' => 'required|max:15|string',
                'route' => 'required|max:15|string',
                'describe' => 'max:100|string',
                'pid' => 'required|integer',
            ]);
        $desc=\request('describe');
        $params = array_merge(\request(['name', 'route',  'pid']),compact('desc'));
        $res = Category::create($params);
        return redirect('/admin/categorys');

    }

    //    修改栏目页面
    public function edit(Category $category)
    {
        $categorys = Category::where('status',1)->orderBy('sort','asc')->get();
        return view('admin.category.edit',compact('category','categorys'));
    }

    //修改逻辑
    public function editStore(Request $request,Category $category)
    {
        $this->validate($request,[
            'name' => 'required|max:15|string',
            'route' => 'required|max:15|string',
            'describe' => 'max:100|string',
            'pid' => 'required|integer',
            'sort'=> 'required|integer',
        ]);

        if (\request('name')!= $category->name){
            $category->name=\request('name');
        }
        if (\request('route')!= $category->route){
            $category->route=\request('route');
        }
        if (\request('describe')!= $category->desc){
            $category->desc=\request('describe');
        }
        if (\request('pid')!= $category->pid){
            $category->pid=\request('pid');
        }
        if (\request('sort')!= $category->sort){
            $category->sort=\request('sort');
        }

        $category->save();
        return redirect('/admin/categorys');

    }

    //    删除栏目
    public function status(Category $category)
    {
//        $category->delete();
//        return redirect('/admin/categorys');
        $this->validate(\request(),[
            'status'=>'required|in:1,-1'
        ]);
        $category->status=\request('status');
        $category->save();
        return [
            'error' => 0,
            'msg' => '删除管理员成功'
        ];
    }
}