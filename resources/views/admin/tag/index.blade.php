@extends('admin.layout.main')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row col-sm-9 col-sm-offset-3 col-md-10 col-lg-6 col-md-offset-0 main" id="main">
                <form action="/Article/checkAll" method="post" >
                    <h1 class="page-header">操作</h1>
                    <a href="{{url('/admin/tags/create')}}">
                        <ol class="breadcrumb button-add-all 	glyphicon glyphicon-plus">
                            <li>增加标签</li>
                        </ol>
                    </a>
                    <h1 class="page-header">管理 <span class="badge"></span></h1>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th ><span class=" glyphicon glyphicon-th"></span> <span class="visible-lg">标签ID</span></th>
                                <th><span class="glyphicon glyphicon-file"></span> <span class="visible-lg ">标题</span></th>
                                <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $tag)
                                <tr>
                                    <td>{{$tag->id}}</td>
                                    <td class="article-title">{{$tag->name}}</td>

                                    {{--<td class="hidden-sm"></td>--}}
                                    <td>
                                        <a  class="btn  post-audit" href="{{url('/admin/tags/'.$tag->id.'/edit')}}"  >修改 </a>
                                        <a rel="{{$tag->id}}">删除</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <footer class="message_footer">
                        <nav>
                           {{-- <div class="btn-toolbar operation" role="toolbar">
                                <div class="btn-group" role="group"> <a class="btn btn-default" onClick="select()">全选</a> <a class="btn btn-default" onClick="reverse()">反选</a> <a class="btn btn-default" onClick="noselect()">不选</a> </div>
                                <div class="btn-group" role="group">
                                    <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="bottom"  name="checkbox_delete">删除</button>
                                </div>
                            </div>--}}
                            <div class="pagenav">
                                {{ $tags->links() }}
                                <p class="showpage">显示第 {{$tags->firstItem()}} 条到第 {{$tags->lastItem()}} 条记录,总共{{$tags->total()}}条记录 每页显示 {{$tags->count()}} 条</p>
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
            float: left;
            margin-right: -533px;
        }
        .showpage{
            /*background-color: yellowgreen;*/
            float: right;
            width: auto;
            align-content: center;
            height: 25px;
            /*margin-right: 168px;*/
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
        $(function (e) {
           var evt = e|| window.event;
            $("#main table tbody tr td a").click(function () {
                var name = $(this);
                var id = name.attr("rel"); //对应id
                    if (window.confirm("此操作不可逆，是否确认？")) {
                        $.ajax({
                            type: "POST",
                            url: "/admin/tags/"+id+"/delete",
                            // data: "id=" + id,
                            cache: false, //不缓存此页面
                            success: function (data) {
                                alert(data.msg);
                                window.location.reload();
                            }
                        });
                };
            });
        });
    </script>
@endsection