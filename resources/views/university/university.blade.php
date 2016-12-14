@extends('layouts.default')
@section('content')
<style type="text/css">
.pro-left img.profileImg {
	width:100%;
	height:100%;
	border-radius:50%;
}
.pro-left img {
	border-radius:0;
}
.university_banner_inner {
	margin-bottom: 30px;
	width: 100%;
	height: 330px;
    padding-top: 0;
	background: url( {{ asset("img/banner_university_guide.jpg") }}) no-repeat;
	background-size: cover;
	background-position: center center;
}
@media (max-width: 767px) {
    .university_banner_inner {
        height: 230px;
    }
}
b.highlight {
	color: #00a3e8;
}
</style>
<div class="container-fluid responsive-text">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_0">
			<div class="university_banner_inner">
				<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12" id="banner_text">
					<p class="font-size-42 margin-bottom-10" id="top_title">{!! trans('university.caption') !!}</p>
					<p class="font-size-17 margin-bottom-15">{!! trans('university.overview_1') !!}</p>
					<p class="font-size-17">{!! trans('university.overview_2') !!}</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="list_university_blck">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
			</div>
			<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 pd">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 .customFilterCountry">
						<div class="fil_univ_blck_2">
							<h3> {!! trans('university.filter_by_country') !!}: </h3>
						</div>
						<div class="fil_univ_blck">
							<form method="post" action="{{ url('/university-filter') }}" id="CntrySlct">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<select id="combobox-countrylist" onchange="filterByCountry();">
									<option value="all">{!! trans('university.all') !!}</option>
									@foreach($country as $cntry)
									<option value="{{$cntry}}">{{$cntry}}</option>
									@endforeach
								</select>
							</form>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 .customFilterSearch">
						<div class="fil_univ_blck_3">
							<h3 class="fil_univ_blck_1"> {!! trans('university.search') !!}: </h3>
						</div>
						<div class="fil_univ_blck_4">
							<input type="text" autocomplete="off" style="margin-top:9px;" id="searchUNI">
						</div>
					</div>
				</div>

				<div class="row" id="universityList">
					@foreach($universities as $university)
					<?php $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $university->universityName))); ?>
					<a href="{{url(localization()->localizeURL('/university/'))}}/{{$university->id}}/{{$slug}}">
						<div id="gridId{{$university->id}}" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 unicheck"  data-university="{{str_replace(array('(',')'),array('',''),strtolower($university->universityName))}}">
							<div class="inner_university_blck">
								@if(!empty($university->image))
									<img src="{{ asset('/images/universities')}}/{{$university->image}}" alt="img1"/> @else <img src="{{asset('/img/Sogang_University.gif')}}" alt="img1"/>
								@endif
								<div class="inner_img_block ">
									<h4>{{$university->universityName}} </h4>
								</div>
							</div>
						</div>
						</a>
					@endforeach
				</div>

			</div>
			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#combobox').combobox();
		$('#combobox-countrylist').combobox();
		$('#combobox-countrysearch').combobox();
	});
</script>
@stop
