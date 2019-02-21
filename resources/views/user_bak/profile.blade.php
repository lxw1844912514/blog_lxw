<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
{{--{{dd($user)}}--}}

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

{{--{{dd($person)}}--}}
{{--{{$list}}--}}
{{--{{$page}}--}}
<div class="container">
    @foreach($page as $p)
       <ul>
          <p> <li> {{$p->id}}</li><li> {{$p->name}}</li><li> {{$p->email}}</li></p>
       </ul>
    @endforeach
</div>
{{$page->appends(['sort'=>'id'])->links()}}
{{$page->fragment('foo')->links()}}
<p>currentPage:{{$currentPage}}</p>
<p>morePage:{{$morePage}}</p>
<p>lastItem:{{$lastItem}}</p>
<p>url:{{$url}}</p>
<p>total:{{$total}}</p>
</body>
</html>