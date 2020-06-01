<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>pagSoft</title>

	<!-- Bootstrap -->
  <link rel="stylesheet" href="{{url(mix('dashboard/css/bootstrap.css'))}}">

  <!-- PageGuide -->
	<link rel="stylesheet" href="{{url('dashboard/css/plugins/pageguide/pageguide.css')}}">
	<!-- Fullcalendar -->
	<link rel="stylesheet" href="{{url('dashboard/css/plugins/fullcalendar/fullcalendar.css')}}">
	<link rel="stylesheet" href="{{url('dashboard/css/plugins/fullcalendar/fullcalendar.print.css')}}" media="print">
	<!-- chosen -->
	<link rel="stylesheet" href="{{url('dashboard/css/plugins/chosen/chosen.css')}}">
	<!-- select2 -->
	<link rel="stylesheet" href="{{url('dashboard/css/plugins/select2/select2.css')}}">
  <!-- icheck -->
  <link rel="stylesheet" href="{{url('dashboard/css/plugins/icheck/all.css')}}">
  <!-- Datepicker -->
	<link rel="stylesheet" href="{{url('dashboard/css/plugins/datepicker/datepicker.css')}}">

	<!-- Theme CSS -->
  <link rel="stylesheet" href="{{url(mix('dashboard/css/style.css'))}}">

	<!-- jQuery -->
  <script src="{{url(mix('dashboard/js/jquery.js'))}}"></script>
  <script src="{{url(mix('dashboard/js/jquery-ui.js'))}}"></script>

  <!-- Theme framework -->
  <script src="{{url(mix('dashboard/js/framework.js'))}}"></script>

  <script src="{{url(mix('dashboard/js/form.js'))}}"></script>
  <!-- Datepicker -->
	<script src="{{url('dashboard/js/plugins/datepicker/bootstrap-datepicker.js')}}"></script>

	<!--[if lte IE 9]>
		<script src="{{url(mix('dashboard/js/jquery-ie9.js'))}}"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="{{url('img/favicon.ico')}}" />
	<!-- Apple devices Homescreen icon -->
  <link rel="apple-touch-icon-precomposed" href="{{url('img/apple-touch-icon-precomposed.png')}}" />

	<!-- Fullcalendar -->
  <link rel="stylesheet" href="{{url('dashboard/css/plugins/fullcalendar/fullcalendar.print.css')}}" media="print">
  

  <!-- icheck -->
	<script src="{{url('dashboard/js/plugins/icheck/jquery.icheck.min.js')}}"></script>



</head>

<body data-layout-sidebar="fixed" data-layout-topbar="fixed">
  
<div id="navigation">
  <div class="container-fluid">
    <a href="{{url('dash')}}" id="brand">pagSoft</a>
    <a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
    
    <div class="user">
      <ul class="icon-nav">
        <li>
          <a href="{{route('exams.index')}}">
            <i class="icon-dash"></i>
            Voltar para Exames
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="container-fluid" id="content">
  
  <div id="main">

    @yield('content')

  </div>
</div>

</body>
</html>