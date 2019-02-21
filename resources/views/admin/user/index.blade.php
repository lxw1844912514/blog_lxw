@extends('admin.layout.main')
@section('content')
    <!-- Main content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-lg-10 col-xs-6">
                    <div class="box">

                        <div class="box-header with-border">
                            <h3 class="box-title">用户列表</h3>
                        </div>
                        <a type="button" class="btn " href="/admin/users/create">增加用户</a>
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>用户名称</th>
                                    <th>操作</th>
                                </tr>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>
                                            @if($user->id !=1)
                                                <a type="button" class="btn"
                                                   href="/admin/users/{{$user->id}}/role">角色管理</a>
                                                <a type="button" class="btn"
                                                   href="/admin/users/{{$user->id}}/edit">编辑</a>
                                                <a type="button" class="btn  user-audit" user-id="{{$user->id}}"
                                                   user-action-status="-1">删除</a>
                                                <a type="button" class="btn"
                                                   href="/admin/users/{{$user->id}}/resetPassword">重置密码</a>
                                            @else
                                                @if($admin->name=='admin')
                                                    <a type="button" class="btn"
                                                       href="/admin/users/{{$user->id}}/role">角色管理</a>
                                                    <a type="button" class="btn"
                                                       href="/admin/users/{{$user->id}}/edit">编辑</a>
                                                    <a type="button" class="btn  user-audit" user-id="{{$user->id}}"
                                                       user-action-status="-1">删除</a>
                                                    <a type="button" class="btn"
                                                       href="/admin/users/{{$user->id}}/resetPassword">重置密码</a>
                                                @endif
                                                

                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$users->links()}}
                        </div>

                    </div>
                </div>
            </div>
            @include('admin.layout.footer')
        </section>
    </div>
    <!-- Main content -->
@endsection