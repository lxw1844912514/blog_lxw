@extends('admin.layout.main')
@section('content')
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-10 col-xs-6">
                    <div class="box">

                        <!-- /.box-header -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">修改用户</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" action="/admin/users/{{$user->id}}/edit" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">用户名</label>
                                        <input type="text" class="form-control" name="name" value="{{$user->name}}" required autofocus>
                                    </div>
                                    {{--<div class="form-group">
                                        <label for="exampleInputPassword1">密码</label>
                                        <input type="password" class="form-control" placeholder="Password"
                                               name="password" required autofocus>
                                    </div>--}}
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">邮箱</label>
                                        <input type="email" class="form-control" placeholder="email" value="{{$user->email}}" name="email"
                                               required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">头像</label>
                                        <input class="file-loading preview_input" type="file" name="avatar">
                                        <img  class="preview_img" src="{{$user->avatar}}" alt=""  style="border-radius:500px;">
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">提交</button>
                                </div>
                            </form>
                            @include('layout.error')
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection