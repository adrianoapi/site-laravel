@extends('layouts.app')

@section('title', 'Main page')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Lançamentos</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                                <div class="col-sm-5 m-b-xs">
                                    <a href="{{route('ledgerEntries.create')}}" class="btn btn-primary">Adicionar</a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="{{route('ledgerEntries.index')}}" class="btn btn-warning"> Limpar</a>
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">Despesa</button>
                                        <ul class="dropdown-menu">
                                            @foreach ($ledgerGroups as $value)
                                                <li><a href="{{route('ledgerEntries.index', ['filtro' =>'despesa', 'id' => $value->ledgerGroup->id])}}" class="dropdown-item">{{$value->ledgerGroup->title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">Transação</button>
                                        <ul class="dropdown-menu">
                                            @foreach ($transitionTypes as $value)
                                                <li><a href="{{route('ledgerEntries.index', ['filtro' => 'transacao', 'id' => $value->id])}}">{{$value->title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <form action="{{route('ledgerEntries.index')}}" method="GET" class="span3" style="margin: 0;padding:0;">
                                        <div class="input-group">
                                            <input type="hidden" name="filtro" value="pesquisa">
                                            <input placeholder="Search" type="text" name="pesquisar" value="{{array_key_exists('pesquisar', $_GET) ? $_GET['pesquisar'] : ''}}" class="form-control form-control-sm">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-sm btn-primary">Go!</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover table-nomargin">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Valor</th>
                                            <th class="w-25">Lançamento</th>
                                            <th>Tipo de Despesa</th>
                                            <th>Tipo de Transação</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ledgerEntries as $value)
                                            <tr>
                                                <td>{{substr($value->entry_date,0,-5)}}</td>
                                                <td><span class="label label-{{$value->transitionType->action == 'recipe' ? 'info' : 'danger'}}">{{$value->amount}}</span></td>
                                                <td>{{$value->description}}</td>
                                                <td>{{$value->ledgerGroup->ledgerGroup->title}} > {{$value->ledgerGroup->title}}</td>
                                                <td>{{$value->transitionType->title}}</td>
                                                <td>
                                                    <form action="{{route('ledgerEntries.destroy', ['ledgerEntry' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="{{route('ledgerEntries.show', ['ledgerEntry' => $value->id])}}" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Detalhar"><i class="fa fa-search"></i></a>
                                                        <a href="{{route('ledgerEntries.edit', ['ledgerEntry' => $value->id])}}" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Editar"><i class="fa fa-edit"></i></a>
                                                        <a href="{{route('ledgerItems.create', ['ledgerEntry' => $value->id])}}" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Adicionar Item"><i class="fa fa-search-plus"></i></a>
                                                        <button type="submit" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Excluir"><i class="fa fa-trash"></i></button>
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
            </div>
        </div>
    </div>

@endsection