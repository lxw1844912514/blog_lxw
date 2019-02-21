@extends('admin.layout.main')
@section('content')
    <div class="content-wrapper">
            <section class="content">
                <div class="col-md-7">
                    <h1 class="page-header">操作</h1>
                    <a href="{{'/admin/categorys/add'}}">
                        <ol class="breadcrumb button-add-all  	glyphicon glyphicon-plus">
                            <li>增加栏目</li>
                        </ol>
                    </a>
                    <h1 class="page-header">管理 <span class="badge">3</span></h1>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th><span class="glyphicon glyphicon-paperclip"></span> <span class="visible-lg">ID</span>
                                </th>
                                <th><span class="glyphicon glyphicon-file"></span> <span class="visible-lg">名称</span></th>
                                <th><span class="glyphicon glyphicon-list-alt"></span> <span class="visible-lg">路径</span>
                                </th>
                                <th><span class="glyphicon glyphicon-pushpin"></span> <span class="visible-lg">排序</span>
                                </th>
                                <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categorys as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->route}}</td>
                                <td>{{$category->sort}}</td>
                                <td>
                                    <a href="{{url('/admin/categorys/'.$category->id.'/edit')}}">修改</a>
                                    <a type="button" class="btn category-audit" cate-id="{{$category->id}}" cate-action-status="-1">删除</a>
                                </td>
                            </tr>
                          @endforeach
                            </tbody>
                        </table>
                        <span class="prompt-text"><strong>注：</strong>删除一个栏目也会删除栏目下的文章和子栏目,请谨慎删除!</span></div>
                </div>
            </section>
    </div>
@endsection