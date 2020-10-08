@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Orders</h5>
                    <div class="float-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-white active">Today</button>
                            <button type="button" class="btn btn-xs btn-white">Monthly</button>
                            <button type="button" class="btn btn-xs btn-white">Annual</button>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="m-t-sm">

                        <div class="row">
                            <div class="col-md-8" id="ajax-chart">
                                <div class="ibox-content">
                                    <div class="spiner-example">
                                        <div class="sk-spinner sk-spinner-wave">
                                            <div class="sk-rect1"></div>
                                            <div class="sk-rect2"></div>
                                            <div class="sk-rect3"></div>
                                            <div class="sk-rect4"></div>
                                            <div class="sk-rect5"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" id="ajax-finance">
                                <div class="ibox-content">
                                    <div class="spiner-example">
                                        <div class="sk-spinner sk-spinner-wave">
                                            <div class="sk-rect1"></div>
                                            <div class="sk-rect2"></div>
                                            <div class="sk-rect3"></div>
                                            <div class="sk-rect4"></div>
                                            <div class="sk-rect5"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row" id="ajax-task">
        <div class="ibox-content">
            <div class="spiner-example">
                <div class="sk-spinner sk-spinner-wave">
                    <div class="sk-rect1"></div>
                    <div class="sk-rect2"></div>
                    <div class="sk-rect3"></div>
                    <div class="sk-rect4"></div>
                    <div class="sk-rect5"></div>
                </div>
            </div>
        </div>
    </div>


</div>


@endsection

@section('scripts')

    <!-- Peity -->
    <script src="{!! asset('inspinia/js/plugins/peity/jquery.peity.min.js') !!}"></script>
    <script src="{!! asset('inspinia/js/demo/peity-demo.js') !!}"></script>

     <!-- Sparkline -->
     <script src="{!! asset('inspinia/js/plugins/sparkline/jquery.sparkline.min.js') !!}"></script>

    <!-- Sparkline demo data  -->
    <script src="{!! asset('inspinia/js/demo/sparkline-demo.js') !!}"></script>

    <!-- ChartJS-->
    <script src="{!! asset('inspinia/js/plugins/chartJs/Chart.min.js') !!}"></script>

    <!-- Tinycon -->
    <script src="{!! asset('inspinia/js/plugins/tinycon/tinycon.min.js') !!}"></script>

<script>
    
    $(document).ready(function() {
        
        $.ajax({
            url: "{{route('dash.ajaxChart')}}",
            type: "GET",
            data: {
                "_token": "{{csrf_token()}}"
            },
            dataType: 'json',
                success: function(data){
                    $("#ajax-chart"  ).html(data['chart'  ]);
                    $("#ajax-finance").html(data['finance']);
            }
        });

        $.ajax({
            url: "{{route('dash.ajaxTask')}}",
            type: "GET",
            data: {
                "_token": "{{csrf_token()}}"
            },
            dataType: 'json',
                success: function(data){
                    $("#ajax-task").html(data['body']);
            }
        });

    });

</script>
@endsection
