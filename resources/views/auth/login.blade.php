@extends('layouts.default')
@section('content')
<div class="form-body loginMid">
	<div class="container">
		<div class="row">
			<h2 class="text-center">{!! trans('auth.welcome') !!}</h2>
			<div class="col-lg-offset-3 col-lg-6 ">
				<p ><a class="heading" href="{!! URL::to(localization()->localizeURL('/login/facebook')) !!}"><span><i class="fa fa-facebook"></i>
				</span>{!! trans('auth.login_with_facebook') !!}</a></p>
				<p class="or">{!! trans('auth.or') !!}</p>
				@if (session('status'))
				<div class="alert alert-success">
					{{ session('status') }}
				</div>
				@endif
				@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				<form role="form" method="POST" action="{{ url(localization()->localizeURL('/auth/login')) }}" id="userlogin">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<input type="email" class="form-control required email" id="email" placeholder="{!! trans('auth.email') !!}" name="email" value="{{ old('email') }}">
					</div>
					<div class="form-group">
						<input type="password" class="form-control required" id="pwd" placeholder="{!! trans('auth.password') !!}" name="password">
					</div>
					<div class="checkbox pull-right">
						<label><input type="checkbox" name="remember"> {!! trans('auth.remember_me') !!}</label>
					</div>
					<button type="submit" class="btn btn-default">{!! trans('auth.login') !!}</button>
					<p class="f-cl"><a href="{{ url(localization()->localizeURL('/password/email')) }}">{!! trans('auth.forgot_password') !!} </a>
					<a href="{{ url(localization()->localizeURL('/auth/register')) }}">{!! trans('auth.dont_have_account') !!} {!! trans('auth.sign_up_now') !!}</a></p>
				</form>
			</div>
		</div>
	</div>
	<img class="img-back" src="{{ asset('/img/innerpageimg.png') }}">
</div>
@stop
