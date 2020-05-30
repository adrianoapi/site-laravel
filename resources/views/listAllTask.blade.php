@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">
    
    <div class="box box-bordered">
        <div class="box-title">
            <h3>
                <i class="glyphicon-list"></i>
                Tarefas
            </h3>
        
            <ul class="tabs actions">
                <li class="active">
                    <a href="{{route('tasks.create')}}" data-toggle="modal" class="btn"><i class="icon-plus-sign"></i> Adicionar Tarefa</a>
                </li>
            </ul>
        
        </div>
        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Categoria</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>{{$value->title}}</td>
                            <td>{{$value->taskGroup->title}}</td>
                            <td><span class="btn btn-small {{$value->status == 'closed' ? 'btn-darkblue' : 'btn-teal'}}">{{$value->status}}</span></td>
                            <td>
                                <form action="{{route('tasks.destroy', ['task' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('tasks.show', ['task' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Visualizar"><i class="icon-file-alt"></i></a>
                                    <a href="{{route('tasks.edit', ['task' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Editar"><i class="icon-edit"></i></a>
                                    <button type="submit" class="btn" rel="tooltip" title="" data-original-title="Excluir"><i class="icon-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $tasks->links('dashboard.pagination') }}
        </div>
    </div>
</div>
    
@endsection