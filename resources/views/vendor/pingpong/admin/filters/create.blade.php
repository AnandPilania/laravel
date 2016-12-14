@extends('vendor.pingpong.admin.layouts.master')
@section('content')
<div class="panel panel-transparent">
  <div class="panel-heading">
    <div class="panel-title">Create new 
    </div>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-10">

      <form id="aboutus" class="form-horizontal form_validate" role="form" autocomplete="off"  action="{{ URL::route('admin.filters.store') }}" method="POST" enctype="multipart/form-data">

      <div class="form-group">
        <label for="title" class="col-sm-3 control-label">Title</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" name="title" required value="{{old('title')}}">
        </div>
      </div>

      <input type="hidden" name="_method" value="POST"></input>
      <input type="hidden" name="_token" value="{{csrf_token()}}"></input>
      <input type="submit" value="Submit" class="btn btn-primary pull-right"></input>
      </form>
@stop
 
