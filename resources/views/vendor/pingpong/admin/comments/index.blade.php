@extends('vendor.pingpong.admin.layouts.master')
@section('content')
<div class="container">
<div class="col-sm-12">
<!-- <a class="btn btn-success" href="{{URL::to('admin/comments/create')}}">Add New</a> -->
</div>
<table class="table table-bordered" id="dataTable">
<thead>
<tr>

<!-- <th>Blog Id</th>
<th>USer Id</th> -->
<th>Comment</th>
<th>Commented By</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
@foreach($data as $datas)
<tr>

<td>{!! html_entity_decode($datas->comments) !!}</td>
<td>{{$datas->user}}</td> 
 <td>
 <!--  <a href="{{URL::to('admin/comments')}}/{{$datas->id}}/" class="btn btn-warning">View</a>
    <a href="{{URL::to('admin/comments')}}/{{$datas->id}}/edit" class="btn btn-warning">Edit</a> -->
   
         <form style="display:inline-block;" method="post" action="{{URL::to('admin/comments')}}/{{$datas->id}}" class="">
         <input type="hidden" name="_method" value="DELETE">
     <input type="hidden" name="_token" value="{{csrf_token()}}">
     <input type="submit" value="Delete" name="" class="btn btn-danger delete">
     </form>

</td>
</tr>
    @endforeach
</tbody>
</table>

@stop

