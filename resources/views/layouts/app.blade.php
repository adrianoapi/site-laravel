<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pagSoft - @yield('title') </title>


    <link href="{!! asset('inspinia/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('inspinia/font-awesome/css/font-awesome.css') !!}" rel="stylesheet">
    
    <!-- iCheck style -->
    <link href="{!! asset('inspinia/css/plugins/iCheck/custom.css') !!}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{!! asset('inspinia/css/plugins/toastr/toastr.min.css') !!}" rel="stylesheet">

    <link href="{!! asset('inspinia/css/animate.css') !!}" rel="stylesheet">
    <link href="{!! asset('inspinia/css/style.css') !!}" rel="stylesheet">

    <!-- Chosen -->
    <link href="{!! asset('inspinia/css/plugins/chosen/bootstrap-chosen.css') !!}" rel="stylesheet">

    <!-- SUMMERNOTE -->
    <link href="{!! asset('inspinia/css/plugins/summernote/summernote-bs4.css') !!}" rel="stylesheet">

    <!-- checkbox -->
    <link href="{!! asset('inspinia/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') !!}" rel="stylesheet">

    <link href="{!! asset('inspinia/css/plugins/datapicker/datepicker3.css') !!}" rel="stylesheet">



</head>
<body>

  <!-- Wrapper-->
    <div id="wrapper">

        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Page wraper -->
        <div id="page-wrapper" class="gray-bg">

            <!-- Page wrapper -->
            @include('layouts.topnavbar')

            <!-- Main view  -->
            @yield('content')

            <!-- Footer -->
            @include('layouts.footer')

        </div>
        <!-- End page wrapper-->

    </div>
    <!-- End wrapper-->


    <!-- Mainly scripts -->
    <script src="{!! asset('inspinia/js/jquery-3.1.1.min.js') !!}"></script>
    <script src="{!! asset('inspinia/js/popper.min.js') !!}"></script>
    <script src="{!! asset('inspinia/js/bootstrap.js') !!}"></script>
    <script src="{!! asset('inspinia/js/plugins/metisMenu/jquery.metisMenu.js') !!}"></script>
    <script src="{!! asset('inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js') !!}"></script>

    <!-- jquery UI -->
    <script src="{!! asset('inspinia/js/plugins/jquery-ui/jquery-ui.min.js') !!}"></script>

    <!-- Touch Punch - Touch Event Support for jQuery UI -->
    <script src="{!! asset('inspinia/js/plugins/touchpunch/jquery.ui.touch-punch.min.js') !!}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{!! asset('inspinia/js/inspinia.js') !!}"></script>
    <script src="{!! asset('inspinia/js/plugins/pace/pace.min.js') !!}"></script>

    <!-- Chosen -->
    <script src="{!! asset('inspinia/js/plugins/chosen/chosen.jquery.js') !!}"></script>

    <!-- SUMMERNOTE -->
    <script src="{!! asset('inspinia/js/plugins/summernote/summernote-bs4.js') !!}"></script>

    <!-- iCheck -->
    <script src="{!! asset('inspinia/js/plugins/iCheck/icheck.min.js') !!}"></script>

    <!-- Data picker -->
    <script src="{!! asset('inspinia/js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>



@section('scripts')
@show

</body>
</html>
