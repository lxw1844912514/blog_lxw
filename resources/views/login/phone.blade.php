<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

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

    {{--<script src="/js/lib/laravel-sms.js"></script>--}}
</head>

<body>

<div class="container">

    <form class="form-signin" method="POST" action="/sendsms">
        {{csrf_field()}}
        <h2 class="form-signin-heading">手机快速登录 <a href="/login"><h5 style="float: right">账号密码登录</h5></a></h2>
        <label for="inputEmail" class="sr-only">手机号</label>
        <input type="text" name="tel" id="tel" value="{{ old('tel') }}" class="form-control" placeholder="请输入手机号" required
               autofocus>
        <input type="submit" class="btn btn-lg btn-primary" onclick="send(this)" id="sendVerifySmsButton" value="发送短信"
               style="float: right">
    </form>

    <form class="form-signin" method="POST" action="/phone/login">
        {{csrf_field()}}
        <label for="inputPassword" class="sr-only">验证码</label>
        <input type="text" name="verify" value="" id="" class="form-control" placeholder="请输入验证码" required>
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
            <a href="/auth/weibo"><img src="/storage/photo/240.png" alt="微博登录"></a>
            <a href="/auth/qq"><img src="/storage/photo/Connect_logo_4.png" alt="QQ登录"></a>
        </div>
        @include('layout.error')

        <button class="btn btn-lg btn-primary btn-block" type="submit">登陆</button>
        <a href="/registers" class="btn btn-lg btn-primary btn-block" type="submit">去注册>></a>
    </form>

</div> <!-- /container -->

</body>
<script>
    var time = 10;

    function send(_this) {
        if (time == 0) {
            _this.removeAttribute('disabled');
            _this.value = '发送短信';
            time = 10;
            return;
        } else {
            _this.setAttribute('disabled', true);
            _this.value = '重新发送（' + time + 's)';
            time--;
        }

        setTimeout(function () {
            send(_this);
        }, 1000);
    }
</script>
<script>
    function duanxin() {
        //获取手机ID
       /* var iphone = $("#tel").val();
        console.log(iphone);
        $.ajax({
            url: '/sendsms',
            data: {'tel': iphone},
            type: "post",
            dataType: "Json",
            success: function (msg) {
                if (msg['stat'] == '100') {
                    alert('短信发送成功了');
                } else {
                    alert('短信发送失败了');
                }
            }
        });*/
        /*//获取手机ID
                var iphone = $("#regi_mobile").val();
                $.ajax({
                    url: 'registers',
                    data: {'iphone': iphone},
                    type: "GET",
                    dataType: "Json",
                    success: function (msg) {
                        if (msg['stat'] == '100') {
                            alert('短信发送成功了');
                        } else {
                            alert('短信发送失败了');
                        }
                    }
                });*/
    }
</script>

<script>
     $('#sendVerifySmsButton').sms({
         //laravel csrf token
         token: "{{csrf_token()}}",
        //请求间隔时间
        interval: 60,
        //请求参数
        requestData: {
            //手机号
            mobile: function () {
                return '18231857001';
            },
            //手机号的检测规则
            // mobile_rule : 'mobile_required'
        }
    });
</script>
</html>
