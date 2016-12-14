@extends('layouts.default')
@section('content')
<div class="profile-details">
	<div class="container">
		<div class="profile-innerd">
			<div class="row">
				<div class="col-lg-4 pro-left">
					<div class="pro-img" id="uploadImage" data-rel="{{Auth::user()->id}}">
						@if (Auth::User()->avatar != '')
							@if ((strpos(Auth::user()->avatar,'http://') !== false || strpos(Auth::user()->avatar,'https://') !== false))
								<img src="<?php echo str_replace('=normal','=large&width=200&height=200',Auth::user()->avatar) ?> " class="profileImg">
							@else
								<img src="{{ asset('/img/memberImages/')}}/{{ Auth::user()->avatar }}"   class="profileImg">
							@endif
						@else
							<img src="{{ asset('/img/Flying_profile.png') }}"  >
						@endif
					</div>
					<div class="social-icon-pro">
						<ul>
							<?php if(Auth::user()->provider_id!=''){ ?>
							<li class="facebook-pro"><a href="javascript:void(0);"><i class="fa fa-facebook"></i>{!! trans('profile.connected') !!}</a></li>
							<?php }else{ ?>
							<li class="facebook-pro"><a href="{!!URL::to('login/facebook')!!}"><i class="fa fa-facebook"></i>{!! trans('profile.sync_with_facebook') !!}</a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
				<div class="col-lg-8 pro-right">
					<div>
						<div class="form-horizontal">
							<div class="form-group">
                                <div>
                                    <p class="pull-right"><a href="{{ url(localization()->localizeURL('/edit-profile')) }}" style="margin-top:0;" class="pro-edit btn">{!! trans('profile.edit_profile') !!} <i class="icon-edit"></i></a></p>
                        <div class="font-size-17 profile-heading"><p style="
    float: left;
    padding: 5px;
    background-color: #fcecdc;">{!! trans('profile.general_profile') !!}</p></div>
                                </div>
                            </div>
                            <div class="form-group">
								<div class="row">
									<div class="col-sm-12">
                                        <label class="control-label lblExtr" for="pwd">{!! trans('profile.first_name') !!}</label>
                                <p style="clear:both;color: gray;">{{ Auth::user()->fname }}</p>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-12">
										<label class="control-label lblExtr" for="pwd">{!! trans('profile.last_name') !!}</label>
                                        <p style="clear:both;color: gray;">{{ Auth::user()->lname }}</p>
									</div>
								</div>
							</div>
                            @if(!is_null(Auth::user()->gender))
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="control-label lblExtr" for="pwd">{!! trans('profile.gender') !!}</label>
                                        <p style="clear:both;color: gray;">{{ (Auth::user()->gender)?"Male":"Female" }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12" style="width: 100%;">
                                        <label class="control-label lblExtr" for="pwd">{!! trans('profile.home_institution') !!}</label>
                                        <p style="clear:both;color: gray;">{{@$userData->exchange->homeUniversity->universityName}}</p>
                                    </div>
                                </div>
                            </div>

							<div class="form-group">
								<div class="row">
									<div class="col-sm-12">
										<label class="control-label lblExtr" for="pwd">{!! trans('profile.email') !!}</label>
                                        <p style="clear:both;color: gray;">{{ Auth::user()->email }}</p>
									</div>
								</div>
							</div>

                            <div class="form-group">
                                <div>
                                    <div class="font-size-17 profile-heading"><p style="
    float: left;
    padding: 5px;
    background-color: #fcecdc;">{!! trans('profile.addition_information') !!}</p></div>
                                </div>
                            </div>

    						<div class="form-group">
								<div class="row">
									<div class="col-sm-12">
										<label class="control-label lblExtr" for="pwd">{!! trans('profile.type_of_user') !!}</label>
                                        <p style="clear:both;color: gray;">{{@$userData->exchange->userType->title}}</p>
									</div>
								</div>
							</div>
                            <!-- NOW DEPENDS ON USER TYPE -->
                            @if(in_array(@$userData->exchange->type, array('3','4')))
                            @if(!is_null($userData->exchange->buddy))
                            <div class="form-group">
								<div class="row">
									<div class="col-sm-12">
										<label class="control-label lblExtr" for="pwd">{!! trans('profile.flying_chalks_buddy') !!}</label>
                                        @if(!empty($userData->exchange->buddy))
											<p style="clear:both;color: gray;">{!! trans('profile.yes') !!}</p>
                                            @else
                                            <p style="clear:both;color: gray;">{!! trans('profile.no') !!}</p>
                                            @endif
									</div>
								</div>
							</div>
                            @endif
                            @endif
                            @if(in_array(@$userData->exchange->type, array('3','1', '2')))
                            @if(!is_null($userData->exchange->program))
                            <div class="form-group">
								<div class="row">
									<div class="col-sm-12">
										<label class="control-label lblExtr" for="pwd">{!! trans('profile.program') !!}</label>
											<p style="clear:both;color: gray;">{{ ($userData->exchange->program)?"Full-Time":"Exchange" }}</p>
									</div>
								</div>
							</div>
                            @endif
                            @endif

                            @if(in_array(@$userData->exchange->type, array('1','2')))
                            <div class="form-group">
								<div class="row">
									<div class="col-sm-12">
										<label class="control-label lblExtr" for="pwd">{!! trans('profile.host_institution') !!}</label>
											<p style="clear:both;color: gray;">{{@$userData->exchange->hostUniversity->universityName}}</p>
									</div>
								</div>
                            </div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-12">
											<label class="control-label lblExtr" for="pwd">{!! trans('profile.host_country') !!}</label>
                                            <p style="clear:both;color: gray;">{{@$userData->exchange->hostUniversity->city->country->countryName}}</p>
										</div>
									</div>
								</div>
                                <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="control-label lblExtr" for="pwd">{!! trans('profile.school_term') !!}</label>
                                            <p style="clear:both;color: gray;">
                                            @if(!is_null($userData->exchange->term_from))
                                            {{ date('M Y', strtotime($userData->exchange->term_from))." - ".date('M Y', strtotime($userData->exchange->term_to)) }}
                                            @else
                                            {{ $userData->exchange->exchangeTerm }}
                                            @endif
                                            </p>
                                    </div>
                                </div>
                            </div>
                            </div>
							</div>

                            @endif

						</div>
                        <!-- END OF SINGLE COLUMN -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<img src="{{ asset('/img/cloud.png') }}" class="img-back">
</div>
@stop
