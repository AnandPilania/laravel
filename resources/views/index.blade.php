@extends('layouts.home')
@section('meta-tags')
<meta name="description" content="If you’re an exchange student intending to study abroad or travel abroad, you’ll definitely need student accommodations and other types of student rooms! International students pursuing summer programmes or other kinds of international studies can not only look up relevant information about student housing, student apartments and where to find accommodation for students, but also talk to seniors about their student exchange programs experience! Go abroad and have plenty of enriching experiences as a foreign exchange student under a study abroad programme, with help from Flying Chalks. Now, go forth and have fun at your study abroad!">
@stop
@section('content')
<div class="one_section leading">
    <div class="container">
        <div class="row font-size-17">
            <div class="col-md-4 part-intro">
                <h2><b class="font-size-25">Plan</b></h2>
                <img class="margin-bottom-10 center-block img-responsive" style="max-width:33%" src="{{ asset('/img/homepage_plan.png') }}">
                <p class="margin-bottom-10">{!! trans('home.plan_description_1') !!}</p>
                <p>{!! trans('home.plan_description_2') !!}</p>
            </div>
            <div class="col-md-4 part-intro">
                <h2><b class="font-size-25">Share</b></h2>
                <img class="margin-bottom-10 center-block img-responsive" style="max-width:33%" src="{{ asset('/img/homepage_share.png') }}">
                <p class="margin-bottom-10">{!! trans('home.share_description_1') !!}</p>
                <p>{!! trans('home.share_description_2') !!}</p>
            </div>
            <div class="col-md-4 part-intro">
                <h2><b class="font-size-25">Connect</b></h2>
                <img class="margin-bottom-10 center-block img-responsive" style="max-width:33%" src="{{ asset('/img/homepage_connect.png') }}">
                <p class="margin-bottom-10">{!! trans('home.connect_description') !!}</p>
                <ul>
                    <li><span>{!! trans('home.connect_item_1') !!}</span></li>
                    <li><span>{!! trans('home.connect_item_2') !!}</span></li>
                    <li><span>{!! trans('home.connect_item_3') !!}</span></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <img class="img-back" src="{{ asset('/img/img0.jpg') }}">
        </div>
    </div>
</div>
<div class="one_section" id="ourmisiionsec">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 part-intro">
                <div class="block-img">
                    <h3>Our Team</h3>
                    <p>{!! trans('home.team_description') !!}</p>
                </div>
            </div>
            <div class="col-lg-6 part-intro">
                <div class="block-img">
                    <h3>Our Mission</h3>
                    <p>{!! trans('home.mission_description') !!}</p>
                </div>
            </div>
        </div>
    </div>
    <img class="img-back" src="{{ asset('/img/img1.png') }}">
</div>
<div class="two_section form-body regMid" id="signup">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>{!! trans('home.singup_caption_1') !!}</h3>
                <span>{!! trans('home.singup_caption_2') !!}</span>
                <img class="take_flight" src="{{ asset('/img/plan.png') }}">

            </div>
            <div class="col-lg-offset-3 col-lg-6 ">

                <p><a class="heading" href="{{ url('/login/facebook') }}"><span class="fb_signup"><i class="fa fa-facebook"></i></span>{!! trans('home.signup_facebook') !!}</a></p>
                <p class="or">{!! trans('home.or') !!}</p>

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}" id="usersignup">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @if (Auth::guest())
                    <div class="form-group">
                        <input type="email" class="form-control required email" id="email" placeholder="{{ trans('home.email') }}" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control required" id="pwd" placeholder="{{ trans('home.password') }}" name="password">
                    </div>
                    @else
                    <div class="form-group">
                        <input type="email" class="form-control required email" id="email" placeholder="You are already logged in." name="email" value="{{ old('email') }}" disabled>
                    </div>
                    @endif
                    </form>
            </div>
        </div>
        <div class="col-lg-12">
            @if (Auth::guest())
            <p class="terms-cond">{!! trans('home.term_condition') !!}</p>
            <button id="usersignup_submit" type="submit" class="btn btn-default">{!! trans('home.register') !!}</button> @endif
            <ul>
                <li>{!! trans('home.tip_facebook') !!}</li>
                <li>{!! trans('home.tip_instagram') !!}</li>
            </ul>
        </div>
    </div>
    <img class="img-back" src="{{ asset('/img/img2.png') }}">
</div>
@stop
