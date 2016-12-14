<html>
	<head>
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
		<style>
			body {
				margin: 0;
				padding: 0;
				background-repeat: no-repeat;
				background-size:100% 100%;
				background-image: url("{{ asset('/img/error-page.jpg') }}");
				background-color: rgb(232, 243, 244);
			}
			.content {
				position: fixed;
				bottom: 10%;
				right: 23%;
			}
		</style>
	</head>
	<body>
    <div class="content">
        <a href="https://www.facebook.com/flyingchalks/"><img src="{{ asset('/img/fb-logo.png') }}" height="50" width="50"/></a>&nbsp;
        <a href="https://www.instagram.com/flyingchalks/"><img src="{{ asset('/img/instagram-logo.png') }}" height="50" width="50"/></a>
</div>
	</body>
</html>