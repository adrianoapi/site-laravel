@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="wrapper wrapper-content">
    <div class="row">

        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Movimentação <i class="fa fa-cc-visa payment-icon-sm text-success"></i> <span class="label label-warning">R$ {{number_format($monthly['monthlyExpenseCart'][0]->total, 2, ",", ".")}}</span></h5> <small>Período de 30 dias</small>
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

                    <table class="table table-hover margin bottom">
                        <thead>
                        <tr>
                            <th class="w-75">Tipo</th>
                            <th class="">Valor</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                            $total = $monthly['monthlyRecipe'][0]->total - $monthly['monthlyExpense'][0]->total;
                        ?>

                            <tr>
                                <td>Receita</td>
                                <td><span class="label label-info">R$ {{number_format($monthly['monthlyRecipe'][0]->total, 2, ",", ".")}}</span></td>
                            </tr>
                            <tr>
                                <td>Despesa</td>
                                <td><span class="label label-danger">R$ {{number_format($monthly['monthlyExpense'][0]->total, 2, ",", ".")}}</span></td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td><span class="label label-{{$total > 0 ? 'info': 'danger'}}">R$ {{number_format($total, 2, ",", ".")}}</span></td>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Próximos lançamentos</h5>
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

                    <table class="table table-hover margin bottom">
                        <thead>
                        <tr>
                            <th class="w-75">Tipo</th>
                            <th class="">Valor</th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach($fixedCost as $value)
                        <tr>
                            <td>{{$value->description}}</td>
                            <td class="text-center">{{$value->entry_date}}</td>
                            <td class="text-center"><span class="label label-danger">R$ {{$value->amount}}</span></td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Rank de Despesas</h5> <small>Período de 30 dias</small>
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

                    <table class="table table-hover margin bottom">
                        <thead>
                        <tr>
                            <th>Transaction</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Amount</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($rank_cost as $value)
                        <tr>
                            <td>{{$value->description}}</td>
                            <td class="text-center">{{date('d/m/Y', strtotime($value->entry_date))}}</td>
                            <td class="text-center"><span class="label label-danger">R$ {{number_format($value->amount, 2, ",", ".")}}</span></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection
