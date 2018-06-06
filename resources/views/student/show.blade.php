@extends('layouts.default')
@section('title','学生列表')

@section('content')
<ul>
@foreach($students as $v)
  <li>姓名:{{ $v->name }} - 性别:{{ getSex($v->sex) }} - 年龄:{{ $v->age }} </li>
@endforeach
</ul>
@stop
