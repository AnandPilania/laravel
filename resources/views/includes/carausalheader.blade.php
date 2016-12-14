<header id="myCarousel" class="carousel slide home-header" data-interval="5000" data-ride="carousel">
	<!-- top-bar -->
	<div class="top-bar">
		<div clas="row">
			<div class="col-sm-4 top-top-bar">
				<a href="{{ url(localization()->localizeURL('/')) }}"><img src="{{ asset('/img/logo.png') }}" width="144" height="108"></a>
                <span id="home-locales-switcher">
                    @include('vendor.localization.navbar')
                </span>
			</div>
			<div class="col-sm-8 nav-text">
				@if (Auth::guest())
				<ul class="pull-right">
					<li class="onhover-orange"><a href="{{ url(localization()->localizeURL('/community')) }}">{!! trans('community.community') !!}</a></li>
					<li class="onhover-orange"><a href="{{ url(localization()->localizeURL('/university')) }}">{!! trans('university.university_guides') !!}</a></li>
					<li class="onhover-orange"><a href="{{ url(localization()->localizeURL('/travelogue')) }}">{!! trans('travelogue.travelogue') !!}</a></li>
					<li class="onhover-orange"><a href="{{ url(localization()->localizeURL('/discounts')) }}">{!! trans('discounts.travel_discounts') !!}</a></li>
					<li class="onhover-orange"><a href="{{ url(localization()->localizeURL('/auth/register')) }}">{!! trans('auth.sign_up') !!}</a></li>
					<li class="onhover-orange"><a href="{{ url(localization()->localizeURL('/auth/login')) }}">{!! trans('auth.login') !!}</a></li>
				</ul>
				@else
				<ul class="pull-right loginul">
					<li class="onhover-orange"><a href="{{ url(localization()->localizeURL('/community')) }}">{!! trans('community.community') !!}</a></li>
					<li class="onhover-orange"><a href="{{ url(localization()->localizeURL('/university')) }}">{!! trans('university.university_guides') !!}</a></li>
					<li class="onhover-orange"><a href="{{ url(localization()->localizeURL('/travelogue')) }}">{!! trans('travelogue.travelogue') !!}</a></li>
					<li class="onhover-orange"><a href="{{ url(localization()->localizeURL('/discounts')) }}" style="margin:-10px;">{!! trans('discounts.travel_discounts') !!}</a></li>
					<li class="dropdown" style="margin-top:-30px;padding-top:-30px;">
						<div class="btn-group user-profile-open">
							<a class="btn dropdown-toggle" id="user-profile-menu" data-toggle="dropdown" href="#">
								<div style="position:relative;">
									@if (Auth::User()->avatar != '')
										@if ((strpos(Auth::user()->avatar,'http://') !== false || strpos(Auth::user()->avatar,'https://') !== false))
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
							<ul class="dropdown-menu sub-menu down-12" style="margin-top:0px;background-color:rgba(0, 0, 0,0.6)">
								<div class="arrow-up"></div>

								<li><a href="{{ url(localization()->localizeURL('/home')) }}"><i class="fa fa-user" aria-hidden="true" style="margin-right:10px;margin-left: 2px;"></i>{!! trans('auth.profile') !!}</a></li>

								<li><a href="#add-user-dialog" onclick="frnd_show_hide()" role="button" data-toggle="modal"><i class="fa fa-comments-o" aria-hidden="true" style="margin-right:8px;"></i>{!! trans('auth.chat') !!}</a></li>

								<li class="logout"><a href="javascript:void(0);" onclick="logout();"><i aria-hidden="true" class="fa fa-sign-out m2" style="margin-right:8px;"></i>{!! trans('auth.log_out') !!}</a></li>
							</ul>
						</div>
					</li>
				</ul>
				@endif
			</div>
		</div>
	</div>

	<!-- Wrapper for Slides -->
	<div class="carousel-inner">
		<div class="item active">
            <!-- Set the third background image using inline CSS below. banner3-->
            <div class="fill" style="background-image:url('{{ asset('/img/Sarah.jpg') }}');background-size: 100% 100%;background-repeat: no-repeat;"></div>
        </div>
        <div class="item">
            <!-- Set the third background image using inline CSS below. banner3-->
            <div class="fill" style="background-image:url('{{ asset('/img/Thomas.jpg') }}');background-size: 100% 100%;background-repeat: no-repeat;"></div>
        </div>
        <div class="item">
			<!-- Set the third background image using inline CSS below. banner3-->
			<div class="fill" style="background-image:url('{{ asset('/img/Michelle.jpg') }}');background-size: 100% 100%;background-repeat: no-repeat;"></div>
		</div>
		<div class="item">
			<!-- Set the second background image using inline CSS below. -->
			<div class="fill" style="background-image:url('{{ asset('/img/Eugene.jpg') }}');background-size: 100% 100%;background-repeat: no-repeat;"></div>
		</div>
		<div class="item">
			<!-- Set the third background image using inline CSS below. banner3-->
			<div class="fill" style="background-image:url('{{ asset('/img/Natalie.jpg') }}');background-size: 100% 100%;background-repeat: no-repeat;"></div>
		</div>
		<div class="carousel-caption">
			<h2>{!! trans('home.caption') !!}</h2>
            <p>{!! str_replace('{totalUsers}', number_format(App\User::count()), trans('home.join_caption')) !!}</p>
            <a href="javascript:void(0);" id="join">{!! trans('home.join_button') !!} &gt;</a>
		</div>
	</div>

	<!-- Controls
	<a class="left carousel-control" href="#myCarousel" data-slide="prev">
		<span class="icon-prev"><img src="{{ asset('/img/left-arw.png') }}"></span>
	</a>
	<a class="right carousel-control" href="#myCarousel" data-slide="next">
		<span class="icon-next"><img src="{{ asset('/img/right-arw.png') }}"></span>
	</a>
	<div class="header-bottom">
		<div class="dropdown">
			<button class="btn btn-primary dropdown-toggle extra" type="button" data-toggle="dropdown">
				Check Out our <strong>University Guides</strong>!
			</button>
			<ul class="dropdown-menu">
				@foreach($universities as $university)
					<li><a href="{{url('/university-detail')}}/{{$university->id}}/university">{{$university->universityName}}</a></li>
				@endforeach
			</ul>
		</div>
	</div> -->
</header>

<style>
	.msg1{
		left:29px;
		top: -4px;
	}
	.down-12 span{
		right:20px;
	}
</style>
<script type="text/javascript">
    $(function() {
        $('#join').click(function() {
            var offset = 20; //Offset of 20px

            $('html, body').animate({
                scrollTop: $("#signup").offset().top + offset
            }, 2000);
        });

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
