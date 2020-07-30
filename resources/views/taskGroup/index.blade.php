@extends('layouts.app')

@section('title', 'Main page')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Tarefas grupo</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6 m-b-xs">
                                <a href="{{route('taskGroups.create')}}" class="btn btn-primary"><i class="icon-plus" title="Adicionar"></i> Adicionar</a>
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
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($taskGroups as $value)
                                        <tr>
                                            <td>{{$value->id}}</td>
                                            <td>{{$value->title}}</td>
                                            <td>
                                                <form action="{{route('taskGroups.destroy', ['taskGroup' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{route('taskGroups.show', ['taskGroup' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Visualizar"><i class="icon-file-alt"></i></a>
                                                    <a href="{{route('taskGroups.edit', ['taskGroup' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Editar"><i class="icon-edit"></i></a>
                                                    <button type="submit" class="btn" rel="tooltip" title="" data-original-title="Excluir"><i class="icon-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $taskGroups->links('dashboard.pagination') }}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection