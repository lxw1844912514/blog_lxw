<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>青春阳光的博客-@yield('title')</title>
    <script src="http://www.welltrend.com.cn/Public/Home/New/js/jquery.min.1.83.js"></script>
</head>
<body>
@section('sidebar')
    这里是侧边栏
@show

{{--@section('navigation')
    <ul><li>导航1</li><li>导航1</li><li>导航1</li><li>导航1</li></ul>
@show--}}
    <div class="container">
        @yield('content')
    </div>

</body>
</html>