<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<h1>Create Post</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Create Post Form -->

<form  class="align-content-center" method="POST" action="{{'store'}}">
    {{csrf_field()}}
    <p> 标题： <input type="text" name="title"/> </p>
    <p>姓名： <input type="text" name="author[name]"/></p>
    <p>描述：<input type="text" name="author[desc]"/></p>
    <p> 内容：<textarea cols="20" rows="5" name="body"></textarea></p>
    <p><button type="submit">submit</button></p>
</form>
</body>
</html>