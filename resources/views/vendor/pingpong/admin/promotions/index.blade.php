@extends($layout)

@section('content-header')
	<h1>
		All Promotions ({!! $promotions->count() !!})
		&middot;
		<small>{!! link_to_route('admin.promotions.create', 'Add New') !!}</small>

        <form role="form"  id="searchform" action="{{ url('/admin/promotions') }}" method="get">
            <span style="float:right;width: 24%;">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <span style="width: 30%; float: left;">Search:</span>
                    <input type="text" value="<?php echo (@$_REQUEST['search']); ?>" name="search" class="form-control" style="height:26px;height:26px;width: 65%;"/>
                </div>
            </span>
        </form>
    </h1>
<div style="clear:both"></div>
@stop

@section('content')

	<table class="table">
		<thead>
			<th>No</th>
			<th>Code</th>
            <th>Company Name</th>
            <th>Company Description</th>
            <th>Company Logo</th>
            <th>Offer Name</th>
            <th>Offer Description</th>
			<th>Discount</th>
			<th>Type</th>
            <th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($promotions as $promotion)
			<tr>
				<td>{!! $no !!}</td>
                <td>{!! $promotion->code !!}</td>
                <td>{!! $promotion->company_name !!}</td>
                <td>{!! $promotion->company_description !!}</td>
                <td><img class="img-responsive" src="{!! asset('/images/promotions/' . $promotion->company_logo) !!}"></td>
                <td>{!! $promotion->offer_name !!}</td>
                <td>{!! $promotion->offer_description !!}</td>
                <td>{!! $promotion->discount !!}</td>
				<td>{!! $promotion->type->name !!}</td>
				<td>{!! $promotion->created_at !!}</td>
				<td class="text-center">
					<a href="{!! route('admin.promotions.edit', $promotion->id) !!}">Edit</a>
					&middot;
					@include('admin::partials.modal', ['data' => $promotion, 'name' => 'promotions'])
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>

	<div class="text-center">
		{!! pagination_links($promotions) !!}
	</div>
@stop
