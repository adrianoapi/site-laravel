@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    <div class="box box-bordered">

        <div class="box-title">
            <h3><i class="icon-plus-sign"></i> Item</h3>

            <ul class="tabs actions">
                <li>
                    <a href="{{route('ledgerItems.create', ['ledgerEntry' => $ledgerEntry->id])}}" data-toggle="modal" class="btn"><i class="icon-edit"></i> Novo Item</a>
                </li>
                <li class="active">
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
                        <td>{{$value->quanty}}</td>
                        <td>{{$value->price}}</td>
                        <td>{{$value->total_price}}</td>
                        <td>
                            <form action="{{route('ledgerItems.destroy', ['ledgerItem' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-inverse"><i class="icon-trash"></i> Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
</div>

@endsection