@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <section class="content">

        {{--<div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">文章列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>文章标题</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>

                           @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->created_at}}</td>
                                <td>
                                    <button type="button" class="btn  post-audit" post-id="{{$post->id}}" post-action-status="1" >通过</button>
                                    <button type="button" class="btn  post-audit" post-id="{{$post->id}}" post-action-status="-1" >拒绝</button>
                                </td>
                            </tr>
                            @endforeach
                            未审核文章总数:<tr>22</tr>
                            </tbody></table>
                        {{$posts->links()}}
                    </div>

                </div>
            </div>
        </div>--}}

        <div class="row col-sm-9 col-sm-offset-3 col-md-10 col-lg-12 col-md-offset-0 main" id="main">
            <form action="/Article/checkAll" method="post" >
                <h1 class="page-header">操作</h1>
                <a href="{{url('/admin/posts/create')}}">
                    <ol class="breadcrumb button-add-all 	glyphicon glyphicon-plus">
                        <li>增加文章</li>
                    </ol>
                </a>
                <h1 class="page-header">管理 <span class="badge">{{$posts->total()}}</span></h1>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">选择</span></th>
                            <th ><span class=" glyphicon glyphicon-th"></span> <span class="visible-lg">文章ID</span></th>
                            <th><span class="glyphicon glyphicon-file"></span> <span class="visible-lg ">标题</span></th>
                            <th><span class="glyphicon glyphicon-list"></span> <span class="visible-lg">栏目</span></th>
                            <th class="hidden-sm"><span class="glyphicon glyphicon-tag"></span> <span class="visible-lg">标签</span></th>
                            <th class="hidden-sm"><span class=" glyphicon glyphicon-eye-open"></span> <span class="visible-lg">浏览量</span></th>
                            <th class="hidden-sm"><span class="glyphicon glyphicon-comment"></span> <span class="visible-lg">评论</span></th>
                            <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">日期</span></th>
                            <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td><input type="checkbox" class="input-control" name="checkbox[]" value=""/></td>
                                <td>{{$post->id}}</td>
                                <td class="article-title">{{$post->title}}</td>
                                <td class="hidden-sm">{{$post->categorys['name']}}</td>
                                <td class="hidden-sm">
                                    @forelse($post->tags as $tag)
                                            <b>{{$tag->name}}</b>
                                        @empty
                                            <b>暂无标签</b>
                                    @endforelse
                                </td>
                                <td class="hidden-sm">{{$post->view_count}}</td>
                                <td class="hidden-sm">{{$post->comments->count()}}</td>
                                <td>{{$post->created_at}}</td>
                                <td>
                                    <a  class="btn  post-audit" href="{{url('/admin/posts/'.$post->id.'/edit')}}"  >修改 </a>
                                    <a rel="6">删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <footer class="message_footer">
                    <nav>
                        <div class="btn-toolbar operation" role="toolbar">
                            <div class="btn-group" role="group"> <a class="btn btn-default" onClick="select()">全选</a> <a class="btn btn-default" onClick="reverse()">反选</a> <a class="btn btn-default" onClick="noselect()">不选</a> </div>
                            <div class="btn-group" role="group">
                                <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="bottom"  name="checkbox_delete">删除</button>
                            </div>
                        </div>
                        <div class="pagenav">
                            <p class="showpage">显示第 {{$posts->firstItem()}} 条到第 {{$posts->lastItem()}} 条记录,总共{{$posts->total()}}条记录 每页显示 {{$posts->count()}} 条</p>{{ $posts->links() }}
                        </div>
                    </nav>
                </footer>
            </form>
        </div>

    </section>
</div>
<style>
    .pagenav ul {

        display: inline-block;
        float: right;
        margin-right: -533px;
    }
    .showpage{
        /*background-color: yellowgreen;*/
        float: right;
        width: 35%;
        align-content: center;
        height: 25px;
        margin-right: 168px;
        padding-top: 27px;
    }
    .operation {

        display: inline-block;
        float: left;
        margin: 10px 0;

    }
    .button-add-all{
        width: 116px;

        background-color: yellowgreen;
    }
</style>
@endsection
@section('script')
    <script>
        //是否确认删除
        $(function () {
            $("#main table tbody tr td a").click(function () {
                var name = $(this);
                var id = name.attr("rel"); //对应id
                if (event.srcElement.outerText == "删除") {
                    if (window.confirm("此操作不可逆，是否确认？")) {
                        $.ajax({
                            type: "POST",
                            url: "/Article/delete",
                            data: "id=" + id,
                            cache: false, //不缓存此页面
                            success: function (data) {
                                window.location.reload();
                            }
                        });
                    }
                    ;
                }
                ;
            });
        });
    </script>
@endsection