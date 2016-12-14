@extends('layouts.default')
@section('content')
<style>
    .detail-user-comment img.profileImg {
        width:100%;
        height:100%;
        border-radius:50%;
    }
</style>
<div class="university_banner_1">
    @if(!empty($universities->banner_image))
    <style>
        .university_banner_1{background:url( {{asset('/images/banner/')}}/{{$universities->banner_image}});}
    </style>
    @else
    <style>
        .university_banner_1{background:url(../img/Yonsei-University-1.jpg);}
    </style>
    @endif
</div>
<div class="tabs_nav detail-main-page">
    <div class="container-fluid">
        <div class="row">
            <!--Left Area-->
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="university-lft-1-outer">
                    <div class="university-lft-1">
                        <div class="sa_cu_blck">
                            <ul class="nav nav-pills">
                                <li class="change-unveristy"><a href="{{url(localization()->localizeURL('university')) }}">{!! trans('university_detail.change_university') !!} </a> </li>
                            </ul>
                        </div>
                        <div class="sa_cu_blck_1">
                            <div class="desktop-view">
                                <ul class="nav nav-pills nav-stacked">
                                    <li>
                                        <a href="{{url(localization()->localizeURL('/university/'))}}/{{$universities->id}}/{{$friendly_name}}">
                                            <div class="detail_side_bar">
                                                <img src="{{ asset('/img/University.png')}}" alt="img4"/>
                                            </div>
                                            {!! trans('university_detail.university') !!}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url(localization()->localizeURL('/university/'))}}/{{$universities->id}}/{{$friendly_name}}/Addinfo">
                                            <div class="detail_side_bar">
                                                <img src="{{ asset('/img/additional-info.png')}}" alt="img1"/>
                                            </div>
                                            {!! trans('university_detail.adding_information') !!}
                                        </a>
                                    </li>
                                    <li>
                                        <div class="current">{!! trans('university_detail.start_planning') !!}!</div>
                                    </li>
                                    <li>
                                        <a href="{{url(localization()->localizeURL('/university/'))}}/{{$universities->id}}/{{$friendly_name}}/Expenses">
                                            <div class="detail_side_bar">
                                                <img src="{{ asset('/img/expenses.png')}}" alt="img1"/>
                                            </div>
                                            {!! trans('university_detail.expenses') !!}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url(localization()->localizeURL('/university/'))}}/{{$universities->id}}/{{$friendly_name}}/Flight">
                                            <div class="detail_side_bar">
                                                <img src="{{ asset('/img/Flight.png')}}" alt="img1"/>
                                            </div>
                                            {!! trans('university_detail.flight') !!}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url(localization()->localizeURL('/university/'))}}/{{$universities->id}}/{{$friendly_name}}/Accommodation">
                                            <div class="detail_side_bar">
                                                <img src="{{ asset('/img/Accommodation.png')}}" alt="img1"/>
                                            </div>
                                            {!! trans('university_detail.accommodation') !!}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url(localization()->localizeURL('/university/'))}}/{{$universities->id}}/{{$friendly_name}}/VISA">
                                            <div class="detail_side_bar">
                                                <img src="{{ asset('/img/visa.png')}}" alt="img1"/>
                                            </div>
                                            {!! trans('university_detail.visa') !!}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url(localization()->localizeURL('/university/'))}}/{{$universities->id}}/{{$friendly_name}}/Travel">
                                            <div class="detail_side_bar">
                                                <img src="{{ asset('/img/Travel-insurance.png')}}" alt="img1"/>
                                            </div>
                                            {!! trans('university_detail.travel_insurance') !!}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url(localization()->localizeURL('/university/'))}}/{{$universities->id}}/{{$friendly_name}}/Packing">
                                            <div class="detail_side_bar">
                                                <img src="{{ asset('/img/packing.png')}}" alt="img1"/>
                                            </div>
                                            {!! trans('university_detail.packing') !!}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="mobile-view">
                                <ul class="nav nav-pills nav-stacked">
                                    <li>        <a href="{{url(localization()->localizeURL('/university/'))}}/{{$universities->id}}/{{$friendly_name}}#uni">               <div class="detail_side_bar">   <img src="{{ asset('/img/University.png')}}" alt="img4"/> </div>
                                {!! trans('university_detail.university') !!}</a></li>
                                <li>
                                    <a href="{{url(localization()->localizeURL('/university/'))}}/{{$universities->id}}/{{$friendly_name}}/Addinfo#test">
                                        <div class="detail_side_bar">
                                            <img src="{{ asset('/img/additional-info.png')}}" alt="img1"/>
                                        </div> {!! trans('university_detail.adding_information') !!}
                                    </a>
                                </li>
                                <li><div class="current">{!! trans('university_detail.start_planning') !!}</div></li>
                                <li> <a href="{{url(localization()->localizeURL('/university/'))}}/{{$universities->id}}/{{$friendly_name}}/Expenses#expenses">
                                    <div class="detail_side_bar">
                                        <img src="{{ asset('/img/expenses.png')}}" alt="img1"/>
                                    </div>
                                {!! trans('university_detail.expenses') !!}</a>
                            </li>
                            <li><a href="{{url(localization()->localizeURL('/university/'))}}/{{$universities->id}}/{{$friendly_name}}/Flight#flight">
                                <div class="detail_side_bar">
                                    <img src="{{ asset('/img/Flight.png')}}" alt="img1"/>
                                </div>
                            {!! trans('university_detail.flight') !!}</a></li>
                            <li><a href="{{url(localization()->localizeURL('/university/'))}}/{{$universities->id}}/{{$friendly_name}}/Accommodation#acco">
                                <div class="detail_side_bar">
                                    <img src="{{ asset('/img/Accommodation.png')}}" alt="img1"/>
                                </div>
                            {!! trans('university_detail.accommodation') !!}</a></li>
                            <li> <a href="{{url(localization()->localizeURL('/university/'))}}/{{$universities->id}}/{{$friendly_name}}/VISA#visa">
                                <div class="detail_side_bar">   <img src="{{ asset('/img/visa.png')}}" alt="img1"/>  </div>
                            {!! trans('university_detail.visa') !!}</a></li>
                            <li><a href="{{url(localization()->localizeURL('/university/'))}}/{{$universities->id}}/{{$friendly_name}}/Travel#travel">
                                <div class="detail_side_bar"> <img src="{{ asset('/img/Travel-insurance.png')}}" alt="img1"/>   </div>
                            {!! trans('university_detail.travel_insurance') !!}</a></li>
                            <li> <a href="{{url(localization()->localizeURL('/university/'))}}/{{$universities->id}}/{{$friendly_name}}/Packing#packing">
                                <div class="detail_side_bar">   <img src="{{ asset('/img/packing.png')}}" alt="img1"/>  </div>
                            {!! trans('university_detail.packing') !!}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/Left Area-->
    <!--Right Area-->
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pd" >
        <div class="right-outer">
            @if($param=='' || $param=='university')
            <div class="row" id="uni">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                    <div class="deatil-tabs">
                        <ul class="nav nav-pills">
                            <li class="active"><a data-toggle="pill" href="#home">{!! trans('university_detail.overview') !!} </a></li>
                            <li><a data-toggle="pill" href="#menu1">{!! trans('university_detail.academics') !!}</a></li>
                            <li><a data-toggle="pill" href="#menu2">{!! trans('university_detail.my_campus') !!}</a></li>
                            <li><a data-toggle="pill" href="#menu3" >{!! trans('university_detail.student_life') !!}</a></li>
                            <li><a data-toggle="pill" href="#menu4">{!! trans('university_detail.surrounding_environment') !!}</a></li>
                            <li><a data-toggle="pill" href="#menu5">{!! trans('university_detail.accessibility') !!}</a></li>
                        </ul>
                    </div>
                    <div class="tab-content tabUlChange">
                        <div id="home" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="table-responsive"><table class="table table-striped"><p><?php echo html_entity_decode(@$universities->Overview); ?></p></table></div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="univ_part">
                                        @if(!empty($universities->image))
                                        <img src="{{asset('/images/universities')}}/{{$universities->image}}" alt="img2"/>
                                        @else
                                        <img src="{{asset('/img/univer_gener_logo.png')}}" alt="img2"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="table-responsive"> <table class="table table-striped"><p><?php echo html_entity_decode(@$universities->Academics) ; ?> </p></table></div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="univ_part">
                                        @if(!empty($universities->image))
                                        <img src="{{asset('/images/universities')}}/{{$universities->image}}" alt="img2"/>
                                        @else
                                        <img src="{{asset('/img/univer_gener_logo.png')}}" alt="img2"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="table-responsive"> <table class="table table-striped"> <p><?php echo html_entity_decode(@$universities->MyCampus); ?></p></table></div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="univ_part">
                                        @if(!empty($universities->image))
                                        <img src="{{asset('/images/universities')}}/{{$universities->image}}" alt="img2"/>
                                        @else
                                        <img src="{{asset('/img/univer_gener_logo.png')}}" alt="img2"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu3" class="tab-pane fade">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="table-responsive"><table class="table table-striped"> <p><?php echo html_entity_decode(@$universities->Studentlife); ?></p></table></div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="univ_part">
                                        @if(!empty($universities->image))
                                        <img src="{{asset('/images/universities')}}/{{$universities->image}}" alt="img2"/>
                                        @else
                                        <img src="{{asset('/img/univer_gener_logo.png')}}" alt="img2"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu4" class="tab-pane fade">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="table-responsive"><table class="table table-striped">  <p><?php echo html_entity_decode(@$universities->Surrounding); ?></p>
                                </table></div></div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="univ_part">
                                        @if(!empty($universities->image))
                                        <img src="{{asset('/images/universities')}}/{{$universities->image}}" alt="img2"/>
                                        @else
                                        <img src="{{asset('/img/univer_gener_logo.png')}}" alt="img2"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu5" class="tab-pane fade">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="table-responsive"><table class="table table-striped">  <p><?php echo html_entity_decode(@$universities->Accessibility);?></p></table></div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="univ_part">
                                        @if(!empty($universities->image))
                                        <img src="{{asset('/images/universities')}}/{{$universities->image}}" alt="img2"/>
                                        @else
                                        <img src="{{asset('/img/univer_gener_logo.png')}}" alt="img2"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($param=='Addinfo')
            <div class="row"  id="test">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                    <div class="deatil-tabs">
                        <ul class="nav nav-pills">
                            <li class="active"><a data-toggle="pill" href="#home">{!! trans('university_detail.transportation') !!} </a></li>
                            <li><a data-toggle="pill" href="#menu1">{!! trans('university_detail.banking_services') !!}</a></li>
                            <li><a data-toggle="pill" href="#menu2">{!! trans('university_detail.post_office_services') !!}</a></li>
                            <li><a data-toggle="pill" href="#menu3">{!! trans('university_detail.medical_services') !!}</a></li>
                            <li><a data-toggle="pill" href="#menu4">{!! trans('university_detail.telecommunications') !!} </a></li>
                            <li><a data-toggle="pill" href="#menu5">{!! trans('university_detail.survival_guide') !!}</a></li>
                        </ul>
                    </div>
                    <div class="tab-content tabUlChange">
                        <div id="home" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="table-responsive"><table class="table table-striped"> <p><?php echo html_entity_decode(@$universities->universitycontent->Transportation); ?></p></table></div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="univ_part">
                                        @if(!empty($universities->image))
                                        <img src="{{asset('/images/universities')}}/{{$universities->image}}" alt="img2"/>
                                        @else
                                        <img src="{{asset('/img/univer_gener_logo.png')}}" alt="img2"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="table-responsive"><table class="table table-striped"> <p><?php echo html_entity_decode(@$universities->universitycontent->BankingServices) ; ?> </p></table></div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="univ_part">
                                        @if(!empty($universities->image))
                                        <img src="{{asset('/images/universities')}}/{{$universities->image}}" alt="img2"/>
                                        @else
                                        <img src="{{asset('/img/univer_gener_logo.png')}}" alt="img2"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="table-responsive"> <table class="table table-striped"> <p><?php echo html_entity_decode(@$universities->universitycontent->postoffice); ?></p></table></div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="univ_part">
                                        @if(!empty($universities->image))
                                        <img src="{{asset('/images/universities')}}/{{$universities->image}}" alt="img2"/>
                                        @else
                                        <img src="{{asset('/img/univer_gener_logo.png')}}" alt="img2"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu3" class="tab-pane fade">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="table-responsive"><table class="table table-striped"> <p><?php echo html_entity_decode(@$universities->universitycontent->medicalservices); ?></p></table></div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="univ_part">
                                        @if(!empty($universities->image))
                                        <img src="{{asset('/images/universities')}}/{{$universities->image}}" alt="img2"/>
                                        @else
                                        <img src="{{asset('/img/univer_gener_logo.png')}}" alt="img2"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu4" class="tab-pane fade">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="table-responsive"><table class="table table-striped"> <p><?php echo html_entity_decode(@$universities->universitycontent->Telecommunications); ?></p></table></div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="univ_part">
                                        @if(!empty($universities->image))
                                        <img src="{{asset('/images/universities')}}/{{$universities->image}}" alt="img2"/>
                                        @else
                                        <img src="{{asset('/img/univer_gener_logo.png')}}" alt="img2"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu5" class="tab-pane fade">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="table-responsive"> <table class="table table-striped"> <p><?php echo html_entity_decode(@$universities->universitycontent->SurvivalGuide);?></p></table></div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="univ_part">
                                        @if(!empty($universities->image))
                                        <img src="{{asset('/images/universities')}}/{{$universities->image}}" alt="img2"/>
                                        @else
                                        <img src="{{asset('/img/univer_gener_logo.png')}}" alt="img2"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($param=='Expenses')
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                    <div class="deatil-tabs" id="expenses">
                        <ul class="nav nav-pills">
                            <li class="active"><a data-toggle="pill" href="#home">Consolidated</a></li>
                        </ul>
                    </div>
                    <div class="tab-content tabUlChange">
                        <div id="home" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="table-responsive"><table class="table table-striped"> <p><?php echo html_entity_decode(@$universities->Consolidated); ?></p></table></div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="univ_part">
                                        @if(!empty($universities->image))
                                        <img src="{{asset('/images/universities')}}/{{$universities->image}}" alt="img2"/>
                                        @else
                                        <img src="{{asset('/img/univer_gener_logo.png')}}" alt="img2"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($param=='Flight')
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                    <div class="deatil-tabs" id="flight">
                        <ul class="nav nav-pills">
                            <li class="active"><a data-toggle="pill" href="#home">{!! trans('university_detail.airlines') !!}</a></li>
                        </ul>
                    </div>
                    <div class="tab-content tabUlChange">
                        <div id="home" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="table-responsive"><table class="table table-striped"> <p><?php echo html_entity_decode(@$universities->Airlines); ?></p></table></div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="univ_part">
                                        @if(!empty($universities->image))
                                        <img src="{{asset('/images/universities')}}/{{$universities->image}}" alt="img2"/>
                                        @else
                                        <img src="{{asset('/img/univer_gener_logo.png')}}" alt="img2"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($param=='Accommodation')
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                    <div class="deatil-tabs" id="acco">
                        <ul class="nav nav-pills">
                            <li class="active"><a data-toggle="pill" href="#home">{!! trans('university_detail.accommodation') !!}</a></li>
                        </ul>
                    </div>
                    <div class="tab-content tabUlChange">
                        <div id="home" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="table-responsive"><table class="table table-striped"> <p><?php echo html_entity_decode(@$universities->Accommodation); ?></p></table></div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="univ_part">
                                        @if(!empty($universities->image))
                                        <img src="{{asset('/images/universities')}}/{{$universities->image}}" alt="img2"/>
                                        @else
                                        <img src="{{asset('/img/univer_gener_logo.png')}}" alt="img2"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($param=='VISA')
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                    <div class="deatil-tabs" id="visa">
                        <ul class="nav nav-pills">
                            <li class="active"><a data-toggle="pill" href="#home">{!! trans('university_detail.visa') !!}</a></li>
                        </ul>
                    </div>
                    <div class="tab-content tabUlChange">
                        <div id="home" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="table-responsive"><table class="table table-striped"> <p><?php echo html_entity_decode(@$universities->visa); ?></p></table></div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="univ_part">
                                        @if(!empty($universities->image))
                                        <img src="{{asset('/images/universities')}}/{{$universities->image}}" alt="img2"/>
                                        @else
                                        <img src="{{asset('/img/univer_gener_logo.png')}}" alt="img2"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($param=='Travel')
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                    <div class="deatil-tabs" id="travel">
                        <ul class="nav nav-pills">
                            <li class="active"><a data-toggle="pill" href="#home">{!! trans('university_detail.travel_insurance') !!}</a></li>
                        </ul>
                    </div>
                    <div class="tab-content tabUlChange">
                        <div id="home" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="table-responsive"><table class="table table-striped"> <p><?php echo html_entity_decode(@$universities->TravelInsurance); ?></p></table></div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="univ_part">
                                        @if(!empty($universities->image))
                                        <img src="{{asset('/images/universities')}}/{{$universities->image}}" alt="img2"/>
                                        @else
                                        <img src="{{asset('/img/univer_gener_logo.png')}}" alt="img2"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($param=='Packing')
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                    <div class="deatil-tabs" id="packing">
                        <ul class="nav nav-pills">
                            <li class="active"><a data-toggle="pill" href="#home">{!! trans('university_detail.packing') !!}</a></li>
                        </ul>
                    </div>
                    <div class="tab-content tabUlChange">
                        <div id="home" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="table-responsive"><table class="table table-striped"> <?php echo html_entity_decode(@$universities->pck_cntn); ?></table></div>
                                    <p><a href="{{url('/download/')}}/{{$universities->Packing}}" target="_blank">Download PDF</a></p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="univ_part">
                                        @if(!empty($universities->image))
                                        <img src="{{asset('/images/universities')}}/{{$universities->image}}" alt="img2"/>
                                        @else
                                        <img src="{{asset('/img/univer_gener_logo.png')}}" alt="img2"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!--Submit Start-->
            <div class="submit-area">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 review-borde">
                        <div class="contribute-text">
                            <form method="post" action="{{ url(localization()->localizeURL('/university/review')) }}" id="reviews">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pd">
                                        <h2 class="text-center" style="text-transform: none !important; font-weight: 700; color: #ff7c00;">{!! trans('university_detail.write_a_review') !!}</h2>
                                        <div class="detail-submit">
                                            <?php $data = Session::all(); ?>
                                            @if ($isUserAddedExchange!=0)
                                            <textarea name="message" rows="4" cols="50" placeholder="{!! trans('university_detail.review_hint') !!}" onclick="this.placeholder = ''"></textarea>
                                            <input type="hidden" value="{{$universities->id}}" name="universityid" />
                                            <input type="hidden" value="<?php echo $data['login_82e5d2c56bdd0811318f0cf078b78bfc']; ?>" name="userid" />
                                            @elseif (array_key_exists("login_82e5d2c56bdd0811318f0cf078b78bfc", $data))
                                            <textarea name="message" rows="4" cols="50" placeholder="{!! trans('university_detail.review_hint') !!}" readonly onclick="showError('Please update your profile so that other students can identify your review!', 5000);"></textarea>
                                            @else
                                            <textarea name="message" rows="4" cols="50" placeholder="{!! trans('university_detail.review_hint') !!}" readonly onclick="showError('{!! trans('university_detail.login_to_review') !!}', 5000);"></textarea>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pd" >
                                    @if ($isUserAddedExchange!=0)
                                        <div class="submit-btn-detail pull-right">
                                            <a href="javascript:void()" onclick="document.getElementById('reviews').submit();">Submit</a>
                                        </div>
                                    @endif
                                    </div>
                                </div>
                                @foreach($universities->reviews as $comment)
                                <!--User Comment Area End-->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pd" >
                                        <div class="comment-area-user">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" >
                                                    <div class="detail-user-comment">
                                                        <?php
                                                        if(!empty($comment->userdetail->avatar)){
                                                            if((strpos($comment->userdetail->avatar,'http://')!== false || strpos($comment->userdetail->avatar,'https://')!== false)) {
                                                                $imgSrc = str_replace('=normal','=large',$comment->userdetail->avatar);
                                                        ?>
                                                        <img src="<?php echo str_replace('=normal','=large&width=200&height=200',$comment->userdetail->avatar) ?> " class="profileImg">
                                                        <?php /*<img src="{{ Image::resize('$imgSrc', 200, 200) }}" class="profileImg">*/ ?>
                                                        <?php    }else { ?>
                                                        <img src="{{ asset('/img/memberImages/')}}/{{ $comment->userdetail->avatar }}"  class="profileImg">
                                                        <?php    }
                                                        }else{ ?>
                                                        <img src="{{ asset('/img/Flying_profile_review.png') }}" >
                                                        <?php } ?>
                                                    </div>
                                                    <p class="user-com">{{@$comment->userdetail->fname}} {{@$comment->userdetail->lname}}</p>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12" >
                                                    <div class="arrow-left-icon"><img src="{{asset('/img/left-arrow.png')}}"></div>
                                                    <div class="meassge-box">
                                                    <h3>{!! trans('university_detail.reviewed') !!} <span>{{date('d-m-Y',strtotime(@$comment->created_at))}}</span></h3>
                                                        <div class="top-msg"></div>
                                                        <p><?php echo nl2br(@$comment->message); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--User Comment Area End-->
                                @endforeach
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" >
                        <p class="detail-img-p"> {!! trans('university_detail.seek_advice_question') !!} <a href="{{url(localization()->localizeURL('/community'))}}">{!! trans('university_detail.seek_advice') !!}</a></p>
                    </div>
                </div>
            </div>
            <!--Submit end-->
        </div>
        <!--Right Outer-->
    </div>
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
    </div>
    <!--/Right Area-->
</div>
</div>
@stop
