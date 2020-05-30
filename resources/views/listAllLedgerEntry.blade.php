@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    <div class="box box-bordered">
        <div class="box-title">
            
            <form action="{{route('ledgerEntries.index')}}" method="GET" class="span3" style="margin: 0;padding:0;">
                <div class="input-append input-prepend" style="margin: 0;padding:0;">
                    <span class="add-on"><i class="icon-search"></i></span>
                    <input type="hidden" name="filtro" value="pesquisa">
                <input type="text" name="pesquisar" value="{{array_key_exists('pesquisar', $_GET) ? $_GET['pesquisar'] : ''}}" placeholder="lançamentos..." class="input-medium">
                    <button class="btn" type="submit">Pesquisar</button>
                </div>
            </form>

            <div class="actions">
                
                <div class="btn-group">
                    <a href="#" data-toggle="dropdown" class="btn dropdown-toggle"><i class="glyphicon-filter"></i> <span class="caret"></span> Filtrar</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Despesa</a>
                            <ul class="dropdown-menu">
                                @foreach ($ledgerGroups as $value)
                                    <li><a href="{{route('ledgerEntries.index', ['filtro' =>'despesa', 'id' => $value->ledgerGroup->id])}}">{{$value->ledgerGroup->title}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Transação</a>
                            <ul class="dropdown-menu">
                                @foreach ($transitionTypes as $value)
                                    <li><a href="{{route('ledgerEntries.index', ['filtro' => 'transacao', 'id' => $value->id])}}">{{$value->title}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>

                <ul class="tabs actions">
                    <li>
                        <a href="{{route('ledgerEntries.index')}}" data-toggle="modal" class="btn"><i class="glyphicon-cleaning"></i> Limpar</a>
                    </li>
                    <li class="active">
                        <a href="{{route('ledgerEntries.create')}}" data-toggle="modal" class="btn"><i class="icon-plus-sign"></i> Novo Lançamento</a>
                    </li>
                </ul>
            
            </div>
        </div>
        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin">
                <thead>
                    <tr>
                        <th class="span1">Data</th>
                        <th class="span1">Valor</th>
                        <th class="span2">Lançamento</th>
                        <th class="span3">Tipo de Despesa</th>
                        <th class="span3">Tipo de Transação</th>
                        <th class="span2">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ledgerEntries as $value)
                        <tr>
                            <td>{{$value->entry_date}}</td>
                            <td><span class="btn btn-small btn-{{$value->transitionType->action == 'recipe' ? 'teal' : 'lightred'}}">{{$value->amount}}</span></td>
                            <td>{{$value->description}}</td>
                            <td>{{$value->ledgerGroup->ledgerGroup->title}} > {{$value->ledgerGroup->title}}</td>
                            <td>{{$value->transitionType->title}}</td>
                            <td>
                                <form action="{{route('ledgerEntries.destroy', ['ledgerEntry' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('ledgerEntries.show', ['ledgerEntry' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Detalhar"><i class="icon-search"></i></a>
                                    <a href="{{route('ledgerEntries.edit', ['ledgerEntry' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Editar"><i class="icon-edit"></i></a>
                                    <a href="{{route('ledgerItems.create', ['ledgerEntry' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Adicionar Item"><i class="icon-plus-sign"></i></a>
                                    <button type="submit" class="btn btn-inverse" rel="tooltip" title="" data-original-title="Excluir"><i class="icon-trash"></i></button>
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