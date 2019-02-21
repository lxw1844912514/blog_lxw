<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>后台登录</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/adminlte/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/font-awesome.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="/adminlte/plugins/iCheck/square/blue.css">
    <!--[if lt IE 9]>
    <script src="/adminlte/dist/js/html5shiv.min.js"></script>
    <script src="/adminlte/dist/js/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="">博客管理后台</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">登陆</p>
        <form action="/admin/login" method="post">
            {{csrf_field()}}
            <div class="form-group has-feedback">
                <input name="name" type="text" class="form-control" placeholder="名字">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input name="password" type="password" class="form-control" placeholder="密码">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input name="captcha" type="text" style="width: 228px;display: block;"
                       class="form-control {{$errors->has('captcha')?'parsley-error':''}}" placeholder="验证码">
                <span class="glyphicon  captcha-span"><img class=" thumbnail captcha" style="cursor: pointer;height: 37px;margin-right: 20px;margin-left: -58px;" src="{{captcha_src('flat')}}"
                                                                    onclick="this.src='{{captcha_src('flat')}}'+Math.random()"
                                                                    alt="验证码" title="点击图片重新获取验证码">
</span>

            </div>
            @include('layout.error')
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">登陆</button>
                </div>
            </div>
        </form>

    </div>
</div>
<!-- /.login-box -->

<script src="/adminlte/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="/adminlte/bootstrap/js/bootstrap.min.js"></script>
<script src="/adminlte/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
