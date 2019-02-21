@extends('admin.layout.main')
@section('content')
    <div class="content-wrapper">
        <section class="content">
                <div class="row">
                    <div class="col-md-7">
                        <a href="{{'/admin/categorys'}}">
                            <ol class="breadcrumb button-add-all  	glyphicon glyphicon-chevron-left">
                                <li>返回</li>
                            </ol>
                        </a>
                        <h1 class="page-header">修改栏目</h1>
                        <form action="{{url('/admin/categorys/'.$category->id.'/editStore')}}" method="post" autocomplete="off">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="category-name">栏目名称</label>
                                <input type="text" id="category-name" name="name" class="form-control"
                                       placeholder="在此处输入栏目名称" required autocomplete="off" value="{{$category->name}}">
                                <span class="prompt-text">这将是它在站点上显示的名字。</span></div>
                            <div class="form-group">
                                <label for="category-alias">路由</label>
                                <input type="text" id="category-alias" name="route" class="form-control"
                                       placeholder="在此处输入栏目路由" required autocomplete="off" value="{{$category->route}}">
                                <span class="prompt-text">“别名”是在URL中使用的别称，它可以令URL更美观。通常使用小写，只能包含字母，数字和连字符（-）。</span>
                            </div>
                            <div class="form-group">
                                <label for="category-fname">父节点</label>
                                <select id="category-fname" class="form-control" name="pid">
                                    <option value="0" selected>无</option>
                                    @foreach($categorys as $cate)
                                    <option value="{{$cate->id}}">{{$cate->name}}</option>
                                    @endforeach
                                </select>
                                <span class="prompt-text">栏目是有层级关系的，您可以有一个“音乐”分类目录，在这个目录下可以有叫做“流行”和“古典”的子目录。</span>
                            </div>
                            <div class="form-group">
                                <label for="category-keywords">排序</label>
                                <input type="text" id="category-keywords" name="sort" class="form-control"
                                       placeholder="在此处输入栏目排序" autocomplete="off" value="{{$category->sort}}">
                                <span class="prompt-text">排序会改变前台页面显示。</span>
                            </div>
                            <div class="form-group">
                                <label for="category-describe">描述</label>
                                <textarea class="form-control" id="category-describe" name="describe" rows="4"
                                          autocomplete="off">{{$category->desc}}</textarea>
                                <span class="prompt-text">描述会出现在网页的description属性中。</span></div>
                            <button class="btn btn-primary" type="submit" name="submit">修改栏目</button>
                        </form>
                        @include('layout.error')
                    </div>
                </div>
        </section>
    </div>
@endsection
