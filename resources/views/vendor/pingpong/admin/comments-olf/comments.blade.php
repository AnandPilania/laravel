@extends('layouts.default')
@section('content')
<section class="blog_inner">
  <div class="container">
	<div class="row">
    <article class="col-sm-9 blog-post">
    	<div class="row">
      <p class="blog_inner_cont">2 March 2016</p>
      <h2 class="blg_inner">5 best gelato places in singapore!</h2>
      <p class="blg_inner_tx">by Wendy Goh</p>
      <p class="par_hght"></p>
      <div class="shares_fb"><h2><span class="share">10</span><br>Shares</h2><a href="#"><img src="images/Layer 32.png" class="img-responsive" width="460" height="78" alt="" /></a></div>
      </div>
    </article>
    <aside class="col-sm-3 blog-inner-item"> 
         <h3>Follow us</h3>
         <ul class="blog_social">
         <li><a href="#"><img src="images/Layer 26.png" class="img-responsive" width="88" height="88" alt="" /></a></li>
         <li><a href="#"><img src="images/Layer 27.png" class="img-responsive" width="89" height="89" alt="" /></a>
         </li> </ul>
    </aside>
  </div>
  </div>
</section>


<section class="botm_blog_text">
<div class="container">
<div class="col-sm-8">
<form id="bootstrapSelectForm" method="post" class="form-horizontal">
  <fieldset class="form-group frm_padd">
  <label for="exampleTextarea">Leave a comment!</label>
    <textarea class="form-control" id="exampleTextarea" rows="1"></textarea>
  </fieldset>
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
</div>
</section>

<section class="blog_comment">
  <div class="container">
    <div class="col-sm-8 blog_commt">
    <hr class="style15">
      </div>
      </div>
      </section>
      
      <section class="blog_comment">
  <div class="container">
    @foreach($data as $datlist)

    <div class="col-sm-8 blog_commtsss">
    <h3>Comments</h3>
    <div class="col-sm-2 comm_mg"><img src="images/Layer 301.png" class="img-responsive" width="95" height="93" alt="" /></div>
    <div class="col-sm-10 comm_text"><p><span class="comment_text">Wendy Goh:</span>{{$datlist->comments}}</p>
    <p class="second_text">16 July’16 2:55pm</p></div>
    </div>
        @endforeach

    </div>
    </section>
      
    <!--   <section class="blog_comment">
  <div class="container">
    <div class="col-sm-8 blog_commtss">
     <div class="col-sm-2 comm_mg"><img src="images/Layer 301.png" class="img-responsive" width="95" height="93" alt="" /></div>
    <div class="col-sm-10 comm_text"><p><span class="comment_text">Bella Wong: </span>Gelare isnt thatttt nice and it is really pricey. Instead try the gelato shop at East Village mall! They also serve their gelato with frehsly firied banana fritters! Plus they have the special - dark chocolate gelato - which is not always on display, you can ask the uncle!</p>
    <p class="second_text">17 July’16 4:15pm</p></div>
    </div>
    </div>
    </section> -->

@stop