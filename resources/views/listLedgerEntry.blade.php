@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">
    
    <div class="box box-bordered">
        <div class="box-title">
            <h3><i class="icon-search"></i> Detalhes</h3>

            <ul class="tabs actions">
                <li>
                    <a href="{{route('ledgerEntries.index')}}" data-toggle="modal" class="btn"><i class="icon-reorder"></i> Lancamentos</a>
                </li>
            </ul> 

        </div>
        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin">
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
        </div>

        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin">
                <thead>
                    <tr>
                        <th>Descrição</th>
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

@endsection