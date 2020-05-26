@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="pull-left">
            <h1>/tarefas-grupo</h1>
        </div>
        <div class="pull-right">
            <div class="btn-toolbar">
                <a href="{{route('tasks.index')}}" class="btn btn-primary"><i class="icon-reorder" title="Listagem"></i> Listagem</a>
            </div> 
        </div> 
    </div>
    <div class="box box-bordered box-color">
        <div class="box-title">
            <h3><i class="icon-th-list"></i> Detalhes</h3>
        </div>
        <div class="box-content nopadding">
            <form action="{{route('tasks.update', ['task' => $task->id])}}" method="POST" class="form-horizontal form-bordered">
                <div class="control-group">
                    <label for="title" class="control-label">Title</label>
                    <div class="controls">
                        <input type="text" name="title" id="title" value="{{$task->title}}" placeholder="Text input" class="input-xlarge" disabled>
                    </div>
                </div>
                <div class="control-group">
                    <label for="task_group_id" class="control-label">Basic</label>
                    <div class="controls">
                        <select name="task_group_id" id="task_group_id" class="select2-me input-xlarge" disabled>
                            @foreach ($taskGroup as $value)

                                @if ($value->id == $task->task_group_id)
                                    <option value="{{$value->id}}" selected>{{$value->title}}</option>
                                @else
                                    <option value="{{$value->id}}">{{$value->title}}</option>
                                @endif
                                
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label for="content" class="control-label">Conteúdo</label>
                    <div class="controls">
                        <textarea name="content" id="content" rows="5" class="input-block-level" disabled>{{$task->content}}</textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{route('tasks.index')}}" class="btn">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection