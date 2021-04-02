@extends('layouts.app')

@section('title', 'Main page')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Lançamentos programado excluídos</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6 m-b-xs">
                                <a href="{{route('fixedCosts.index')}}" class="btn btn-default"><i class="icon-plus" title="Voltar"></i> Voltar</a>
                            </div>
                            <div class="col-sm-6">
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
                                                <form action="{{route('fixedCosts.recycle', ['fixedCost' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja restaurar?');" style="padding: 0px;margin:0px;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Excluir"><i class="fa fa-reply-all"></i></button>
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
