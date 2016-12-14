<div class="container">
<div class="col-sm-12">
<a class="btn btn-success" href="{{URL::to('comments/create')}}">Add New</a>
</div>
<table class="table table-bordered">
<thead>
<tr>
<th>Id</th>
<!-- <th>Blog Id</th>
<th>USer Id</th> -->
<th>Comment</th>
<th>Publish</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
@foreach($data as $datas)
<tr>
<td>{{$datas->id}}</td> 
<td>{{$datas->comments}}</td>
 <td>{{$datas->publish}}</td>
 
 <td>
  <a href="{{URL::to('comments')}}/{{$datas->id}}/" class="btn btn-warning">View</a>
    <a href="{{URL::to('comments')}}/{{$datas->id}}/edit" class="btn btn-warning">Edit</a>
         <form style="display:inline-block;" method="post" action="{{URL::to('comments')}}/{{$datas->id}}" class="">
         <input type="hidden" name="_method" value="DELETE">
     <input type="hidden" name="_token" value="{{csrf_token()}}">
     <input type="submit" value="Delete" name="" class="btn btn-danger delete">
     </form>

</td>
</tr>
    @endforeach
</tbody>
</table>

