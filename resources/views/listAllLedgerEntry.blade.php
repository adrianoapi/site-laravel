@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="pull-left">
            <h1>/lancamentos</h1>
        </div>
        <div class="pull-right">
            <div class="btn-toolbar">
                <a href="{{route('ledgerEntries.create')}}" class="btn btn-primary"><i class="icon-plus" title="Adicionar"></i> Adicionar</a>
            </div> 
        </div> 
    </div>
    <div class="box box-color box-bordered">
        <div class="box-title">
            <h3>
                <i class="icon-table"></i>
                Listagem
            </h3>
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