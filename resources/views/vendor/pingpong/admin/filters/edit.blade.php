@extends('vendor.pingpong.admin.layouts.master')
@section('content')<div class="panel panel-transparent">

  <div class="panel-heading">
    <div class="panel-title">
    </div>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-10">

        <form id="aboutus" class="form-horizontal" role="form" autocomplete="off" novalidate action="{{ URL::to('admin/filters')}}/{{$edit->id}}" method="POST" enctype="multipart/form-data">
        <!--  <div class="form-group">
            <label for="id" class="col-sm-3 control-label">ID</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="name" required value="{{$edit->id}}">
            </div>
          </div> -->
              <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="name" required value="{{$edit->name}}">
            </div>
          </div>
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button class="btn btn-success pull-right" type="submit">Update</button>
          <a class="btn btn-default" href="{{ URL::to('admin/filters') }}"><i class="fa fa-undo"></i> Cancel</a>
</form>
@stop


       
      