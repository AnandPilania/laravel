@extends('vendor.pingpong.admin.layouts.master')
@section('content')
<div class="panel panel-transparent">
  <div class="panel-heading">
    <div class="panel-title">
    </div>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-10">

        <form id="aboutus" class="form-horizontal" role="form" autocomplete="off" novalidate action="{{ URL::to('admin/comments')}}/{{$edit->id}}" method="POST" enctype="multipart/form-data">
        <!--  <div class="form-group">
            <label for="id" class="col-sm-3 control-label">ID</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="name" required value="{{$edit->id}}">
            </div>
          </div> -->
              <div class="form-group">
            <label for="comments" class="col-sm-3 control-label">Comment</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="ckeditor" name="comments" required value="{{$edit->comments}}">
            </div>
          </div>
           <div class="form-group">
            <label for="publish" class="col-sm-3 control-label">Publish</label>
            <div class="col-sm-9">
            <select name="publish" class="form-control">
        <option value="{{$edit->publish}}">Select Publish</option>
        <option value="1">yes</option>
         <option value="0">No</option>
        </select>
              
            </div>
          </div>
  
          <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="btn btn-success" type="submit">Update</button>
                <a class="btn btn-default" href="{{ URL::to('admin/comments') }}"><i class="fa fa-undo"></i> Cancel</a>
</form>
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script> 
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>

  
  <script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
  </script>



<!-- Employee creation form ends here -->
 <script type="text/javascript">
  $('#aboutus').validate({
    rules: {
      
      password: {
        required: true,
        //min: 6
      },
      confirmpassword: {
        equalTo: "#password"
      }
  }
  });

</script>

@stop
       
      