@extends($layout)

@section('content-header')
	<h1>
		Add New
		&middot;
		@if(isOnPages())
		<small>{!! link_to_route('admin.promotions.index', 'Back') !!}</small>
		@else
		<small>{!! link_to_route('admin.promotions.index', 'Back') !!}</small>
		@endif
	</h1>
@stop

@section('content')

	<div>
		@include('admin::promotions.form')
	</div>

@stop
