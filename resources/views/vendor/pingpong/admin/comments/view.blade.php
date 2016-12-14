@extends('vendor.pingpong.admin.layouts.master')
@section('content')
<p>Id:{{$data->id}}</p>
<p>Name:{{$data->comments}}</p>
<p>Publish:{{$data->publish}}</p>

<a class="btn btn-default" href="{{ URL::to('admin/comments') }}"><button type="submit" class="btn btn-primary">Cancel</button></a>

@stop

