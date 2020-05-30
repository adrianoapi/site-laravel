@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    @if (is_object($ledgerItem))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Item <strong>{{$ledgerItem->description}}</strong> craido com sucesso!
    </div>
    @endif
    
    <div class="box box-bordered">

        <div class="box-title">
            <h3><i class="icon-plus-sign"></i> Item</h3>

            <ul class="tabs actions">
                <li class="active">
                    <a href="{{route('ledgerItems.create', ['ledgerEntry' => $ledgerEntry->id])}}" data-toggle="modal" class="btn"><i class="icon-edit"></i> Novo Item</a>
                </li>
                <li>
                    <a href="{{route('ledgerItems.show', ['ledgerEntry' => $ledgerEntry->id])}}" data-toggle="modal" class="btn"><i class="icon-shopping-cart"></i> Itens</a>
                </li>
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
            <form action="{{route('ledgerItems.store')}}" method="POST" class="form-horizontal form-bordered">
                @csrf
                <div class="control-group">
                    <label for="description" class="control-label">Prouto nome <small>Descrição do produto...</small></label>
                    <div class="controls">
                        <input type="text" name="description" id="description" placeholder="descrição..." data-rule-required="true" class="input-xxlarge">
                    </div>
                </div>
                <div class="control-group">
                    <label for="quantity" class="control-label">Quantidade</label>
                    <div class="controls">
                        <input type="number" name="quantity" id="quantity" placeholder="1" class="input-large">
                    </div>
                </div>
                <div class="control-group">
                    <label for="price" class="control-label">Valor Unitário</label>
                    <div class="controls">
                        <input type="text" name="price" id="price" placeholder="00,0" class="input-large">
                    </div>
                </div>
                <div class="control-group">
                    <label for="total_price" class="control-label">Valor Total <small>Valor x Quantidade com ou sem desconto</small></label>
                    <div class="controls">
                        <input type="text" name="total_price" id="total_price" placeholder="00,00" class="input-large">
                    </div>
                </div>
                <input type="hidden" name="ledger_entry_id" value="{{$ledgerEntry->id}}">
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection