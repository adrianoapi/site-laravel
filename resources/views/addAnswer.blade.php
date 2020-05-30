@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    @if (is_object($answer))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Resposta <strong>{{$answer->description}}</strong> craido com sucesso!
    </div>
    @endif

    <div class="box box-bordered">
        <div class="box-title">
            <h3><i class="icon-plus-sign"></i> Adicionar</h3>

            <ul class="tabs actions">
                <li class="active">
                    <a href="{{route('answers.create', ['question' => $question->id])}}" data-toggle="modal" class="btn"><i class="icon-edit"></i> Nova Resposta</a>
                </li>
                <li>
                    <a href="{{route('answers.show',   ['question'  => $question->id])}}" data-toggle="modal" class="btn"><i class="icon-shopping-cart"></i> Resostas</a>
                </li>
                <li>
                    <a href="{{route('questions.index')}}" data-toggle="modal" class="btn"><i class="icon-reorder"></i> Questões</a>
                </li>
            </ul>

        </div>

        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin">
                <thead>
                    <tr>
                        <th class="span2">Título</th>
                        <th class="span2">Exame</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$question->title}}</td>
                        <td>{{$question->exam->title}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="box-content nopadding">
            <form action="{{route('answers.store')}}" method="POST" class="form-horizontal form-bordered">
                @csrf
                <div class="control-group">
                    <label for="description" class="control-label">Conteúdo</label>
                    <div class="controls">
                        <textarea name="description" id="description" rows="5" class="input-block-level"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label for="correct" class="control-label">Tipo</label>
                    <div class="controls">
                        <div class="check-demo-col">
                            <div class="check-line">
                                <input type="checkbox" id="correct" name="correct" value="true" class='icheck-me' data-skin="square" data-color="blue"> <label class='inline' for="c9">Resosta correta</label>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="question_id" value="{{$question->id}}">
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{route('answers.index')}}" class="btn">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection