@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    <div class="box box-bordered">

        <div class="box-title">
        <h3><i class="icon-plus-sign"></i> Item > {{$ledgerEntry->description}}</h3>

            <div class="actions">
                <a href="{{route('ledgerEntries.index')}}" data-toggle="modal" class="btn"><i class="icon-reorder"></i> Listagem</a>
            </div>

        </div>

        <div class="box-content nopadding">
            <form action="{{route('ledgerItems.store')}}" method="POST" class="form-horizontal form-bordered">
                @csrf
                <div class="control-group">
                    <label for="description" class="control-label">Nome do produto <small>Junto com sua descrição</small></label>
                    <div class="controls">
                        <input type="text" name="description" id="description" placeholder="Text input" class="input-xxlarge">
                    </div>
                </div>
                <div class="control-group">
                    <label for="quanty" class="control-label">Quantidade</label>
                    <div class="controls">
                        <input type="number" name="quanty" id="quanty" placeholder="Text input" class="input-large">
                    </div>
                </div>
                <div class="control-group">
                    <label for="price" class="control-label">Valor Unitário</label>
                    <div class="controls">
                        <input type="text" name="price" id="price" placeholder="Text input" class="input-large">
                    </div>
                </div>
                <div class="control-group">
                    <label for="total_price" class="control-label">Valor Total <small>Valor x Quantidade com ou sem desconto</small></label>
                    <div class="controls">
                        <input type="text" name="total_price" id="total_price" placeholder="Text input" class="input-large">
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