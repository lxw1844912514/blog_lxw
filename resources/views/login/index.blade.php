<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('/favicon.ico')}}">

    <title>登陆</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="http://v3.bootcss.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://v3.bootcss.com/examples/signin/signin.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">

    <form class="form-signin" method="POST" action="/login">
        {{csrf_field()}}
        <h2 class="form-signin-heading">请登录 <a href="{{url('/phone')}}"><h5 style="float: right">手机快速登录</h5></a></h2>
        <label for="inputEmail" class="sr-only">邮箱</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required
               autofocus>
        <label for="inputPassword" class="sr-only">密码</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="1" name="is_remember"> 记住我
            </label>

            {{--<a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>--}}
            <a class="btn btn-link" href="password/reset">
                {{ __('Forgot Your Password?') }}
            </a>
            <a href="{{url('/auth/weibo')}}"><img src="{{asset('/storage/photo/240.png')}}" alt="微博登录"></a>
            <a href="{{url('/auth/qq')}}"><img src="{{asset('/storage/photo/Connect_logo_4.png')}}" alt="QQ登录"></a>
        </div>
        @include('layout.error')

        <button class="btn btn-lg btn-primary btn-block" type="submit">登陆</button>
        <a href="{{url('/registers')}}" class="btn btn-lg btn-primary btn-block" type="submit">去注册>></a>
    </form>

</div> <!-- /container -->

</body>
</html>
