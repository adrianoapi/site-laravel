@extends('layouts.app')

@section('title', 'Main page')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Coleções</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6 m-b-xs">
                                <a href="{{route('collections.create')}}" class="btn btn-primary">Adicionar coleção</a>
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
                                        <th class="span2">ID</th>
                                        <th class="span8">Título</th>
                                        <th class="span2">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($collections as $value)
                                        <tr>
                                            <td>{{$value->id}}</td>
                                            <td>{{$value->title}}</td>
                                            <td>
                                                <form action="{{route('collections.destroy', ['collection' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{route('collections.show',    ['collection'   => $value->id])}}" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Visualizar"><i class="fa fa-search"></i></a>
                                                    <a href="{{route('collItems.create',    ['collection'   => $value->id])}}" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Adicionar Item"><i class="fa fa-plus-square"></i></i></a>
                                                    <a href="{{route('collections.edit',    ['collection'   => $value->id])}}" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Editar"><i class="fa fa-edit"></i></i></a>
                                                    <button type="submit" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Excluir"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $collections->links('dashboard.pagination') }}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection