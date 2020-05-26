<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>FLAT - Login</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{url('dashboard/css/bootstrap.min.css')}}">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="{{url('dashboard/css/bootstrap-responsive.min.css')}}">
	<!-- icheck -->
	<link rel="stylesheet" href="{{url('dashboard/css/plugins/icheck/all.css')}}">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="{{url('dashboard/css/style.css')}}">
	<!-- Color CSS -->
	<link rel="stylesheet" href="{{url('dashboard/css/themes.css')}}">


	<!-- jQuery -->
	<script src="{{('dashboard/js/jquery.min.js')}}"></script>
	
	<!-- Nice Scroll -->
	<script src="{{('dashboard/js/plugins/nicescroll/jquery.nicescroll.min.js')}}"></script>
	<!-- Validation -->
	<script src="{{('dashboard/js/plugins/validation/jquery.validate.min.js')}}"></script>
	<script src="{{('dashboard/js/plugins/validation/additional-methods.min.js')}}"></script>
	<!-- icheck -->
	<script src="{{('dashboard/js/plugins/icheck/jquery.icheck.min.js')}}"></script>
	<!-- Bootstrap -->
	<script src="{{('dashboard/js/bootstrap.min.js')}}"></script>
	<script src="{{('dashboard/js/eakroko.js')}}"></script>

	<!--[if lte IE 9]>
		<script src="{{('dashboard/js/plugins/placeholder/jquery.placeholder.min.js')}}"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
	

	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

</head>

<body class='login'>
	@yield('content')
</body>
</html>