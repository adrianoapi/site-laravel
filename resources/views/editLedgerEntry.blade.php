@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="pull-left">
            <h1>/lancamentos</h1>
        </div>
        <div class="pull-right">
            <div class="btn-toolbar">
                <a href="{{route('ledgerEntries.index')}}" class="btn btn-primary"><i class="icon-reorder" title="Listagem"></i> Listagem</a>
            </div> 
        </div> 
    </div>
    <div class="box box-bordered box-color">
        <div class="box-title">
            <h3><i class="icon-th-list"></i> Alterar</h3>
        </div>
        <div class="box-content nopadding">
            <form action="{{route('ledgerEntries.update', ['ledgerEntry' => $ledgerEntry->id])}}" method="POST" class="form-horizontal form-bordered">
                @csrf
                @method('PUT')
                <div class="control-group">
                    <label for="description" class="control-label">Descrição</label>
                    <div class="controls">
                        <input type="text" name="description" id="description" value="{{$ledgerEntry->description}}" placeholder="Text input" class="input-xxlarge">
                    </div>
                </div>
                <div class="control-group">
                    <label for="ledger_group_id" class="control-label">Tipo de Despesa</label>
                    <div class="controls">
                        <select name="ledger_group_id" id="ledger_group_id" class="select2-me input-xlarge">
                            @foreach ($ledgerGroups as $value)
                                <option value="{{$value->id}}" {{$value->id == $ledgerEntry->ledger_group_id ? 'selected':''}} {{$value->id == $value->ledger_group_id ? 'disabled' : ''}}>{{$value->id == $value->ledger_group_id ? '== '.$value->title.' ==' : $value->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label for="transition_type_id" class="control-label">Tipo de Transação</label>
                    <div class="controls">
                        <select name="transition_type_id" id="transition_type_id" class="select2-me input-xlarge">
                            @foreach ($transitionTypes as $value)
                                <option value="{{$value->id}}" {{$value->id == $ledgerEntry->transition_type_id ? 'selected':''}}>{{$value->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label for="entry_date" class="control-label">Datepicker</label>
                    <div class="controls">
                        <input type="text" name="entry_date" id="entry_date" value="{{$ledgerEntry->entry_date}}" class="input-medium datepick">
                    </div>
                </div>
                <div class="control-group">
                    <label for="amount" class="control-label">Valor</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">R$</span>
                            <input type="text" name="amount" id="amount" value="{{$ledgerEntry->amount}}" placeholder="0,00" class="input-small">
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{route('ledgerEntries.index')}}" class="btn">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection