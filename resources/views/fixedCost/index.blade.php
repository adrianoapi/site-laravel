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
                            <div class="col-sm-1 m-b-xs">
                                <a href="{{route('fixedCosts.create')}}" class="btn btn-primary"><i class="icon-plus" title="Adicionar"></i> Adicionar</a>
                            </div>
                            <div class="col-sm-1 m-b-xs">
                                <a href="{{route('fixedCosts.trash')}}" class="btn btn-default"><i class="icon-trash" title="Lixeira"></i> Lixeira</a>
                            </div>
                            <div class="col-sm-10">
                                <div class="input-group"><input placeholder="Search" type="text" class="form-control form-control-sm"> <span class="input-group-append"> <button type="button" class="btn btn-sm btn-primary">Go!
                                </button> </span></div>
                            </div>
                        </div>
                        <div class="table-responsive">

                            <table class="table table-bordered table-hover table-nomargin">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Valor</th>
                                        <th>Lançamento</th>
                                        <th>Tipo de Transação</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fixedCosts as $value)
                                        <tr>
                                            <td>
                                                {{$value->entry_date}}<br>
                                                <?php
                                                $date = str_replace('/', '-', $value->entry_date);
                                                $date = date("Y-m-d", strtotime($date));
                                                ?>
                                                <small>{{$date}}</small>
                                            </td>
                                            <td><span class="label label-{{$value->transitionType->action == 'recipe' ? 'info' : 'danger'}}">{{$value->amount}}</span></td>
                                            <td>
                                                <strong>{{$value->description}}</strong><br>
                                                {{$value->ledgerGroup->ledgerGroup->title}} > {{$value->ledgerGroup->title}}
                                            </td>
                                            <td>{{$value->transitionType->title}}</td>
                                            <td>
                                                <form action="{{route('fixedCosts.destroy', ['fixedCost' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{route('fixedCosts.show', ['fixedCost' => $value->id])}}" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Detalhar"><i class="fa fa-search-plus"></i></a>
                                                    <a href="{{route('fixedCosts.entry',['fixedCost' => $value->id])}}" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Detalhar"><i class="fa fa-copy"></i></a>
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
