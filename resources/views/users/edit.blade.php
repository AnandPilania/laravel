@extends('layouts.default')

@section('content')

<style>
    .pro-left img.profileImg {
        width:100%;
        height:100%;
        border-radius:50%;
    }
    .pro-left img {
        border-radius:0;
    }
    .centerLoader{
        width: auto !important;
        height: auto !important;
        position: absolute;
        top: 40%;
        left: 44%;
    }

    .purpose_images {
        border: 4px solid lightgray;
    border-radius: 50px;
    }

    .purpose_images:hover, .purpose_images.purpose_selected {
        border: 4px solid #ff7c00;
    border-radius: 50px;
    }

</style>

<div class="profile-details">
    <div class="container">
        <div class="profile-innerd">
            <div class="row">
                <div class="col-lg-4 pro-left">
                    <h2>{!! trans('profile.general_profile') !!}</h2>
                    <div class="pro-img" id="uploadImage" data-rel="{{Auth::user()->id}}">
                        @if (Auth::User()->avatar != '')
                            @if ((strpos(Auth::user()->avatar,'http://') !== false || strpos(Auth::user()->avatar,'https://') !== false))
                                <img src="{{ str_replace('=normal','=large&width=200&height=200',Auth::user()->avatar) }}" class="profileImg">
                            @else
                                <img src="{{ asset('/img/memberImages/')}}/{{ Auth::user()->avatar }}"   class="profileImg">
                            @endif
                        @else
                            <img src="{{ asset('/img/Flying_profile.png') }}">
                        @endif
                    </div>
                    <div class="social-icon-pro">
                        <ul>
                            @if (Auth::user()->provider_id != null)
                                <li class="facebook-pro"><a href="javascript:void(0);"><i class="fa fa-facebook"></i>{!! trans('profile.connected') !!}</a></li>
                            @else
                                <li class="facebook-pro"><a href="{!!URL::to('login/facebook')!!}"><i class="fa fa-facebook"></i>{!! trans('profile.sync_with_facebook') !!}</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <form role="form" action="{{ url('/exchange-store') }}" method="post" class="form-horizontal" id="general_profile">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                    @if ($userData->exchange != null)
                        <input type="hidden" id="is_updated" value="Yes">
                        <input type="hidden" id="type_purpose" value="{{$userData->exchange->type}}">
                    @else
                        <input type="hidden" id="is_updated" value="No">
                    @endif
                    <div class="col-lg-8 pro-right">
                        <div class="profile-bio">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 rud_spa_1">
                                        <label class="control-label lblExtr" for="fname">{!! trans('profile.first_name') !!}: </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" class="form-control" id="fname" value="{{ Auth::user()->fname }}" name="fname" required>
                                        <label class="error pError">{{$errors->first('fname')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 rud_spa_1">
                                        <label class="control-label lblExtr" for="lname">{!! trans('profile.last_name') !!}: </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <input type="lname" class="form-control" id="lname" value="{{ Auth::user()->lname }}" name="lname" required>
                                        <label class="error pError">{{$errors->first('lname')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 rud_spa_1">
                                        <label class="control-label lblExtr" for="gender">{!! trans('profile.gender') !!}: </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 radio_divs">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                    {!! Form::radio('gender', 1, $userData->gender == 1, ['class' => 'form-control radio_profile','required']) !!}
                                                    {!! trans('profile.male') !!}</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                    {!! Form::radio('gender', 0, $userData->gender == 0, ['class' => 'form-control radio_profile','required']) !!}
                                                    {!! trans('profile.female') !!}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group home-univ">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 rud_spa_1">
                                        <label class="control-label" >{!! trans('profile.home_institution') !!}: </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        {!! Form::select('homeUniversityID', array(""=>"Please select") + $homeUnivList,Input::old('homeUniversityID')!=''?Input::old('homeUniversityID'):(@$exchangeDetail->homeUniversity->id!=''?@$exchangeDetail->homeUniversity->id:''), array('id' =>
                                        'homeUniversityID','class'=>'form-control selectMenu', 'autocomplete'=>'off', 'required'=>'required')) !!}
                                        <label class="error pError">{{$errors->first('homeUniversityID')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div id="newHomeUniversityDiv" class="form-group" style="display:{{ Input::old('homeUniversityID')=='1'?'block':'none'}};">
                                <label for="" class="control-label col-sm-3 "></label>
                                <div class="col-sm-9 col-xs-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">New Home Institution</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label for="" class="control-label col-sm-3 ">*Country:</label>
                                                <div class="col-sm-9 col-xs-12">
                                                    {!! Form::select('homecountry', array(""=>"Please select") + $countryList,Input::old('homecountry'), array('id' =>
                                                    'homecountry','class'=>'form-control selectMenu', 'autocomplete'=>'off')) !!}
                                                    <label class="error pError">{{$errors->first('homecountry')}}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="control-label col-sm-3 ">*City:</label>
                                                <div class="col-sm-9 col-xs-12">
                                                    {!! Form::text('homecity',Input::old('homecity'),array('id'=>'homecity','class'=>'form-control')) !!}
                                                    <label class="error pError">{{$errors->first('homecity')}}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="control-label col-sm-3 ">*Institution Name:</label>
                                                <div class="col-sm-9 col-xs-12">
                                                    {!!     Form::text('homeuniversityName',Input::old('homeuniversityName'),array('id'=>'homeuniversityName','class'=>'form-control')) !!}
                                                    <label class="error pError">{{$errors->first('homeuniversityName')}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 rud_spa_1">
                                        <label class="control-label lblExtr" for="email">{!! trans('profile.email') !!}: </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" name="email" required>
                                        <label class="error pError">{{$errors->first('email')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 rud_spa_1">
                                        <label class="control-label lblExtr" for="email">{!! trans('profile.password') !!} : </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <input type="password" class="form-control" value="" name="password" placeholder="********" autocomplete="new-password">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="purpose_field" name="type" value="0">
                    <div class="col-lg-12 pro-right exchange-profile edit-area" id="purpose_options" style="display:block">
                        <h2>{!! trans('profile.select_category') !!}:</h2><br>
                        <div class="row">
                            <div class="col-xs-6 col-md-3 purpose" style="cursor:pointer" id="adventurer"><img class="purpose_images" src="{{ asset('/img/adventurer.png') }}" data-toggle="tooltip" data-placement="top" title="{!! trans('profile.adventurer_title') !!}" >
                            <p>{!! trans('profile.adventurer') !!}</p></div>
                            <div class="col-xs-6 col-md-3 purpose" style="cursor:pointer" id="senior"><img  class="purpose_images" src="{{ asset('/img/senior.png') }}" data-toggle="tooltip" data-placement="top" title="{!! trans('profile.senior_title') !!}" >
                            <p>{!! trans('profile.senior') !!}</p></div>
                            <div class="col-xs-6 col-md-3 purpose" style="cursor:pointer" id="undecided"><img class="purpose_images" src="{{ asset('/img/undecided.png') }}" data-toggle="tooltip" data-placement="top" title="{!! trans('profile.undecided_title') !!}" >
                            <p>{!! trans('profile.undecided') !!}</p></div>
                            <div class="col-xs-6 col-md-3 purpose" style="cursor:pointer" id="onlooker"><img class="purpose_images" src="{{ asset('/img/curious.png') }}" data-toggle="tooltip" data-placement="top" title="{!! trans('profile.onlooker_title') !!}">
                                <p>{!! trans('profile.onlooker') !!}</p></div>
                        </div>
                    </div>

                    <div class="col-lg-12 pro-right exchange-profile edit-area" id="further_details" style="display:none">
                        <h2>{!! trans('profile.addition_information') !!}</h2><br>
                        <div class="profile-bio edit-area" id="experienced" style="display:block">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 rud_spa">
                                        <label class="control-label" >{!! trans('profile.program') !!}: </label>
                                    </div>
                                    <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12 radio_divs">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                    <input type="radio" class="program_exp form-control radio_profile" value="0" name="program_exp" {{ $exchangeDetail->program == 0 ? "checked" : "" }}>
                                                    {!! trans('profile.exchange') !!}
                                                </label>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>
                                                    <input type="radio" class="program_exp form-control radio_profile" value="1" name="program_exp" {{ $exchangeDetail->program == 1 ? "checked" : "" }}>
                                                    {!! trans('profile.full_time') !!}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 rud_spa">
                                        <label class="control-label" >{!! trans('profile.school_term') !!}: </label>
                                    </div>
                                    <div class="col-lg-9 col-xs-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-1">
                                                    <label>{!! trans('profile.from') !!}:</label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input name="term_from" type="text" class="form-control" placeholder="YYYY MM" id='term_from' value="{{ Carbon\Carbon::parse($exchangeDetail->term_from)->format('M Y') }}" />
                                                </div>
                                                <div class="col-sm-1">
                                                    <label>{!! trans('profile.to') !!}:</label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input name="term_to" type="text" class="form-control" placeholder="YYYY MM" id="term_to" value="{{ Carbon\Carbon::parse($exchangeDetail->term_to)->format('M Y') }}" />
                                                    <label class="error pError">{{$errors->first('term_to')}}</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group type3-4" {{ Input::old('type')=='3' || Input::old('type')=='4' || @$exchangeDetail->type=='3' || @$exchangeDetail->type=='4'?'style=display:none;':''}}>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 rud_spa">
                                        <label class="control-label" >{!! trans('profile.host_institution') !!}: </label>
                                    </div>
                                    <div class="col-sm-8 col-xs-12">
                                        {!! Form::select('hostUniversityID', array(""=>"Please select") + $hostUnivList,Input::old('hostUniversityID')!=''?Input::old('hostUniversityID'):(@$exchangeDetail->hostUniversity->id!=''?@$exchangeDetail->hostUniversity->id:''), array('id' =>
                                        'hostUniversityID','class'=>'form-control selectMenu', 'autocomplete'=>'off')) !!}
                                        <label class="error pError">{{$errors->first('hostUniversityID')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group type3-4 hostCountryBlk" {{ Input::old('type')=='3' || Input::old('type')=='4' || @$exchangeDetail->type=='3' || @$exchangeDetail->type=='4'?'style=display:none;':''}}>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 rud_spa">
                                        <label class="control-label " >{!! trans('profile.host_country') !!}: </label>
                                    </div>
                                    <div class="col-sm-8 col-xs-12">
                                        {!! Form::text('hostCountry',Input::old('hostCountry')!=''?Input::old('hostCountry'):(@$exchangeDetail->hostUniversity->city->country->countryName!=''?@$exchangeDetail->hostUniversity->city->country->countryName:''),array('id'=>'hostCountry','class'=>'form-control', 'readonly'=>'readonly')) !!}
                                    </div>
                                </div>
                            </div>
                            <div id="newHostUniversityDiv" class="form-group" style="display:{{ Input::old('hostUniversityID')=='1'?'block':'none'}};">
                                <label for="" class="control-label col-sm-3 "></label>
                                <div class="col-sm-9 col-xs-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">New Host Institution</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label for="" class="control-label col-sm-3 ">*Country:</label>
                                                <div class="col-sm-9 col-xs-12">
                                                    {!! Form::select('hostNewcountry', array(""=>"Please select") + $countryList,Input::old('hostNewcountry'), array('id' =>
                                                    'hostNewcountry','class'=>'form-control selectMenu', 'autocomplete'=>'off')) !!}
                                                    <label class="error pError">{{$errors->first('hostNewcountry')}}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="control-label col-sm-3 ">*City:</label>
                                                <div class="col-sm-9 col-xs-12">
                                                    {!! Form::text('hostcity',Input::old('hostcity'),array('id'=>'hostcity','class'=>'form-control')) !!}
                                                    <label class="error pError">{{$errors->first('hostcity')}}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="control-label col-sm-3 ">*Institution Name:</label>
                                                <div class="col-sm-9 col-xs-12">
                                                    {!!     Form::text('hostuniversityName',Input::old('hostuniversityName'),array('id'=>'hostuniversityName','class'=>'form-control')) !!}
                                                    <label class="error pError">{{$errors->first('hostuniversityName')}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-default">{!! trans('profile.submit') !!}</button>
                                    <a href="{{url('/home')}}" class="btn btn-default">{!! trans('profile.cancel') !!}</a>
                                </div>
                            </div>
                        </div>

                        <div class="profile-bio edit-area" id="newbies" style="display:none">

                            <div class="form-group" id="program_undecided">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <label class="control-label" >{!! trans('profile.program') !!} :</label>
                                    </div>
                                    <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12 radio_divs">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                <input type="radio" value="0" name="program" class="form-control radio_profile" {{ $exchangeDetail->program == 0 ? "checked" : "" }}>{!! trans('profile.exchange') !!}</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>
                                                <input type="radio" value="1" name="program" class="form-control radio_profile" {{ $exchangeDetail->program == 1 ? "checked" : "" }}>{!! trans('profile.full_time') !!}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <label class="control-label" >{!! trans('profile.are_you_interest') !!}</label>
                                        <p style="font-style: italic; background: none; margin-left: 15px;">{!! trans('profile.tip_1') !!} </p>
                                    </div>
                                    <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12 radio_divs">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="">
                                                <input type="radio" class="form-control radio_profile" id="buddy" value="1" name="buddy" {{ $exchangeDetail->buddy == 1 ? "checked" : "" }}>{!! trans('profile.yes') !!}</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                <input type="radio" class="form-control radio_profile" id="buddy" value="0" name="buddy" {{ $exchangeDetail->buddy == 0 ? "checked" : "" }}>{!! trans('profile.no') !!}</label>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                            </div>

                            <div class="form-group">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-default">{!! trans('profile.submit') !!}</button>
                                    <a href="{{url('/home')}}" class="btn btn-default">{!! trans('profile.cancel') !!}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <img src="{{ asset('/img/cloud.png') }}" class="img-back">
</div>

@stop

@section('scripts')

<script>
$(document).ready(function() {
    if($("#is_updated").val()=="Yes") {
        switch ($("#type_purpose").val()) {
            case "4":
                $("#purpose_field").attr("value", 4);
                $("#onlooker > .purpose_images").addClass("purpose_selected");
                //$("#purpose_options").hide();
                $("#further_details").show();
                $("#experienced").hide().find("input").removeAttr("required");
                $("#newbies").show().find("input").attr("required","required");
                $("#program_undecided").hide().find("input").removeAttr("required");
                break;
            case "3":
                $("#purpose_field").attr("value", 3);
                $("#undecided > .purpose_images").addClass("purpose_selected");
                //$("#purpose_options").hide();
                $("#further_details").show();
                $("#experienced").hide().find("input").removeAttr("required");
                $("#newbies").show().find("input").attr("required","required");
                $("#program_undecided").show().find("input").attr("required","required");
                break;
            case "1":
                $("#purpose_field").attr("value", 1);
                $("#adventurer > .purpose_images").addClass("purpose_selected");
                //$("#purpose_options").hide();
                $("#further_details").show();
                $("#newbies").hide().find("input").removeAttr("required");
                $("#experienced").show().find("input:not(#newHostUniversityDiv input, #hostCountry)").attr("required","required");
                break;
            case "2":
                $("#purpose_field").attr("value", 2);
                $("#senior > .purpose_images").addClass("purpose_selected");
                //$("#purpose_options").hide();
                $("#further_details").show();
                $("#experienced").show().find("input:not(#newHostUniversityDiv input, #hostCountry)").attr("required","required");
                $("#newbies").hide().find("input").removeAttr("required");
                break;
            default:
                break;
        }
    }

   // $(".combobox-container").find("input[type=text]").click(function(){$(this).siblings(".dropdown-toggle").click();})



});
</script>

@stop
