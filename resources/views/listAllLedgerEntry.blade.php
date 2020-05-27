@extends('dashboard.master.layout')

@section('content')

<br>
<div class="breadcrumbs">
    <ul>
        <li>
            <a href="more-login.html">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <a href="components-messages.html">Components</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <a href="components-bootstrap.html">Bootstrap elements</a>
        </li>
    </ul>
    <div class="close-bread">
        <a href="#"><i class="icon-remove"></i></a>
    </div>
</div>

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
                        <th>Lançamento</th>
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