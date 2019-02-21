<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>博客后台管理系统</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/adminlte/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="/adminlte/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="/adminlte/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="/adminlte/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!--[if lt IE 9]>
    <script src="/adminlte/dist/js/html5shiv.min.js"></script>
    <script src="/adminlte/dist/js/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
    @include('admin.layout.header')
    @include('admin.layout.sidebar')
    @yield('content')

    <div class="control-sidebar-bg"></div>
</div>

<script src="{{asset('/adminlte/plugins/jQuery')}}/jquery-2.2.3.min.js"></script>
@yield('script')
<script src="{{asset('/adminlte/dist/js')}}/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="/adminlte/bootstrap/js/bootstrap.min.js"></script>
<script src="/adminlte/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="/adminlte/plugins/knob/jquery.knob.js"></script>
<script src="/adminlte/dist/js//moment.min.js"></script>
<script src="/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<script src="/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="/adminlte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="/adminlte/plugins/fastclick/fastclick.js"></script>
<script src="/js/admin.js"></script>
<script src="/js/admin-script.js"></script>
</body>
</html>
