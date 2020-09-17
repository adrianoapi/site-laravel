@extends('layouts.app')

@section('title', 'Transação tipo')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Transação tipo</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6 m-b-xs">
                                <a href="{{route('transitionTypes.create')}}" class="btn btn-primary"><i class="icon-plus" title="Adicionar"></i> Adicionar</a>
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
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Categoria</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transitionTypes as $value)
                                        <tr>
                                            <td>{{$value->id}}</td>
                                            <td>{{$value->title}}</td>
                                            <td><span class="label label-{{$value->action == 'recipe' ? 'info' : 'danger'}}">{{$value->action}}</span></td>
                                            <td>
                                                <form action="{{route('transitionTypes.destroy', ['transitionType' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{route('transitionTypes.show', ['transitionType' => $value->id])}}" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Visualizar"><i class="fa fa-search"></i></a>
                                                    <a href="{{route('transitionTypes.edit', ['transitionType' => $value->id])}}" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Editar"><i class="fa fa-edit"></i></a>
                                                    <button type="submit" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Excluir"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $transitionTypes->links('dashboard.pagination') }}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection