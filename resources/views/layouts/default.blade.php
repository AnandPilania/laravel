<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="{{ localization()->getCurrentLocale() }}">

	<head>
		@include('includes.head')
		<script type='text/javascript'>
window.__wtw_lucky_site_id = 61914;

(function() {
var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
wa.src = 'https://d10lpsik1i8c69.cloudfront.net/w.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
})();
</script>
</head>
	<body onresize="calculate_popups()">

<!-- <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7&appId=1470599579632897";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script> -->


		@if (@$routeController == 'HomeController' && @$routeAction == 'index')
			@include('includes.carausalheader')
            @include('includes.top-alert')
		@else
			@include('includes.internalheader')
		@endif

		@yield('content')

		<div class="footer-bottom padding-less">
			@include('includes.footer')
		</div>
        @yield('scripts')
	</body>

</html>
