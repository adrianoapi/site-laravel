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

        <div class="row">

        <div class="col-lg-12">
        <div class="ibox ">
        <div class="ibox-title">
            <h5>Custom responsive table </h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#" class="dropdown-item">Config option 1</a>
                    </li>
                    <li><a href="#" class="dropdown-item">Config option 2</a>
                    </li>
                </ul>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-9 m-b-xs">
                    <div data-toggle="buttons" class="btn-group btn-group-toggle">
                        <label class="btn btn-sm btn-white"> <input type="radio" id="option1" name="options"> Day </label>
                        <label class="btn btn-sm btn-white active"> <input type="radio" id="option2" name="options"> Week </label>
                        <label class="btn btn-sm btn-white"> <input type="radio" id="option3" name="options"> Month </label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-sm" placeholder="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" type="button">Go!</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Level</th>
                        <th>Group</th>
                        <th>Date</th>
                        <th>Progress</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tasks as $value)
                    <tr>
                        <td>{{$value->title}}</td>
                        <td>
                            @if($value->level == 'low')
                                <span class="label label-success">{{strtoupper($value->level)}}</span>
                            @elseif($value->level == 'medium')
                                <span class="label label-warning">{{strtoupper($value->level)}}</span>
                            @else
                                <span class="label label-danger">{{strtoupper($value->level)}}</span>
                            @endif
                        </td>
                        <td>{{$value->taskGroup->title}}</td>
                        <td>{{date('d/m/Y H:i', strtotime($value->created_at))}}</td>
                        <td>
                            @if($value->status == 'todo')
                                <span class="pie">0.00/1.0</span>
                            @elseif($value->status == 'inprogress')
                                <span class="pie">0.50/1.0</span>
                            @else
                                <span class="pie">1.0/1.0</span>
                            @endif
                        </td>
                        <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
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

    });

</script>
@endsection
