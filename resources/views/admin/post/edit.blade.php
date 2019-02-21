@extends('admin.layout.main')
@section('script')
    <!-- 配置文件 -->
    <script type="text/javascript" src="{{asset('ueditor-php/ueditor.config.js')}}"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="{{asset('ueditor-php/ueditor.all.js')}}"></script>
    <script id="uploadEditor" type="text/plain"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container', {

            autoHeightEnabled: true,
            // autoFloatEnabled: false,
            minFrameHeight:200,
            scaleEnabled:true,
            // tabNode:'青春阳光',
            // tabSize:1,
            initialFrameHeight:380,
            focus:true,
            // fullscreen:true
            // toolbarTopOffset:200
        });
        window.onresize=function(){
            window.location.reload();
        }

        var _uploadEditor;
        $(function () {
            //重新实例化一个编辑器，防止在上面的editor编辑器中显示上传的图片或者文件
            _uploadEditor = UE.getEditor('uploadEditor');
            _uploadEditor.ready(function () {
                //设置编辑器不可用
                //_uploadEditor.setDisabled();
                //隐藏编辑器，因为不会用到这个编辑器实例，所以要隐藏
                _uploadEditor.hide();
                //侦听图片上传
                _uploadEditor.addListener('beforeInsertImage', function (t, arg) {
                    //将地址赋值给相应的input,只去第一张图片的路径
                    $("#pictureUpload").attr("value", arg[0].src);
                    //图片预览
                    //$("#imgPreview").attr("src", arg[0].src);
                })
                //侦听文件上传，取上传文件列表中第一个上传的文件的路径
                _uploadEditor.addListener('afterUpfile', function (t, arg) {
                    $("#fileUpload").attr("value", _uploadEditor.options.filePath + arg[0].url);
                })
            });
        });
        //弹出图片上传的对话框
        $('#upImage').click(function () {
            console.log('dd');
            var myImage = _uploadEditor.getDialog("insertimage");
            myImage.open();
        });
        //弹出文件上传的对话框
        function upFiles() {
            var myFiles = _uploadEditor.getDialog("attachment");
            myFiles.open();
        }
    </script>
    <script type="text/javascript" src="{{asset('/adminlte/plugins/datetimepicker/js/bootstrap-datetimepicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('/adminlte/plugins/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js')}}"></script>
        {{-- 时间插件--}}
    <script type="text/javascript">
        $(".form_datetime").datetimepicker({
            format: "yyyy-mm-dd hh:ii:ss", //显示日期格式
            autoclose: true,
            todayBtn: true,
            showMeridian: true,
            minView: "day",//只选择到天自动关闭
            language: 'zh-CN',
        });

    </script>
    {{--标签插件--}}
    <script src="{{asset('/adminlte/plugins/tags/bootstrap-tagsinput.js')}}"></script>
    <script>
       var items= $(".tags").tagsinput('items');
       console.log($(".tags").val());
    </script>
@endsection
@section('content')

    <link href="{{asset('/adminlte/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('/adminlte/plugins/tags/bootstrap-tagsinput.css')}}" rel="stylesheet">

    <div class="content-wrapper" style=" min-height:125%">
        <section class="content">
            <div class="row col-sm-9 col-sm-offset-3 col-md-10 col-lg-12 col-md-offset-0 main" id="main">
                <div class="row">
                    <form action="{{url('/admin/posts/'.$post->id.'/update')}}" method="post" class="add-article-form">
                        {{csrf_field()}}
                        <div class="col-md-9">
                            <h1 class="page-header">文章修改</h1>
                            <div class="form-group">
                                <label for="article-title" class="">标题</label>
                                <input type="text" id="article-title" name="title" class="form-control"
                                       placeholder="在此处输入标题" value="{{$post->title}}" required
                                       autofocus autocomplete="off">
                            </div>
                            <!-- 加载编辑器的容器 -->
                            <div class="form-group">
                                <label for="article-content" class="">内容</label>
                                    <script id="container" name="body" type="text/plain">
                                        {!!$post->body!!}
                                    </script>
                            </div>

                            <div class="add-article-box">
                                <label for="article-content" class="">关键字</label>
                                <div class="add-article-box-content">
                                    <input type="text" class="tags form-control" name="keyword" placeholder="请输入关键字"data-role="tagsinput" value="{{$post->keyword}}" autocomplete="off">
                                    <span class="prompt-text">多个关键字请用Tab键隔开。</span>
                                </div>
                            </div>
                            <div class="add-article-box">
                                <h2 class="add-article-box-title"><span>描述</span></h2>
                                <div class="add-article-box-content">
                                    <textarea class="form-control" name="describe" autocomplete="off">{{$post->desc}}</textarea>
                                    <span class="prompt-text">描述是可选的手工创建的内容总结，并可以在网页描述中使用</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h1 class="page-header">操作</h1>
                            <div class="add-article-box">
                                <h2 class="add-article-box-title"><span>栏目</span></h2>
                                <div class="add-article-box-content">
                                    <select id="category-fname" class="form-control" name="pid">

                                        @foreach($categorys as  $category)
                                            @if($category->id == $post->cid)
                                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                            @else
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="add-article-box">
                                <h2 class="add-article-box-title"><span>标签</span></h2>
                                <div class="add-article-box-content">
                                    @foreach($tag_name as $tag)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="tag[]"
                                                       @if($tag_name->contains($tag))
                                                       checked
                                                       @endif
                                                       value="{{$tag->id}}">
                                                {{$tag->name}}
                                            </label>
                                        </div>
                                    @endforeach

                                    {{--<input type="text" class="tags form-control" name="tag" data-role="tagsinput" value="{{$tag_name}}">--}}
                            </div>
                            <div class="add-article-box">
                                <h2 class="add-article-box-title"><span>标题图片</span></h2>
                                <div class="add-article-box-content">
                                    <input type="text" class="form-control" placeholder="点击按钮选择图片" id="pictureUpload"
                                           name="titlepic" autocomplete="off">
                                </div>
                                <div class="add-article-box-footer">
                                    <button class="btn btn-default" type="button" ID="upImage">选择</button>
                                </div>
                            </div>
                            <div class="add-article-box">
                                <h2 class="add-article-box-title"><span>发布</span></h2>
                                <div class="add-article-box-content">
                                    {{--<p><label>状态：</label><span class="article-status-display">{{$post->status}}</span></p>--}}
                                    <p>
                                        <label>状态：</label>
                                        <input type="radio" name="status" value="1" @if($post->status == 1) checked @endif/>已发布
                                        <input type="radio" name="status" value="0" @if($post->status == 0) checked @endif/>未发布
                                    </p>

                                    {{--<p><label>发布于：</label>
                                        <span class="article-time-display">
                                            <input style="border: none;" type="datetime" name="time"
                                                    value="{{$post->created_at}}"/>
                                        </span>
                                    </p>--}}
                                    <div class="input-append date form_datetime">
                                        <label>发布于：</label>
                                        <input type="text" value="{{$post->created_at}}" name="time" readonly>
                                        <span class="add-on"><i class="icon-th"></i></span>
                                    </div>

                                </div>
                                <div class="add-article-box-footer">
                                    <button class="btn btn-primary" type="submit" name="submit">更新</button>
                                </div>
                                @include('layout.error')
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection