@extends('admin.layout.main')
@section('content')
    <div class="content-wrapper">
        <section class="content">

            <div class="row col-sm-9 col-sm-offset-3 col-md-10 col-lg-11 col-md-offset-1 main" id="main">
                <h1 class="page-header">信息总览</h1>
                <div class="row placeholders">
                    <div class="col-xs-6 col-sm-3 placeholder">
                        <h4>文章</h4>
                        <span class="text-muted">{{$posts}} 条</span></div>
                    <div class="col-xs-6 col-sm-3 placeholder">
                        <h4>评论</h4>
                        <span class="text-muted">{{$comments}} 条</span></div>
                    <div class="col-xs-6 col-sm-3 placeholder">
                        <h4>友链</h4>
                        <span class="text-muted">0 条</span></div>
                    <div class="col-xs-6 col-sm-3 placeholder">
                        <h4>访问量</h4>
                        <span class="text-muted">0</span></div>
                </div>
                <h1 class="page-header">状态</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tbody>
                        <tr>
                            <td>上次登录时间: {{$user['last_login_time']}} , 上次登录IP: {{$user['last_login_ip']}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <h1 class="page-header">系统信息</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr></tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>管理员个数:</td>
                            <td>{{$users}} 人</td>
                            <td>服务器软件:</td>
                            <td>{{ $_SERVER ['SERVER_SOFTWARE']  }}</td>
                        </tr>
                        <tr>
                            <td>浏览器:</td>
                            <td>{{$_SERVER['HTTP_USER_AGENT']}}</td>
                            <td>PHP版本:</td>
                            <td>{{ PHP_VERSION }}</td>
                        </tr>
                        <tr>
                            <td>操作系统:</td>
                            <td>{{ PHP_OS }}</td>
                            <td>PHP运行方式:</td>
                            <td>{{ PHP_SAPI }}</td>
                        </tr>
                        <tr>
                            <td>登录者IP:</td>
                            <td>{{get_Ip_Bypconline()}}</td>
                            <td>域名:</td>
                            <td>{{$_SERVER['HTTP_HOST']}}</td>

                        </tr>
                        <tr>
                            <td>MYSQL版本:</td>
                            <td>{{mysqli_get_server_info(mysqli_connect(env('DB_HOST'),env('DB_USERNAME'),env('DB_PASSWORD'))) }}</td>
                            <td>服务器语言:</td>
                            <td>{{$_SERVER['HTTP_ACCEPT_LANGUAGE']}}</td>
                        </tr>
                        <tr>
                            <td>最大执行时间:</td>
                            <td class="version">{{ get_cfg_var("max_execution_time")."秒 " }}</td>
                            <td>上传文件:</td>
                            <td>{{ get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许上传附件"  }} </td>
                        </tr>
                        <tr>
                            <td>程序编码:</td>
                            <td>UTF-8</td>
                            <td>当前时间:</td>
                            <td> {{date('Y-m-d H:i:s',time())}}</td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr></tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection