@extends('layout.main')
@section('content')

    <div class="col-sm-8 blog-main">
        @foreach($notices as $notice)
            <div class="blog-post">
                <p class="blog-post-meta">{{$notice->title}}</p>

                <p>{!! str_limit($notice->content,100,'...') !!}</p>
            </div>
        @endforeach
    </div><!-- /.blog-main -->
@endsection


