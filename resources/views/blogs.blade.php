@extends('layouts.default')
@section('content')
<style type="text/css">
.university_banner_inner {
    margin-bottom: 30px;
    width: 100%;
    height: 330px;
    padding-top: 0;
    background: url( {{ asset("img/travel_blog.jpg") }}) no-repeat;
    background-size: cover;
    background-position: center center;
}
</style>
<div class="responsive-text univer_new">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_0">
      <div class="university_banner_inner">
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12" id="banner_text">
         <p class="font-size-42 margin-bottom-10" id="top_title">{!! trans('travelogue.caption') !!} </p>
          <p class="font-size-17 margin-bottom-15">{!! trans('travelogue.overview_1') !!}</p>
          <p class="font-size-17">{!! trans('travelogue.overview_2') !!}</p>
        </div>
      </div>
    </div>

</div>
<div class="blog">
  <div class="container">
    <fieldset class="form-group">
    <div class="row">
   		<div class="col-sm-6">
    		<label for="exampleSelect1" class="filterby control-label combobox">{!! trans('travelogue.filter_by_country') !!}:</label>
    		<div class="selectContainer">
    			<div class="row">
      				<select name="filter_id" id="FilterSelect" class="form-control" >
         				 <option value="all">{!! trans('travelogue.all') !!}</option>
        				  @foreach($data_filter as $filter)
       					   <option value=".{{ 'filter-'.$filter->id }}">{{ $filter->name}}</option>
         				 @endforeach
     				 </select>
     			 </div>
    		</div>
    	</div>
	    <div class="col-sm-6">
			 <div class="filter-group search">
				<label  class="searchby control-label mobile">{!! trans('travelogue.search') !!}:</label>
			    <input type="text" class="searchinput" id="filter" />
			    <label  class="searchby control-label desktop">{!! trans('travelogue.search') !!}:</label>
			  </div>
		</div>
    </div>
  </fieldset>
<div class="row" id="Container">
  @foreach($data_blog as $datlist)
  <?php
$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $datlist->title)))
  ?>
    <article class="col-sm-4 blog-item mix
    @foreach($datlist->filters as $filters) {{ 'filter-'.$filters }} @endforeach
    ">
      <a href="{{url(localization()->localizeURL('/travelogue'))}}/{{ $datlist->id }}/{{$slug}}"><img src="{{URL::to('/')}}/upload/{{$datlist->image}}" alt="" style="width:100%; height:180px;" />
    <h3 class="title">{{ strip_tags($datlist->title) }}</h3>

    <p>{{strip_tags($datlist->description)}}</p>
      <?php
if($datlist->tags != NULL)
{
  $tags = json_decode($datlist->tags);
  $tagy="";
  foreach($tags as $tag)
  {
    $tagy.= strtolower($tag)." , ".strtoupper($tag)." , ";
  }
}
else
{
  $tagy="";
}
?>
<p class="title hidden">{{$tagy}} </p>
    </a>
    </article>
    @endforeach
  </div>
  </div>
</div>

@stop
