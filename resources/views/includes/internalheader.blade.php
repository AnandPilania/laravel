<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<style type="text/css">
.outer-inner-Pageheader{ width:100%; float:left; min-height:75px;}
.outer-inner-Pageheader .inner-Pageheader{ background:#ffffff; min-height:75px}
.outer-inner-Pageheader .affix{ z-index:9999;}
.gap{ width: 100%; float: left; min-height:78px;}
.user-profile-open > #user-profile-menu:focus {    color: #212121;}

.sidebar-nav {
    padding: 9px 0;
}

.dropdown-menu .sub-menu {
    left: 100%;
    position: absolute;
    top: 0;
    visibility: hidden;
    margin-top: -1px;
}

.dropdown-menu li:hover .sub-menu {
    visibility: visible;
}

.dropdown:hover .dropdown-menu {
    display: block;
}

.nav-tabs .dropdown-menu, .nav-pills .dropdown-menu, .navbar .dropdown-menu {
    margin-top: 0;
}

.navbar .sub-menu:before {
    border-bottom: 7px solid transparent;
    border-left: none;
    border-right: 7px solid rgba(0, 0, 0, 0.2);
    border-top: 7px solid transparent;
    left: -7px;
    top: 10px;
}
.navbar .sub-menu:after {
    border-top: 6px solid transparent;
    border-left: none;
    border-right: 6px solid #fff;
    border-bottom: 6px solid transparent;
    left: 10px;
    top: 11px;
    left: -6px;
}
</style>
@if (@$_GET['from'] == 'email' && Auth::user())
    <script>
        if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
            window.location.href = ajax_url+'friendslist';
        }
    </script>
@endif
<div class="gap gap-cms">
    <div class="outer-inner-Pageheader">
        <div class="inner-Pageheader">
            @include('includes.top-alert')
             {{-- <div class="arrow-down"><img alt="" src="{{ asset('/img/dwn-arw.png') }}"></div> --}}
             <div class="row">
                <div class="col-sm-4 col-xs-2 inner-logo" style="text-align: left;">
                    <a href="{{ url(localization()->localizeURL('/')) }}"><img alt="" src="{{ asset('/img/logo.png') }}" height="90" style="margin-top:{{ Auth::guest() ? '3' : '8' }}px;margin-bottom:0;"></a>
                    <span id="internal-locales-switcher">@include('vendor.localization.navbar')</span>
                </div>
                <div class="col-sm-8 col-xs-10 paddingTop15px nav-text" style="margin-bottom:50px;">

                    <ul class="pull-right drop-logo">
                        <li class="onhover-orange{{ Request::segment(1) == 'community'
                        || Request::segment(2) == 'community' ? ' active' : '' }}"><a href="{{ url(localization()->localizeURL('/community')) }}">{!! trans('community.community') !!}</a></li>
                        <li class="onhover-orange{{ Request::segment(1) == 'university' || Request::segment(2) == 'university' || Request::segment(1) == 'university-detail' || Request::segment(2) == 'university-detail' ? ' active' : '' }}"><a href="{{ url(localization()->localizeURL('/university')) }}">{!! trans('university.university_guides') !!}</a></li>
                        <li class="onhover-orange{{ Request::segment(1) == 'travelogue'
                        || Request::segment(2) == 'travelogue' ? ' active' : '' }}"><a href="{{ url(localization()->localizeURL('/travelogue'))}}
                            ">{!! trans('travelogue.travelogue') !!}</a></li>
                        <li class="onhover-orange{{ Request::segment(1) == 'discounts' || Request::segment(2) == 'discounts' ? ' active' : '' }}"><a href="{{ url(localization()->localizeURL('/discounts')) }}">{!! trans('discounts.travel_discounts') !!}</a></li>
                        @if (Auth::guest())
                            <li class="onhover-orange{{ Request::segment(2) == 'register' || Request::segment(3) == 'register' ? ' active' : '' }}"><a href="{{ url(localization()->localizeURL('/auth/register')) }}">{!! trans('auth.sign_up') !!}</a></li>
                            <li class="onhover-orange{{ Request::segment(2) == 'login' || Request::segment(3) == 'login' ? ' active' : '' }}"><a href="{{ url(localization()->localizeURL('/auth/login')) }}">{!! trans('auth.login') !!}</a></li>
                        @else
                            <li class="dropdown">
                                <div class="btn-group user-profile-open">
                                    <a class="btn dropdown-toggle" id="user-profile-menu" data-toggle="dropdown" href="#">
                                        <div style="position:relative;">
                                            @if (Auth::User()->avatar != '')
                                                @if ((strpos(Auth::user()->avatar,'http://')!== false || strpos(Auth::user()->avatar,'https://') !== false))
                                                    <img src="{{ str_replace('=normal','=large&width=200&height=200', Auth::user()->avatar) }}">
                                                @else
                                                    <img src="{{ asset('/img/memberImages/')}}/{{ Auth::user()->avatar }}">
                                                @endif
                                            @else
                                                <img src="{{ asset('/img/dummy-head.png') }}">
                                            @endif
                                            <sup id="message_notify" class="msg1" style="display:none;" data-list=""></sup>
                                            {{ Auth::user()->fname }}
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu sub-menu down-12">
                                        <div class="arrow-up"></div>

                                        <li><a href="{{ url(localization()->localizeURL('/home')) }}"><i class="fa fa-user" aria-hidden="true" style="margin-right:10px;margin-left: 7px;"></i>{!! trans('auth.profile') !!}</a></li>

                                        <li><a href="#add-user-dialog" onclick="frnd_show_hide()" role="button" data-toggle="modal"><i class="fa fa-comments-o " aria-hidden="true" style="margin-right:8px;"></i>{!! trans('auth.chat') !!}</a></li>

                                        <li class="logout"><a href="javascript:void(0);" onclick="logout();"><i aria-hidden="true" class="fa fa-sign-out m2" style="margin-right:8px;"></i>{!! trans('auth.log_out') !!}</a></li>
                                    </ul>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('#message_notify').click(function() {
            var list = $(this).data('list');
            var friendsList = JSON.parse(list.friends_list);
            friendsList.forEach(function(friend) {
                if (friend.msgcount > 0) {
                    register_popup(friend.id, friend.fname + ' ' + friend.lname, btoa(JSON.stringify(friend)), friend.requestId);
                }
            });
        });
    });
</script>
