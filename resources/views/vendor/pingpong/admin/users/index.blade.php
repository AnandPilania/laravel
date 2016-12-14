@extends($layout)

@section('content-header')

	<h1>
		{!! $title or 'All Users' !!} 
		&middot;
		<small>{!! link_to_route('admin.users.create', 'Add New') !!}</small>
	</h1>

	<form role="form"  id="searchform" action="{{ url('/admin/users') }}" method="get">

	<span style="float:right;width: 24%;">
		<input type="hidden" name="_token" value="{{ csrf_token() }}"><div class="form-group"><span style="width: 30%; float: left;">Search:</span><input type="text" value="<?php echo (@$_REQUEST['search']); ?>" name="search" class="form-control" style="height:26px;height:26px;width: 65%;"/> </div>
	</span>

<div style="clear:both"></div>

		<div class="container">
	      <div class="row">
	         <div class="search-section col-sm-10 form-horizontal">
	               <div class="row">
	                  <div class="col-lg-6">
	                  	
	                  	<div class="form-group">
	                        <label class="control-label col-sm-4" for="">User Type</label>
	                        <div class="col-sm-8">
	                         	{!! Form::select('usertype', array(""=>"Please select","profile_Not_updated"=>"Profile Not updated") + $usertypeList,Input::old('usertype',app('request')->input('usertype')), array('id' =>'usertype','name' => 'usertype','class'=>'form-control selectMenu', 'autocomplete'=>'off')) !!}
	                        </div>
	                     </div>

						 <div class="form-group">
	                        <label class="control-label col-sm-4" for="">Host University</label>
	                        <div class="col-sm-8">
	                        	{!! Form::select('hostUniv', array(""=>"Please select") + $hostUnivList,Input::old('hostUniv',app('request')->input('hostUniv')), array('id' =>'hostUniv','name'=> 'hostUniv' ,'class'=>'form-control selectMenu', 'autocomplete'=>'off')) !!}
	                        </div>
	                     </div>

	                     <div class="form-group">
	                        <label class="control-label col-sm-4" for="">Exchange Term</label>
	                        <div class="col-sm-8">
	                        	
	                          	 {!! Form::select('exchangeterm', array(""=>"Please select", "Spring 2017"=>"Spring 2017", "Summer 2017"=>"Summer 2017", "Fall 2017"=>"Fall 2017", "Winter 2017"=>"Winter 2017", "Spring 2016"=>"Spring 2016", "Summer 2016"=>"Summer 2016", "Fall 2016"=>"Fall 2016", "Winter 2016"=>"Winter 2016", "Spring 2015"=>"Spring 2015", "Summer 2015"=>"Summer 2015", "Fall 2015"=>"Fall 2015", "Winter 2015"=>"Winter 2015", "Spring 2014"=>"Spring 2014", "Summer 2014"=>"Summer 2014", "Fall 2014"=>"Fall 2014", "Winter 2014"=>"Winter 2014", "Spring 2013"=>"Spring 2013", "Summer 2013"=>"Summer 2013", "Fall 2013"=>"Fall 2013", "Winter 2013"=>"Winter 2013", "Spring 2012"=>"Spring 2012", "Summer 2012"=>"Summer 2012", "Fall 2012"=>"Fall 2012", "Winter 2012"=>"Winter 2012"),Input::old('exchangeterm',app('request')->input('exchangeterm')), array('id' =>
											'exchangeTerm','class'=>'form-control selectMenu', 'autocomplete'=>'off')) !!}
	                        </div>
	                     </div>
	                     
	                  </div>
	                  <div class="col-lg-6">
	                     <div class="form-group">
	                        <label class="control-label col-sm-4" for="">Home University</label>
	                        <div class="col-sm-8">
	                         	{!! Form::select('homeUniv', array(""=>"Please select") + $homeUnivList,Input::old('homeUniv',app('request')->input('homeUniv')), array('id' =>'homeUniv','class'=>'form-control selectMenu', 'autocomplete'=>'off')) !!}
	                        </div>
	                     </div>

	                     <div class="form-group">
	                        <label class="control-label col-sm-4" for="">Host Country</label>
	                        <div class="col-sm-8">
	                         	{!! Form::select('hostCountry', array(""=>"Please select") + $countryList,Input::old('hostCountry',app('request')->input('hostCountry')), array('id' =>'hostCountry','class'=>'form-control selectMenu', 'autocomplete'=>'off')) !!}
	                        </div>
	                     </div>

	                     <div class="form-group">
	                        <label class="control-label col-sm-4" for="">Last Logged In</label>
	                        <div class="col-sm-8">
	                           <input type="text" name="last-logged-in" data-provide="datepicker" value="<?php echo (@$_REQUEST['last-logged-in']); ?>" autocomplete="off" id="last-logged-in" class="form-control" id="exchangeKeyword" placeholder="Enter Keyword">
	                        </div>
	                     </div>

	                  </div>
	                  <div class="btn-toolbar">
	        			<button type="submit" class="pull-right btn  btn-success">Submit</button>
	                  	<a href="{{ url('/admin/users') }}" class="pull-right btn btn-space btn-primary">Reset</a>
	                 	
	                 </div>
	            </form>
	          </div>
	       </div>
      	</div>

	

{!!@$message!!}
@stop

@section('content')
{!! Form::open( ['files' => true,'route' => 'massbulk' ]) !!}


	<table class="table">
		<thead>
			<th><input type="checkbox" id="checkAll"></th>
			<th>No</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th style="width:20px;">Befriend / SeekAdvice sent</th>
			<th style="width:20px;">Befriend / SeekAdvice recieve</th>
			<th>Total Request</th>
			<th>Created At</th>
			<th>Last Logged In</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@if(count($users)!=0)
			
			@foreach ($users as $user)
			
			<tr>
				<td><input type="checkbox" class="selectCheck" name="userid[]" value="{!! $user->id !!}"></td>
				<td>{!! $no !!}</td>
				<td>{!! $user->fname !!}</td>
				<td>{!! $user->lname !!}</td>
				<td>{!! $user->email !!}</td>
				<td>{!! $user->sentBfTotal !!}/{!! $user->sentSaTotal !!}</td>
				<td>{!! $user->receiveBfTotal !!}/{!! $user->receiveSaTotal !!}</td>
				<td>{!! $user->sentBfTotal+$user->receiveBfTotal!!}/{!! $user->sentSaTotal+$user->receiveSaTotal!!}</td>
				<td>{!! $user->created_at !!}</td>
				<td>{!! $user->last_logged_in !!}<td>
				<td class="text-center">
					<a href="{!! route('admin.users.edit', $user->id) !!}"><span class="fa fa-fw fa-pencil"></span></a>
					&middot;
					<a data-toggle="modal" href="#modal-delete-{!! $user->id !!}">
  <span class="fa fa-fw fa-trash-o"></span>
</a>
					
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
			@else
				<tr>
				<td></td>
				<td></td>
				<td class="text-center">	No Record Found. </td>
				<td></td>
				<td >
				
				</td>
			</tr>
			@endif
		</tbody>
	</table>
	<div>
		
			<select onchange="this.form.submit()"  id="userstatus" name="type">
				<option value="">Choose Option</option>
				<option value="1">Move to Peer</option>
				<option value="2">Move to Senior</option>
			</select>
			<noscript><input type="submit" value="Submit"></noscript>
	</div>

	{!! Form::close() !!}
		@foreach ($users as $user)
	<div id="modal-delete-{!! $user->id !!}" class="modal text-left fade">
  <div class="modal-dialog">
    <div class="modal-content">
      {!! Form::open(['method' => 'DELETE', 'route' => ["admin.users.destroy", $user->id]])!!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h1 class="modal-title">Delete Data</h1>
      </div>
      <div class="modal-body">
        <p>
          Are you sure want to delete this data?
        </p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
      {!! Form::close() !!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
		@endforeach
	<div class="text-center">
		{!! pagination_links($users) !!}
	</div>
@stop
