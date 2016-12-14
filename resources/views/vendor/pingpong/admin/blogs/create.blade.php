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

        <form id="aboutus" class=" form_validate" role="form" autocomplete="off" novalidate action="{{ URL::route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
           <div class="form-group">
            <label for="filter_id" class=" control-label">Filter id</label>
            <div class="">
            <select name="filter_id[]" class="form-control select2" required multiple>
            
            @foreach($datas as $datas)
           <option value="{{ $datas->id }}">{{ $datas->name}}</option>
            @endforeach
           </select>
           </div>

          </div>
           <div class="form-group">
            <label for="title" class=" control-label">Title</label>
            <div class="">
              <input type="text" class="form-control" name="title" required value="{{old('title')}}">
            </div>
          </div>
           <div class="form-group">
            <label for="description" class=" control-label">Description</label>
            <div class=" ">
              <textarea name="description" id="ckeditor" class="form-control col-md-7 col-xs-1 summernote"  cols="0" rows="0" required></textarea>
            </div>
          </div>
         
           <div class="form-group">
            <label for="tags" class=" control-label">Tags</label>
            <div class="">
              <input type="text" id="input-tags" class="form-control" name="tags" required value="{{old('tags')}}">

            </div>
          </div>
        <div class="form-group">
            <label for="image" class=" control-label">Image</label>
            <div class="">
              <input type="file" class="form-control" name="image"  value="{{old('image')}}">
            </div>
          </div>
          <!-- <div class="form-group">
            <label for="author_name" class=" control-label">Author Name</label>
            <div class="">
          <select name="author_name" class="form-control selectauthor " required>
          <option value>Select Author Name</option>
          @foreach($users as $user)
           <option value="{{ $user->id }}">{{ $user->fname}}{{ $user->fname}}</option>
            @endforeach
          </select>            
        </div>
          </div> -->
          <div class="form-group">
            <label for="author" class=" control-label">Author Name</label>
            <div class="">
              <input type="text" class="form-control" name="author" required value="{{old('author')}}">
            </div>
          </div>
          <div class="form-group">
            <label for="link" class=" control-label">Link</label>
            <div class="">
              <input type="url" class="form-control" name="link"  value="{{old('link')}}">
            </div>
          </div>
           <div class="form-group">
            <label for="publish" class=" control-label">Publish</label>
            <div class="">
          <select name="publish" class="form-control" required>
          <option value>Select Publish</option>
          <option value="1">Yes</option>
           <option value="0">No</option>
          </select>            
        </div>
          </div>
<input type="hidden" name="_method" value="POST"></input>
<input type="hidden" name="_token" value="{{csrf_token()}}"></input>
<a href="{{ URL::to('admin/blogs')}}" class="btn btn-default">Cancel</a>
<input type="submit" value="Submit" class="btn btn-primary pull-right"></input>
  </form>

@stop