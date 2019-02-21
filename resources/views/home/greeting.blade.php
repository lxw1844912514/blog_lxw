<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h1>Hi! {{$name}}</h1>
<p>@lang('messages.welcome')</p>
<p>{{__('messages.welcome')}}</p>
<p>{{__('messages.greet',['name'=>'lxw'])}}</p>
</body>
</html>