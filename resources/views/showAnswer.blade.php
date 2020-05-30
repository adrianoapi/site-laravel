@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    <div class="box box-bordered">
        <div class="box-title">
            <h3><i class="icon-plus-sign"></i> Detalhe</h3>
    
            <ul class="tabs actions">
                <li>
                    <a href="{{route('answers.index')}}" data-toggle="modal" class="btn"><i class="icon-reorder"></i> Respostas</a>
                </li>
            </ul>
    
        </div>
        <div class="box-content nopadding">
            <form action="" method="POST" class="form-horizontal form-bordered">
                <div class="control-group">
                    <label for="question_id" class="control-label">Exame</label>
                    <div class="controls">
                        <select name="question_id" id="question_id" class="select2-me input-xlarge" disabled>
                            @foreach ($questions as $value)

                                <option value="{{$value->id}}" {{$value->id == $answer->question_id ? 'selected' : ''}}>{{$value->title}}</option>

                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label for="description" class="control-label">Conteúdo</label>
                    <div class="controls">
                        <textarea name="description" id="description" rows="5" class="input-block-level" disabled>{{$answer->description}}</textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label for="correct" class="control-label">Tipo</label>
                    <div class="controls">
                        <div class="check-demo-col">
                            <div class="check-line">
                                <input type="checkbox" id="correct" name="correct" value="true" class='icheck-me' data-skin="square" data-color="blue" {{$answer->correct == true ? 'checked' : ''}} disabled> <label class='inline' for="c9">Resosta correta</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{route('answers.index')}}" class="btn">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection