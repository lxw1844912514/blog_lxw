<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>博客-@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="{{asset('/css/blog.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/wangEditor.min.css')}}">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src=''></script>
    <script src="{{asset('/js/respond.min.js')}}"></script>
    <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>

    <![endif]-->
</head>

<body>

@include('layout.nav')
<div class="container">
    @section('time')
        <div class="blog-header">
            {{date('Y-m-d H:i:s',time())}}
        </div>
    @show
    <div class="row">
        @yield('content')

        @include('layout.sidebar')
    </div>
</div><!-- /.row -->
</div><!-- /.container -->

@include('layout.footer')
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/wangEditor.min.js')}}"></script>
<script src="{{asset('/js/ylaravel.js')}}"></script>

</body>
</html>
