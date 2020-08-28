@extends('layouts.app')

@section('title', 'Main page')

@section('content')

<div class="wrapper wrapper-content  animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><i class="fa fa-plus"></i> Item <small>Adicção de intes no orçamento.</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-6 m-b-xs">
                            <a href="{{route('ledgerItems.create', ['ledgerEntry' => $ledgerEntry->id])}}" class="btn btn-default"><i class="icon-edit"></i> Novo Item</a>
                            <a href="{{route('ledgerItems.show', ['ledgerEntry' => $ledgerEntry->id])}}" class="btn btn-info"><i class="icon-shopping-cart"></i> Itens</a>
                            <a href="{{route('ledgerEntries.index')}}" class="btn btn-default"><i class="icon-reorder"></i> Lancamentos</a>
                        </div>
                        <div class="col-sm-6">
                            
                        </div>
                    </div>

                    <table class="table table-bordered table-hover table-nomargin">
                        <thead>
                            <tr>
                                <th class="span2">Data</th>
                                <th class="span2">Valor</th>
                                <th class="span2">Lançamento</th>
                                <th class="span4">Tipo de Despesa</th>
                                <th class="span2">Tipo de Transação</th>
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

                    <table class="table table-hover table-nomargin">
                        <thead>
                            <tr>
                                <th class="span4">Descrição</th>
                                <th class="span2">Quantidade</th>
                                <th class="span2">Valor Unitário</th>
                                <th class="span2">Valor Total</th>
                                <th class="span2">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ledgerItems as $value)
                            <tr>
                                <td>{{$value->description}}</td>
                                <td>{{$value->quantity}}</td>
                                <td>{{$value->price}}</td>
                                <td>{{$value->total_price}}</td>
                                <td>
                                    <form action="{{route('ledgerItems.destroy', ['ledgerItem' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Excluir</button>
                                    </form>
                                </td>
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