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
            <h3><i class="icon-th-list"></i> Adicionar</h3>
        </div>
        <div class="box-content nopadding">
            <form action="{{route('tasks.store')}}" method="POST" class="form-horizontal form-bordered">
                @csrf
                <div class="control-group">
                    <label for="title" class="control-label">Title</label>
                    <div class="controls">
                        <input type="text" name="title" id="title" placeholder="Text input" class="input-xlarge">
                    </div>
                </div>
                <div class="control-group">
                    <label for="task_group_id" class="control-label">Basic</label>
                    <div class="controls">
                        <select name="task_group_id" id="task_group_id" class="select2-me input-xlarge">
                            @foreach ($taskGroup as $value)
                                <option value="{{$value->id}}">{{$value->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Radios</label>
                    <div class="controls">
                        <label class="radio">
                            <input type="radio" name="status" value="open"> Aberta
                        </label>
                        <label class="radio">
                            <input type="radio" name="status" value="closed"> Fechada
                        </label>
                        <label class="radio">
                            <input type="radio" name="status" value="deleted"> Deletada
                        </label>
                    </div>
                </div>
                <div class="control-group">
                    <label for="content" class="control-label">Conteúdo</label>
                    <div class="controls">
                        <textarea name="content" id="content" rows="5" class="input-block-level"></textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{route('tasks.index')}}" class="btn">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection