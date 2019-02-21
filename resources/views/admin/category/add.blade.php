@extends('admin.layout.main')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            {{--<div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main">--}}
                <div class="row">
                    <div class="col-md-7">
                        <a href="{{'/admin/categorys'}}">
                            <ol class="breadcrumb button-add-all  	glyphicon glyphicon-chevron-left">
                                <li>返回</li>
                            </ol>
                        </a>
                        <h1 class="page-header">添加栏目</h1>
                        <form action="{{url('/admin/categorys/store')}}" method="post" autocomplete="off">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="category-name">栏目名称</label>
                                <input type="text" id="category-name" name="name" class="form-control"
                                       placeholder="在此处输入栏目名称" required autocomplete="off">
                                <span class="prompt-text">这将是它在站点上显示的名字。</span></div>
                            <div class="form-group">
                                <label for="category-alias">路由</label>
                                <input type="text" id="category-alias" name="route" class="form-control"
                                       placeholder="在此处输入栏目路由" required autocomplete="off">
                                <span class="prompt-text">“别名”是在URL中使用的别称，它可以令URL更美观。通常使用小写，只能包含字母，数字和连字符（-）。</span>
                            </div>
                            <div class="form-group">
                                <label for="category-fname">父节点</label>
                                <select id="category-fname" class="form-control" name="pid">
                                    <option value="0" selected>无</option>
                                    @foreach($categorys as  $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <span class="prompt-text">栏目是有层级关系的，您可以有一个“音乐”分类目录，在这个目录下可以有叫做“流行”和“古典”的子目录。</span>
                            </div>
                            {{--<div class="form-group">
                                <label for="category-keywords">关键字</label>
                                <input type="text" id="category-keywords" name="keywords" class="form-control"
                                       placeholder="在此处输入栏目关键字" autocomplete="off">
                                <span class="prompt-text">关键字会出现在网页的keywords属性中。</span>
                            </div>--}}
                            <div class="form-group">
                                <label for="category-describe">描述</label>
                                <textarea class="form-control" id="category-describe" name="describe" rows="4"
                                          autocomplete="off"></textarea>
                                <span class="prompt-text">描述会出现在网页的description属性中。</span></div>
                            <button class="btn btn-primary" type="submit" name="submit">添加新栏目</button>
                        </form>
                        @include('layout.error')
                    </div>
                </div>
            {{--</div>--}}
        </section>
    </div>
@endsection
