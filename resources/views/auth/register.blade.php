@extends('layouts.default')

@section('content')
<div class="form-body regMid">
    <div class="container">
        <div class="row">
            <h2 class="text-center">{!! trans('auth.sign_up') !!}</h2>
            <div class="col-lg-offset-3 col-lg-6 ">
                <p><a class="heading" href="{{ url(localization()->localizeURL('/login/facebook')) }}"><span><i class="fa fa-facebook"></i></span>{!! trans('auth.sign_up_with_facebook') !!}</a></p>
                <p class="or">{!! trans('auth.or') !!}</p>

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form class="form-horizontal" role="form" method="POST" action="{{ url(localization()->localizeURL('/auth/register')) }}" id="usersignup">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <input type="email" class="form-control required email" id="email" placeholder="{!! trans('auth.email') !!}" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control required" id="pwd" placeholder="{!! trans('auth.password') !!}" name="password">
                    </div>
                    <div class="form-group">
                        <p class="terms-cond">{!! trans('auth.term_condition') !!}</p>
                    </div>
                    <button type="submit" class="btn btn-default regBtn">{!! trans('auth.sign_up') !!}</button>
                </form>
            </div>
        </div>
    </div>
    <img class="img-back" src="{{ asset('/img/innerpageimg.png') }}">
</div>

@stop
