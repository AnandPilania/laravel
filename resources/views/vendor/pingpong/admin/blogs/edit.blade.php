@extends('vendor.pingpong.admin.layouts.master')
@section('content')
<div class="panel panel-transparent">
  <div class="panel-heading">
    <div class="panel-title">
    </div>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-12">

        <form id="aboutus" class=" form_validate" role="form" autocomplete="off" novalidate action="{{ URL::to('admin/blogs')}}/{{$edit->id}}" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="filter_id" class=" control-label">Filter id</label>
            <div class="">
            <select name="filter_id[]" class="form-control select2" required multiple>
            
            @foreach($data_filters as $data_filter)
           <option value="{{ $data_filter->id }}"
<?php
           if (in_array($data_filter->id, (array)$selected, true)) {
          echo  'selected="selected"' ;
          }
?>

           >{{ $data_filter->name}}</option>
            @endforeach
           </select>
           </div>

          </div>
              <div class="form-group">
            <label for="title" class=" control-label">Title</label>
            <div class="">
              <input type="text" class="form-control" name="title" required value="{{$edit->title}}">
            </div>
          </div>
          <div class="form-group">
            <label for="description" class=" control-label">Description</label>
            <div class="">
              <textarea name="description" id="ckeditor" class="form-control col-md-7 col-xs-12 summernote required"  cols="0" rows="0" >{{$edit->description}}</textarea> 
            </div>
          </div>
         
        <div class="form-group">
         <?php
$tags = json_decode($edit->tags);
//var_dump($tags);
if(count($tags)>0)
{
  $tagy="";
foreach($tags as $tag)
{
  $tagy.=$tag.",";
}
}
else{
  $tagy="";
}


          ?>
            <label for="tags" class=" control-label">Tags</label>
            <div class="">
              <input type="text" class="form-control" id="input-tags" name="tags" required value="{{$tagy}}">
            </div>
          </div>

           <div class="form-group">
            <label for="image" class=" control-label">Image</label>
            <div class="">
              <input type="file" class="form-control" name="image"  value="{{$edit->image}}">
            </div>
          </div>
          <!-- <div class="form-group">
            <label for="author_name" class=" control-label">Author name</label>
            <div class="">
            <select name="author_name" class="form-control selectauthor"  required>
            @foreach($users as $user)
           <option value="{{ $user->id }}">
           {{ $user->fname}}{{ $user->lname}}</option>
            @endforeach
           </select>
           </div>

          </div> -->
           <div class="form-group">
            <label for="author" class=" control-label">Author name</label>
            <div class="">
              <input type="text" class="form-control" name="author" required value="{{$edit->author}}">
            </div>
          </div>
           <div class="form-group">
            <label for="link" class=" control-label">Link</label>
            <div class="">
              <input type="url" class="form-control" name="link"  value="{{$edit->link}}">
            </div>
          </div>
          
    <div class="form-group">
            <label for="publish" class=" control-label">Publish</label>
            <div class="">
            <select name="publish" class="form-control" required>
        <option value="">Select Publish</option>
        <option value="1" 
        @if($edit->publish == 1)
        " selected "
        @endif
        >yes</option>
         <option value="0"
        @if($edit->publish == 0)
        " selected "
        @endif
        >No</option>
        </select>
              
            </div>
          </div>
  
<input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="btn btn-success" type="submit">Update</button>
                <a class="btn btn-default" href="{{ URL::to('admin/blogs') }}"><i class="fa fa-undo"></i> Cancel</a>
</form>

@stop

       
      