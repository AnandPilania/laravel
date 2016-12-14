@extends('vendor.pingpong.admin.layouts.master')
@section('content')
<div class="container">
<div class="col-sm-12">
<a class="btn btn-success" href="{{URL::to('admin/filters/create')}}">Add New</a>
</div>
<table class="table table-bordered" id="dataTable">
<thead>
<tr>

<th>Name</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
@foreach($data as $datas)
<tr>

<td>{{$datas->name}}</td> 
 <td>
 
    <a href="{{URL::to('admin/filters')}}/{{$datas->id}}/edit" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
         <form style="display:inline-block;" method="post" action="{{URL::to('admin/filters')}}/{{$datas->id}}" class="">
         <input type="hidden" name="_method" value="DELETE">
     <input type="hidden" name="_token" value="{{csrf_token()}}">
     <button type="submit" name="" class="btn btn-danger delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
     </form>

</td>
</tr>
    @endforeach
</tbody>
</table>
@stop

