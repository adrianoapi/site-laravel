@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<?php
    $days   = NULL;
    $recipe = NULL;
    $cost   = NULL;
    $totalCost     = 0;
    $totalRecipe   = 0;
    $percentRecipe = 0;
    $percentCost   = 0;
    $i = 1;
    ksort($lancamentoTotal);
    foreach($lancamentoTotal as $key => $value):
        $separetor = ($i < count($lancamentoTotal)) ? ',' : '';
        $days .= "\"$key\"".$separetor;
        $recipe .= $value['lucro'].$separetor;
        $cost .= $value['despesa'].$separetor;

        $totalRecipe += $value['lucro'  ];
        $totalCost   += $value['despesa'];
        
        $i++;
    endforeach;

    if(($totalRecipe + $totalCost) > 0){
        $percentRecipe = $totalRecipe * 100 / ($totalRecipe + $totalCost);
        $percentCost   = $totalCost * 100 / ($totalRecipe + $totalCost);
    }
?>

<div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <div>
                            <span class="float-right text-right">
                                Receita: R$ <strong>{{number_format($dbTotalRecipe[0]->total, 2, ',','.')}}</strong>
                                -
                                Despesa: R$ <strong>{{number_format($dbTotalExpensive[0]->total, 2, ',','.')}}</strong>
                                =
                                Total: R$ <strong>{{number_format($dbTotalRecipe[0]->total - $dbTotalExpensive[0]->total, 2, ',','.')}}</strong>
                            </span>
                            <h3 class="font-bold no-margins">
                                Half-year revenue margin
                            </h3>
                            <small>Sales marketing.</small>
                        </div>

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
                                <div class="col-md-4">
                                    <ul class="stat-list m-t-lg">
                                        <li>
                                            <h2 class="no-margins">R$ {{number_format($totalRecipe, 2, ',','.')}}</h2>
                                            <small>Total orders in period</small>
                                            <div class="progress progress-mini">
                                                <div class="progress-bar" style="width: {{$percentRecipe}}%;"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins ">R$ {{number_format($totalCost, 2, ',','.')}}</h2>
                                            <small>Orders in last month</small>
                                            <div class="progress progress-mini">
                                                <div class="progress-bar-danger" style="width: {{$percentCost}}%;"></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="m-t-md">
                            <small class="float-right">
                                <i class="fa fa-clock-o"> </i>
                                {{date('d/m/Y H:i:s')}}
                            </small>
                            <small>
                                <strong>Analysis of sales:</strong> The value has been changed over time, and last month reached a level over $50,000.
                            </small>
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
                    $("#ajax-chart").html(data['body']);
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
