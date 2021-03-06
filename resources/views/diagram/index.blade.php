@extends('layouts.app')

@section('title', 'Main page')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Diagramas</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-sm-6 m-b-xs">
                                <a href="{{route('diagrams.create')}}" class="btn btn-white">Adicionar</a>
                            </div>
                        </div>

                        <div class="table-responsive">

                            <table class="table table-bordered table-hover table-nomargin">
                                <thead>
                                    <tr>
                                        <th class="w-50">Title</th>
                                        <th>Type</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($diagrams as $value)
                                        <tr>
                                            <td>{{$value->title}}</td>
                                            <td>{{$value->type}}</td>
                                            <td>
                                                <form action="{{route('diagrams.destroy', ['diagram' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{route('diagrams.edit', ['diagram' => $value->id])}}" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Editar"><i class="fa fa-edit"></i></a>
                                                    <button type="submit" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Excluir"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $diagrams->links('dashboard.pagination') }}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
