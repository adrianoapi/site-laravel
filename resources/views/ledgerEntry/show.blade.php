@extends('layouts.app')

@section('title', 'Main page')

@section('content')

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Lançamentos</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                            <div class="col-sm-5 m-b-xs">
                                <a href="{{route('ledgerEntries.index')}}" class="btn btn-primary"><i class="icon-reorder"></i> Lancamentos</a>
                            </div>
                            <div class="col-sm-7">
                                
                            </div>
                        </div>
                        <div class="table-responsive">

                            <table class="table table-bordered table-hover table-nomargin">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Valor</th>
                                        <th>Lançamento</th>
                                        <th>Tipo de Despesa</th>
                                        <th>Tipo de Transação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$ledgerEntry->entry_date}}</td>
                                        <td>{{$ledgerEntry->amount}}</td>
                                        <td>{{$ledgerEntry->description}}</td>
                                        <td>{{$ledgerEntry->ledgerGroup->ledgerGroup->title}} > {{$ledgerEntry->ledgerGroup->title}}</td>
                                        <td>{{$ledgerEntry->transitionType->title}}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered table-hover table-nomargin">
                                <thead>
                                    <tr>
                                        <th class="w-25">Descrição</th>
                                        <th>Quantidade</th>
                                        <th>Valor Unitário</th>
                                        <th>Valor Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ledgerEntry->ledgerItems as $value)
                                    <tr>
                                        <td>{{$value->description}}</td>
                                        <td>{{$value->quantity}}</td>
                                        <td>{{$value->price}}</td>
                                        <td>{{$value->total_price}}</td>
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
<script>
    $('.chosen-select').chosen({width: "100%"});
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });

    var mem = $('#data_1 .input-group.date').datepicker({
        format: "dd/mm/yyyy",
            language: "pt-BR",
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
        });

</script>
@endsection