@extends('layouts.default')

@section('content')

{!! HTML::style('/css/connect.css?v=1.0') !!}

<div class="container-fluid responsive-text">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_0">
            <div class="connect_banner_inner">
                <div class="col-xs-12" id="banner_text">
                    <p class="font-size-42 margin-bottom-10" id="top_title">{!! trans('community.caption') !!}</p>
                    <div class="row">
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                            <p class="font-size-17 margin-bottom-15">{!! trans('community.overview_1') !!}</p>
                        <p class="font-size-17">{!! str_replace('{totalUniversities}', 80, str_replace('{totalUsers}', number_format(App\User::count()), trans('community.overview_2'))) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tab-section">
    <div class="container" style="width: 100% !important;">
        <div class="col-sm-3">
            <form class="form-horizontal" role="form" id="connect-search">
                <label id="type-label">{!! trans('community.type') !!}:</label>
                @if (Auth::guest())
                    <form></form>
                    <div class="form-group">
                        <div class="col-xs-12 form-filter checkbox-filter checkbox disabled">
                            {!! Form::checkbox('program', 2, true, ['id' => 'all', 'class' => 'disabled', 'onclick' => 'return false;']) !!}
                            <label class="control-label" for="all">{!! trans('community.all') !!}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 form-filter checkbox-filter checkbox">
                            {!! Form::checkbox('program', 0, true, ['id' => 'exchange', 'class' => 'disabled', 'onclick' => 'return false;']) !!}
                            <label class="control-label" for="exchange">{!! trans('community.exchange') !!}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 form-filter checkbox-filter checkbox">
                            {!! Form::checkbox('program', 1, true, ['id' => 'international', 'class' => 'disabled', 'onclick' => 'return false;']) !!}
                            <label class="control-label" for="international">{!! trans('community.international') !!}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label hint-label keyword-label" for="">{!! trans('community.search_keyword') !!}:</label>
                        <div class="form-filter">
                            <input type="text" class="form-control disabled" id="exchangeKeyword" placeholder="{!! trans('community.enter_keyword') !!}" style="background: none;" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label hint-label" for="">{!! trans('community.host_country') !!}:</label>
                        <div class="form-filter">
                            {!! Form::select('hostCountryC', ['' => trans('community.please_select')] + $countryList, Input::old('hostCountryC'), array('id' => 'hostCountryC', 'class' => 'form-control selectMenu disabled', 'autocomplete' => 'off', 'readonly' => 'true')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label hint-label" for="">{!! trans('community.host_institution') !!}:</label>
                        <div class="form-filter">
                            {!! Form::select('homeUniv', ['' => trans('community.please_select')], Input::old('hostUniv'), array('id' => 'hostUniv', 'class' => 'form-control selectMenu disabled', 'autocomplete' => 'off', 'readonly' => 'true')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label hint-label" for="">{!! trans('community.home_country') !!}:</label>
                        <div class="form-filter">
                            {!! Form::select('homeCountryC', ['' => trans('community.please_select')] + $countryList, Input::old('homeCountryC'), array('id' => 'homeCountryC', 'class' => 'form-control selectMenu disabled', 'autocomplete' => 'off', 'readonly' => 'true')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label hint-label" for="">{!! trans('community.home_institution') !!}:</label>
                        <div class="form-filter">
                            {!! Form::select('homeUniv', ['' => trans('community.please_select')], Input::old('homeUniv'), array('id' => 'homeUniv', 'class' => 'form-control selectMenu disabled', 'autocomplete' => 'off', 'readonly' => 'true')) !!}
                        </div>
                    </div>
                    <div class="form-group" id="term">
                        <label class="control-label hint-label" for="">{!! trans('community.student_term') !!}:</label>
                        <div class="form-filter">
                            <div class="row">
                                <div class="col-xs-5 term-left">
                                    <input name="term_from" type="text" class="form-control disabled" placeholder="MMM YYYY" value="" style="background: none;" readonly/>
                                </div>
                                <div class="col-xs-2 to">{!! trans('community.to') !!}</div>
                                <div class="col-xs-5 term-right">
                                    <input name="term_to" type="text" class="form-control disabled" placeholder="MMM YYYY" value="" style="background: none;" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <form>
                    </form>
                    <div class="form-group">
                        <div class="col-xs-12 form-filter checkbox-filter checkbox checkbox-success">
                            {!! Form::checkbox('program', 2, true, ['id' => 'all']) !!}
                            <label class="control-label" for="all">{!! trans('community.all') !!}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 form-filter checkbox-filter checkbox checkbox-success">
                            {!! Form::checkbox('program', 0, true, ['id' => 'exchange']) !!}
                            <label class="control-label" for="exchange">{!! trans('community.exchange') !!}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 form-filter checkbox-filter checkbox checkbox-success">
                            {!! Form::checkbox('program', 1, true, ['id' => 'international']) !!}
                            <label class="control-label" for="international">{!! trans('community.international') !!}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label hint-label keyword-label" for="">{!! trans('community.search_keyword') !!}:</label>
                        <div class="form-filter">
                            <input type="text" class="form-control" id="exchangeKeyword" placeholder="{!! trans('community.enter_keyword') !!}">
                        </div>
                    </div>
                    <div id="host-filters">
                        <div class="tab-3-display">
                            <label class="filter-hint-locals">{!! trans('community.students_have_been') !!}:</label>
                        </div>
                        <div class="form-group" id="hostCountrySelect">
                            <label class="control-label hint-label tab-3-hidden" for="">{!! trans('community.host_country') !!}:</label>
                            <label class="control-label hint-label tab-3-display" for="">{!! trans('community.country') !!}:</label>
                            <div class="form-filter">
                                {!! Form::select('hostCountryC', ['' => trans('community.please_select')] + $countryList, Input::old('hostCountryC'), array('id' => 'hostCountryC','class' => 'form-control selectMenu', 'autocomplete' => 'off')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label hint-label tab-3-hidden" for="">{!! trans('community.host_institution') !!}:</label>
                            <label class="control-label hint-label tab-3-display" for="">{!! trans('community.university') !!}:</label>
                            <div class="form-filter">
                                {!! Form::select('homeUniv', ['' => trans('community.please_select')] + $hostUnivList, Input::old('hostUniv'), array('id' => 'hostUniv', 'class' => 'form-control selectMenu', 'autocomplete' => 'off')) !!}
                            </div>
                        </div>
                    </div>
                    <div id="home-filters">
                        <div class="tab-3-display">
                            <label class="filter-hint-locals">{!! trans('community.students_in') !!}:</label>
                        </div>
                        <div class="form-group" id="homeCountrySelect">
                            <label class="control-label hint-label tab-3-hidden" for="">{!! trans('community.home_country') !!}:</label>
                            <label class="control-label hint-label tab-3-display" for="">{!! trans('community.country') !!}:</label>
                            <div class="form-filter">
                                {!! Form::select('homeCountryC', ['' => trans('community.please_select')] + $countryList, Input::old('homeCountryC'), array('id' => 'homeCountryC', 'class' => 'form-control selectMenu', 'autocomplete' => 'off')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label hint-label tab-3-hidden" for="">{!! trans('community.home_institution') !!}:</label>
                            <label class="control-label hint-label tab-3-display" for="">{!! trans('community.university') !!}:</label>
                            <div class="form-filter">
                                {!! Form::select('homeUniv', ['' => trans('community.please_select')] + $homeUnivList, Input::old('homeUniv'), array('id' => 'homeUniv', 'class' => 'form-control selectMenu', 'autocomplete' => 'off')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="term">
                        <label class="control-label hint-label" for="">{!! trans('community.student_term') !!}:</label>
                        <div class="form-filter">
                            <div class="row">
                                <div class="col-xs-5 term-left">
                                    <input name="term_from" type="text" class="form-control" placeholder="MMM YYYY" id='term_from' value="" />
                                </div>
                                <div class="col-xs-2 to">{!! trans('community.to') !!}</div>
                                <div class="col-xs-5 term-right">
                                    <input name="term_to" type="text" class="form-control" placeholder="MMM YYYY" id="term_to" value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="reset-filters"><a href="javascript:void(0);" id="reset-link">{!! trans('community.clear_filters') !!}</a></div>
                @endif
            </form>
        </div>
        <div class="tab-content col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">{!! trans('community.peers') !!}</a></li>
                <li><a data-toggle="tab" href="#menu1">{!! trans('community.seniors') !!}</a></li>
                <li><a data-toggle="tab" href="#menu2">{!! trans('community.locals') !!}</a></li>
            </ul>
            <div id="home" class="tab-pane fade in active">
                <div class="row" id="listdatah">
                    @include('users.connect-peers')
                </div>
            </div>
            <div id="menu1" class="tab-pane fade">
                <div class="row" id="listdata">
                    @include('users.connect-seniors')
                </div>
            </div>
            <div id="menu2" class="tab-pane fade">
                <div class="row" id="listdata2">
                    @include('users.connect-locals')
                </div>
            </div>
            <div id="loading_image" class="col-lg-12 text-center noRecordFound"><img src="{{ asset("img/rolling.gif") }}" /> </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="requestPopUp" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{!! trans('community.modal_title') !!}
                </h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('route' => 'requestsend.store','id'=>'requestForm','tokan'=>csrf_token())) !!}
                {!! Form::hidden('_tokan',null,array('id'=>'tokan','class'=>'form-control')) !!}
                {!! Form::hidden('uId',null,array('id'=>'uId','class'=>'form-control')) !!}
                {!! Form::hidden('toId',null,array('id'=>'toId','class'=>'form-control')) !!}
                {!! Form::hidden('reqType',null,array('id'=>'reqType','class'=>'form-control')) !!}
                <label>{!! trans('community.message') !!}:</label>
                    {!! Form::textarea('message',null,array('id'=>'message','class'=>'form-control required','maxlengt'=>'400')) !!}
                <p style="float:left;font-size: 11px;"><span id="countChar">{!! trans('community.total') !!}:400 {!! trans('community.characters') !!}</span></p>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="return sendRequest(this);">{!! trans('community.submit') !!}</button>
                <button type="button" class="btn btn-default closeModal" data-dismiss="modal">{!! trans('community.cancel') !!}</button>
            </div>
        </div>
    </div>
</div>
@stop
@section('scripts')

<script type="text/javascript">
$(function () {
    @if (Auth::guest())
        var filters = document.getElementsByClassName("form-filter");
        for (var i = 0; i < filters.length; i++) {
            filters[i].onclick = function() {
                showError('Please log in to access the filters and connect with other students!', 3000);
                $('html, body').animate({scrollTop : 0}, 800);
            };
        }
    @else
        $('#all').click(function () {
            if ($(this).is(':checked')) {
                $('#exchange').prop('checked', true);
                $('#international').prop('checked', true);
            } else {
                $('#exchange').prop('checked', false);
                $('#international').prop('checked', false);
            }
        });
        $('#exchange').click(function () {
            if ($(this).is(':checked')) {
                if ($('#international').is(':checked')) {
                    $('#all').prop('checked', true);
                } else {
                    $('#all').prop('checked', false);
                }
            } else {
                $('#all').prop('checked', false);
            }
        });
        $('#international').click(function () {
            if ($(this).is(':checked')) {
                if ($('#exchange').is(':checked')) {
                    $('#all').prop('checked', true);
                } else {
                    $('#all').prop('checked', false);
                }
            } else {
                $('#all').prop('checked', false);
            }
        });

        $('#reset-link').click(function (e) {
            $('#all').prop('checked', true);
            $('#exchange').prop('checked', true);
            $('#international').prop('checked', true);
            $('#exchangeKeyword').val('');
            $('#hostCountryC').data('combobox').clearTarget();
            $('#hostCountryC').data('combobox').clearElement();
            $('#hostUniv').data('combobox').clearTarget();
            $('#hostUniv').data('combobox').clearElement();
            $('#homeCountryC').data('combobox').clearTarget();
            $('#homeCountryC').data('combobox').clearElement();
            $('#homeUniv').data('combobox').clearTarget();
            $('#homeUniv').data('combobox').clearElement();
            $('#term_from').val('');
            $('#term_to').val('');
            searchAndRefresh();
        });

        @if (@$_GET['from'] == 'email')
            window.setTimeout(function () {
                var list = $('#message_notify').data('list');
                var friendsList = JSON.parse(list.friends_list);
                friendsList.forEach(function(friend) {
                    if (friend.msgcount > 0) {
                        register_popup(friend.id, friend.fname + ' ' + friend.lname, btoa(JSON.stringify(friend)), friend.requestId);
                    }
                });
            }, 2000);
        @endif
    @endif

    $(window).scroll(function() {
        if (Refreshing) return;
        if($(window).scrollTop() >= $(document).height() - $(window).height()*5) {
            Refreshing = 1;
            refreshData();
        }
    });



    $('#hostCountryC').bind('change', function () {
        $('#hostUniv').empty();
        $('#hostUniv').data('combobox').refresh();
        $('#hostUniv').append($('<option>').val('').html(''));

        if ($(this).val() == '') {
            $.ajax({
                type: 'GET',
                url: '/ajax/getAllUniversities',
                dataType: 'json',
                success: function(result) {
                    $.each(result, function(i, value) {
                        $('#hostUniv').append($('<option>').val(value.universityname).html(value.universityname));
                    });
                    $('#hostUniv').data('combobox').refresh();
                    $('#hostUniv').data('combobox').clearTarget();
                    $('#hostUniv').data('combobox').clearElement();
                }
            });
        } else {
            $.ajax({
                type: 'GET',
                url: '/ajax/getUniversitiesByCountry',
                data: {'name': $(this).val()},
                dataType: 'json',
                success: function(result) {
                    $.each(result, function(i, value) {
                        $('#hostUniv').append($('<option>').val(value.id).html(value.universityname));
                    });
                    $('#hostUniv').data('combobox').refresh();
                    $('#hostUniv').data('combobox').clearTarget();
                    $('#hostUniv').data('combobox').clearElement();
                }
            });
        }
    });

    $('#homeCountryC').bind('change', function () {
        $('#homeUniv').empty();
        $('#homeUniv').data('combobox').refresh();
        $('#homeUniv').append($('<option>').val('').html(''));

        if ($(this).val() == '') {
            $.ajax({
                type: 'GET',
                url: '/ajax/getAllUniversities',
                dataType: 'json',
                success: function(result) {
                    $.each(result, function(i, value) {
                        $('#homeUniv').append($('<option>').val(value.universityname).html(value.universityname));
                    });
                    $('#homeUniv').data('combobox').refresh();
                    $('#homeUniv').data('combobox').clearTarget();
                    $('#homeUniv').data('combobox').clearElement();
                }
            });
        } else {
            $.ajax({
                type: 'GET',
                url: '/ajax/getUniversitiesByCountry',
                data: {'name': $(this).val()},
                dataType: 'json',
                success: function(result) {
                    $.each(result, function(i, value) {
                        $('#homeUniv').append($('<option>').val(value.id).html(value.universityname));
                    });
                    $('#homeUniv').data('combobox').refresh();
                    $('#homeUniv').data('combobox').clearTarget();
                    $('#homeUniv').data('combobox').clearElement();
                }
            });
        }
    });

    $('.glyphicon-remove').click(function () {
        var countrySelectId = $(this).parents('.form-group').attr('id');

        if (countrySelectId == 'hostCountrySelect') {
            $('#hostUniv').data('combobox').clearTarget();
            $('#hostUniv').data('combobox').clearElement();
        } else if (countrySelectId == 'homeCountrySelect') {
            $('#homeUniv').data('combobox').clearTarget();
            $('#homeUniv').data('combobox').clearElement();
        }
    });

});
</script>
@stop
