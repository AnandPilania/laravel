@extends('layouts.default')

@section('content')
<style type="text/css">
.university_banner_inner {
    margin-bottom: 30px;
    width: 100%;
    height: 330px;
    padding-top: 0;
    background: url( {{ asset("img/discounts_banner.jpg") }}) no-repeat;
    background-size: cover;
    background-position: center center;
}
</style>
<div id="login-overlay" class="overlay">
    <div class="overlay-content">
        <div class="form-body overlay-form">
            <div class="container">
                <div class="row">
                    <h2>As these gifts &amp; promotions are meant for our community,<br/>please login or simply sign up to proceed :)</h2>
                    <div class="col-lg-offset-3 col-lg-6 ">
                        <p><a class="heading" href="{{ url('/login/facebook') }}"><span><i class="fa fa-facebook"></i></span>Continue with Facebook</a></p>
                        <p class="or">or</p>

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
                            <input type="hidden" name="referrer" value="{{ url('/discounts') }}">
                            <div class="form-group">
                                <input type="email" class="form-control required email" id="email" placeholder="Email" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control required" id="pwd" placeholder="Password" name="password">
                            </div>
                            <div class="form-group">
                                <p class="terms-cond">By signing up, I agree to Flying Chalks'
                                  <a href="{{ url('/pages/privacy-policy') }}" target="_blank">Terms of Service</a> and
                                  <a href="{{ url('/pages/terms-of-use') }}" target="_blank">Privacy Policy</a>.
                                </p>
                            </div>
                            <button type="submit" class="btn btn-default regBtn">Sign Up</button>
                            <button type="submit" formaction="{{ url('/auth/login') }}" class="btn btn-default regBtn">Log In</button>
                            <button type="button" class="btn btn-default regBtn close-overlay">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="responsive-text univer_new">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_0">
        <div class="university_banner_inner">
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12" id="banner_text">
                <p class="font-size-42 margin-bottom-10" id="top_title">{!! trans('discounts.caption') !!}</p>
                <p class="font-size-17 margin-bottom-15">{!! trans('discounts.overview_1') !!}</p>
                <p class="font-size-17">{!! trans('discounts.overview_2') !!}</p>
            </div>
        </div>
    </div>
</div>

<div class="blog">
    <div class="container">
        <fieldset class="form-group">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <label for="exampleSelect1" class="filterby control-label combobox">{!! trans('discounts.filter_by_type') !!}:</label>
                    <div class="selectContainer">
                        <div class="row">
                            <select name="filter_id" id="FilterSelectDisc" class="form-control" >
                                <option value="all">{!! trans('discounts.all') !!}</option>
                                @foreach($data_filter as $filter)
                                    <option value="{{ 'filter-'.$filter->id }}">{{ $filter->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="row" id="Container" style="display:block">
            @foreach($data_promotions as $datlist)
                <div class="row {{ 'filter-'.$datlist->type_id }} filter_selection">
                    <article class="col-sm-4 blog-item discount-item">
                        <div class="discount-article"><img src="{{URL::to('/')}}/images/promotions/{{$datlist->company_logo}}" alt="" style="width:100%;" />
                            <h3 class="title">{!! $datlist->company_name !!}</h3>
                            <h1>{{ $datlist->discount }}</h1>
                            @if($datlist->company_description!='')
                                {!! $datlist->company_description !!}
                            @endif
                        </div>
                        <div class="clearfix"></div>
                    </article>
                    <div class="col-sm-8" style="padding-top: 2%;">
                        <h2 style="color: #ff7c00;">{!! $datlist->offer_name !!}</h2>
                        <p>{!! $datlist->offer_description !!}</p>
                        <button class="btn btn-primary-new promocode">{!! trans('discounts.get_promo_code') !!}</button>
                        @if(Auth::user())
                            <h3 class="title" style="display: none;word-wrap: break-word;">{!! $datlist->code !!}</h3>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div id="noresults" style="display:none">
            <h1>{!! trans('discounts.no_result') !!}</h1>
        </div>
    </div>
</div>

@stop
