@extends('layout.main')
@section('content')

    <div class="col-sm-8 blog-main">
        <form class="form-horizontal" action="/user/{{\Auth::id()}}/updatePassword" method="POST"
              enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label class="col-sm-2 control-label">绑定邮箱</label>
                <div class="col-sm-10">
                    <input class=" form-control" name="email" type="email" value="{{$user->email}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">密码</label>
                <div class="col-sm-10">
                    <input class=" form-control" name="password" type="password" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">确认密码</label>
                <div class="col-sm-10">
                    <input class=" form-control" name="password_confirmation" type="password" value="">
                </div>
            </div>
            <button type="submit" class="btn btn-default">修改密码</button>

        </form>
        @include('layout.error')
        <br>

    </div>


@endsection