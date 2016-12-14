@extends('vendor.pingpong.admin.layouts.master')
@section('content')
<div class="">
<div class="col-sm-12">
<a class="btn btn-success" href="{{URL::to('admin/blogs/create')}}">Add New</a>

</div>
<div class="col-sm-12">
<div class="table-responsive">
<table class="table table-bordered customtable" id="dataTable">
<thead>
<tr>
<th>S.NO</th>
<!-- <th>Filter_id</th> -->
<th>Title</th>
<th>Description</th>
<th>Tags</th>
<th>Image</th>
<th>Author name</th>
<!-- <th>Link</th>
 --><th>Publish</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php $i = 1; ?>
@foreach($data as $datas)
<tr>
<td>{{ $i }}</td>
<td>{{str_limit(strip_tags($datas->title),100,'....')}}</td> 
 <td >{{str_limit(strip_tags($datas->description),220,'....')}}</td>

 <td>{{$datas->tags}}</td>
 <td><img src="{{URL::to('/')}}/upload/{{$datas->image}}" alt="" style="width:200px; height:180px;" /></td>
<td>{{$datas->author}}</td> 
<!--  <td>{{$datas->link}}</td> -->
 <td>{{$datas->publishtext}}</td>
 

 <td>
         <!-- <a href="{{URL::to('admin/blogs')}}/{{$datas->id}}/" class="btn btn-warning">
         View</a> -->
		<a href="{{URL::to('admin/blogs')}}/{{$datas->id}}/edit" class="btn btn-warning">Edit</a>
         <form style="display:inline-block;" method="post" action="{{URL::to('admin/blogs')}}/{{$datas->id}}" class="">
         <input type="hidden" name="_method" value="DELETE">
		 <input type="hidden" name="_token" value="{{csrf_token()}}">
		 <input type="submit" value="Delete" name="" class="btn btn-danger delete">
		 </form>

</td>
</tr>
<?php $i++; ?>
		@endforeach
</tbody>
</table>
</div>
</div>
@stop


