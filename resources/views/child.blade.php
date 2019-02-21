{{--resource/views/child.blade.php--}}
@extends('layoutsbak-------.app')

@section('title','laravel')

<title>
    @hasSection('title')
        @yield('title') - App Name
    @else
        App Name
    @endif
</title>

@section('sidebar')
    @parent
    <p>这里是laravel child sidebar</p>
@endsection

@section('content')
    <p>这里body主体</p>

    @if($records===1)
     I have one recard.
    @elseif($records>1)
     I have two cards;
    @else
     I have not card.
    @endif
    <br>
    @unless($records===1)
    my card is one.
    @endunless

    <br>
    @isset($records22)
    isset is defind.
    @endisset

    @empty($records2)
        card is empty.
    @endempty

@endsection

@section('navigation')
    <ul><li>导航1</li><li>导航1</li></ul>
@endsection

@hasSection('navigation')
 <div class="pull-right">
     @yield('navigation')
 </div>
@else
    <div class="clearfix"> Have not navigation</div>
@endif

@switch($i)
    @case(1)
    <p>case value 1</p>
    @break

    @case(2)
    <p>case value 2</p>
    @break

    @default
    default value 0.
@endswitch

@for($j=0;$j<10;$j++)
value= {{$j}}&nbsp;&nbsp;.
@endfor

@php
var_dump('ddd');

@endphp


{{--组件方式1--}}
{{--@component('components.alert',['foo'=>'bar'])
    <strong> laravel wrong!</strong>
    @slot('title')
        forbidden
    @endslot
@endcomponent--}}

{{--组件方式2--}}
@alert(['type'=>'danger'])
    @slot('title')
        forbidden
    @endslot
    <p>这里是重命名后的alert组件</p>
来个时间戳：{{time()}}
<br>

{{isset($name)?$name:'default默认值'}}

{{$age or 'default默认值2'}}

@endalert()

<script>
    var app =@@json($array);
</script>