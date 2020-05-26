@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    <div class="box box-bordered">
        <div class="box-title">
            <h3>
                <i class="icon-table"></i>
                Lançamentos
            </h3>
            <div class="actions">
                <div class="btn-group">
                    <a href="#" data-toggle="dropdown" class="btn dropdown-toggle"><i class="glyphicon-shopping_bag"></i> <span class="caret"></span> Tipo de Despesa</a>
                    <ul class="dropdown-menu">
                        @foreach ($ledgerGroups as $value)
                            <li><a href="{{route('ledgerEntries.index', ['filtro' =>'despesa', 'id' => $value->ledgerGroup->id])}}">{{$value->ledgerGroup->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="btn-group">
                    <a href="#" data-toggle="dropdown" class="btn dropdown-toggle"><i class="glyphicon-credit_card"></i> <span class="caret"></span> Tipo de Transação</a>
                    <ul class="dropdown-menu">
                        @foreach ($transitionTypes as $value)
                            <li><a href="{{route('ledgerEntries.index', ['filtro' => 'transacao', 'id' => $value->id])}}">{{$value->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <a href="{{route('ledgerEntries.index')}}" data-toggle="modal" class="btn"><i class="glyphicon-cleaning"></i> Limpar</a>
                <a href="{{route('ledgerEntries.create')}}" data-toggle="modal" class="btn"><i class="icon-plus-sign"></i> Novo Lançamento</a>
            </div>
        </div>
        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Valor</th>
                        <th>Título</th>
                        <th>Tipo de Despesa</th>
                        <th>Tipo de Transação</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ledgerEntries as $value)
                        <tr>
                            <td>{{$value->entry_date}}</td>
                            <td><span class="btn btn-{{$value->transitionType->action == 'recipe' ? 'darkblue' : 'lightred'}}">{{$value->amount}}</span></td>
                            <td>{{$value->description}}</td>
                            <td>{{$value->ledgerGroup->ledgerGroup->title}} > {{$value->ledgerGroup->title}}</td>
                            <td>{{$value->transitionType->title}}</td>
                            <td>
                                <form action="{{route('ledgerEntries.destroy', ['ledgerEntry' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('ledgerEntries.show', ['ledgerEntry' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Detalhar"><i class="glyphicon-expand"></i></a>
                                    <a href="{{route('ledgerEntries.edit', ['ledgerEntry' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Editar"><i class="icon-edit"></i></a>
                                    <button type="submit" class="btn" rel="tooltip" title="" data-original-title="Excluir"><i class="icon-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $ledgerEntries->links('dashboard.pagination') }}
        </div>
    </div>
</div>
    
@endsection