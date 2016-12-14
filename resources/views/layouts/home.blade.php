<!DOCTYPE html>
<html lang="{{ localization()->getCurrentLocale() }}">
	<head>
		@include('includes.head')
		@yield('meta-tags')
	</head>
	<body onresize="calculate_popups()">
		@include('includes.top-alert')

		@include('includes.carausalheader')

		@yield('content')

		<div class="footer-bottom padding-less">
			@include('includes.footer')
		</div>
	</body>
</html>
