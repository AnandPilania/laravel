<p>Id:{{$data->id}}</p>
<p>Name:{{$data->title}}</p>
<p>Name:{{$data->description}}</p>
<p>Tags:{{$data->tags}}</p>
<p><img src="{{URL::to('/')}}/upload/{{$data->image}}" alt="" style="width:200px; height:180px;" /></p>
<p>Tags:{{$data->author_name}</p>
<p>Tags:{{$data->link}}</p>
<p>Publish:{{$data->publish}}</p>
<?php
$var = App\fc_comment::where('blog_id',$data->id)->first()->comments;
//return $var;
?>
<p>Comments:<?php echo $var; ?></p>
<a class="btn btn-default" href="{{ URL::to('blog') }}"><button type="submit" class="btn btn-primary">
Cancel</button></a>


