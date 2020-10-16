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
                            <button type="button" class="btn btn-xs btn-white chart-dash" onclick="financeChart('today')"   id="today">Today</button>
                            <button type="button" class="btn btn-xs btn-white chart-dash" onclick="financeChart('monthly')" id="monthly">Monthly</button>
                            <button type="button" class="btn btn-xs btn-white chart-dash" onclick="financeChart('annual')"  id="annual">Annual</button>
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

    <div class="row">

        <div class="col-lg-4" id="ajax-fixedCost">
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

        <div class="col-lg-4" id="ajax-graph-pie">
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

        <div class="col-lg-4" id="ajax-task">
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

    function financeChart(value)
    {
        $(".chart-dash").removeClass('active');
        $("#"+value).addClass('active');

        $.ajax({
            url: "{{route('dash.ajaxChart')}}",
            type: "GET",
            data: {
                "_token": "{{csrf_token()}}",
                "range": value
            },
            dataType: 'json',
                success: function(data){
                    $("#ajax-chart"  ).html(data['chart'  ]);
                    $("#ajax-finance").html(data['finance']);
            }
        });
    }
    
    $(document).ready(function() {

        $.ajax({
            url: "{{route('dash.graphPie')}}",
            type: "GET",
            data: {
                "_token": "{{csrf_token()}}"
            },
            dataType: 'json',
                success: function(data){
                   $("#ajax-graph-pie").html(data['body']);
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

    $(document).ready(function() {
        
        $.ajax({
            url: "{{route('financialCharts.fixedCoastAjax')}}",
            type: "GET",
            data: {
                "_token": "{{csrf_token()}}"
            },
            dataType: 'json',
                success: function(data){
                    $("#ajax-fixedCost").html(data['body']);
            }
        });

    });

    financeChart('today');

</script>
@endsection
