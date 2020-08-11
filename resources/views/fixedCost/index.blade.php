@extends('layouts.app')

@section('title', 'Main page')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Lançamentos programado</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6 m-b-xs">
                                <a href="{{route('fixedCosts.create')}}" class="btn btn-primary"><i class="icon-plus" title="Adicionar"></i> Adicionar</a>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group"><input placeholder="Search" type="text" class="form-control form-control-sm"> <span class="input-group-append"> <button type="button" class="btn btn-sm btn-primary">Go!
                                </button> </span></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            
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
                                    @foreach ($fixedCosts as $value)
                                        <tr>
                                            <td>{{$value->entry_date}}</td>
                                            <td><span class="label label-{{$value->transitionType->action == 'recipe' ? 'info' : 'danger'}}">{{$value->amount}}</span></td>
                                            <td>{{$value->description}}</td>
                                            <td>{{$value->ledgerGroup->ledgerGroup->title}} > {{$value->ledgerGroup->title}}</td>
                                            <td>{{$value->transitionType->title}}</td>
                                            <td>
                                                <form action="{{route('fixedCosts.destroy', ['fixedCost' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{route('fixedCosts.show', ['fixedCost' => $value->id])}}" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Detalhar"><i class="fa fa-chain"></i></a>
                                                    <a href="{{route('fixedCosts.edit', ['fixedCost' => $value->id])}}" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Editar"><i class="fa fa-pencil-square-o"></i></a>
                                                    <button type="submit" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Excluir"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $fixedCosts->links('dashboard.pagination') }}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection