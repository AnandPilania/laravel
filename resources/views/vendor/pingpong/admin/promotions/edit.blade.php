@extends($layout)

@section('content-header')
	<h1>
		Edit
		&middot;
		<small>{!! link_to_route('admin.promotions.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')

	<div>
		@include('admin::promotions.form', array('model' => $promotion))
	</div>

@stop
