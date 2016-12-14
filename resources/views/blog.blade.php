@extends('layouts.default')
@section('content')
<section class="blog_inner">
  <div id="blog_containe" class="container">
  <div class="row">
    <article class="col-sm-offset-2 col-sm-8 blog-post">
      <div class="row">
      <div class="blog_tit_dt">
      <h2 class="blg_inner">{{$data_blog->title}}</h2>

      </div>

      <p class="blg_inner_tx">by <a href="{{$data_blog->link}}">{{$data_blog->author}}</a> | {{ date('d M Y', strtotime($data_blog->created_at)) }} <span id="shareall"></span></p>

      <div class="par_hght">{!!html_entity_decode($data_blog->description)!!}</div>
     <!-- <p class="blg_glink"><a href="{{$data_blog->link}}">{{$data_blog->link}}</a></p> -->


    <!--   <div class="fb-share-button" data-href="{{ URL::to('/') }}/blog/{{ $data_blog->id }}/{{ strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data_blog->title))) }}" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ URL::to('/') }}/blog/{{ $data_blog->id }}/{{ strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data_blog->title))) }}">Share</a></div>
      </div> -->
     <!--  <a href="http://www.facebook.com/sharer.php?u={{ URL::to('/') }}/blog/{{ $data_blog->id }}/{{ strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data_blog->title))) }}" class="socialite facebook-share" data-href="{{ URL::to('/') }}/blog/{{ $data_blog->id }}/{{ strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data_blog->title))) }}" data-send="true" data-layout="box_count" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span class="vhidden">Share on Facebook</span></a> -->
       <div id="share_btm" class="share_btm"></div>
    </article>
    <section class="botm_blog_text">
<div class="row">
<div class="col-sm-offset-2 col-sm-8">
    <fieldset class="form-group frm_padd">
             <label for="tags" class=" control-label">Tags</label>
            <div class="">
              <?php
$tag=explode(",",$data_blog->tags);
foreach($tag as $tagy)
{
  $tagy= preg_replace("/[^ \w]+/", "", $tagy);
   echo  '<a href="'.url('/').'/travelogue_tags/'.$tagy.'"><span class="label label-default">'.$tagy.'</span></a>';
  }
  ?>
      </div>
  </div>
</div>
</div>
</section>

    <aside class="col-sm-offset-2 col-sm-8 blog-inner-item">
         <h3>Follow us</h3>
         <ul class="blog_social">
         <li><a href="https://www.facebook.com/flyingchalks" target="_blank"><img src="{{ URL::to('/') }}/images/Layer 26.png" class="img-responsive" width="88" height="88" alt="" /></a></li>
         <li><a href="https://www.instagram.com/flyingchalks" target="_blank"><img src="{{ URL::to('/') }}/images/Layer 27.png" class="img-responsive" width="89" height="89" alt="" /></a>
         </li>
          </ul>
    </aside>
  </div>
  </div>
</section>

<section class="botm_blog_text">
    <div id="blog_containe" class="container">
        <div class="col-sm-offset-2 col-sm-8">
            {!! Form::open(['id' => 'bootstrapSelectForm', 'method' => 'post', 'url' => "blogs/{$data_blog->id}/storeComment", 'class' => 'form-horizontal myform']) !!}
                <fieldset class="form-group frm_padd">
                    <label for="exampleTextarea">Leave a comment!</label>
                    <textarea type="text" class="form-control" name="comments" required></textarea>
                </fieldset>
                {!! Honeypot::generate('my_name', 'my_time') !!}
                <button type="submit" class="btn btn-primary">Submit</button>
            {!! Form::close() !!}
        </div>
    </div>
</section>

<section class="blog_comment">
  <div id="blog_containe" class="container">
    <div class="col-sm-offset-2 col-sm-8 blog_commt">
    <hr class="style15">
      </div>
      </div>
      </section>


<section class="blog_comment">
  <div id="blog_containe" class="container">
   <div class="col-sm-offset-2 col-sm-8 blog_commtsss">
    <h3>{{$comments_count}} Comment(s)</h3>
    </div>

 @foreach($data_comments as $datlist)


    <div class="col-sm-offset-2 col-sm-8 blog_commt">
    @forelse($datlist->user as $users)

      <div class="col-sm-2 comm_mg"><img src="<?php
	if ($users->avatar=='') { ?>{{ URL::to('/') }}/img/bot-logo.png<?php
	} else if((strpos($users->avatar,'http://')!== false || strpos($users->avatar,'https://')!== false)) {
		echo $users->avatar;
	} else { ?>{{ URL::to('/') }}/img/memberImages/<?php
		echo $users->avatar;
	}
	?>" class="img-responsive" width="95" height="93" alt="" /></div>
    @empty
      <div class="col-sm-2 comm_mg"><img src="{{ URL::to('/') }}/img/bot-logo.png" class="img-responsive" width="95" height="93" alt="" /></div>
    @endforelse
    <div class="col-sm-10 comm_text"><p><span class="comment_text"></span>
    @forelse($datlist->user as $users)
    @if($users->fname != '')
    {{ $users->fname }} {{ $users->lname }}
    @else
    {{ "Student" }}
    @endif
    @empty
      {{ "Student" }}
    @endforelse
    : {{$datlist->comments}}</p></br>
    <p class="second_text">{{ date('d M y h:i a', strtotime($datlist->created_at))}}</p></div>
    </div>
    @endforeach
  </div>
</section>

<script>
 $("#share_btm").jsSocials({
    showLabel: false,
    showCount: false,
    shares: [{
        renderer: function() {
            var $result = $("<div>");

            var script = document.createElement("script");
            script.text = "(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = \"//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3\"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));";
            $result.append(script);

            $("<div>").addClass("fb-share-button")
                .attr("data-layout", "button")
                .appendTo($result);

            return $result;
        }
    }]
});
</script>
<script>
 $("#shareall").jsSocials({
    showLabel: false,
    showCount: false,
    shares: [{
        renderer: function() {
            var $result = $("<div>");

            var script = document.createElement("script");
            script.text = "(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = \"//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3\"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));";
            $result.append(script);

            $("<div>").addClass("fb-share-button")
                .attr("data-layout", "button")
                .appendTo($result);

            return $result;
        }
    }]
});
</script>

@stop
