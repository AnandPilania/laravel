@extends('vendor.pingpong.admin.layouts.master')
@section('content')
<p>Id:{{$data->id}}</p>
<!-- <p>Filter_id:{{$data->filter_id}}</p> -->
<p>Title:{{$data->name}}</p>

<a class="btn btn-default" href="{{ URL::to('filters') }}"><button type="submit" class="btn btn-primary">Cancel</button></a>
@stop
