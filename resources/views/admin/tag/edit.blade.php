@extends('admin/layout/main')
@section('content')
    <div class="content-wrapper">

        <section class="content">
            <div class="row">
                <div class="col-lg-10 col-xs-6">
                    <div class="box">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">修改标签</h3>
                            </div>
                            <form role="form" action="{{url('/admin/tags/'.$tag->id.'/editStore')}}" method="POST">
                                {{csrf_field()}}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label >标签名</label>
                                        <input type="text" class="form-control" value="{{$tag->name}}" name="name">
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">提交</button>
                                </div>
                            </form>
                        </div>
                        @include('layout.error')
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
