@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    <div class="box box-bordered">
        <div class="box-title">
            <h3><i class="icon-plus-sign"></i> Adicionar</h3>
    
            <ul class="tabs actions">
                <li>
                    <a href="{{route('answers.index')}}" data-toggle="modal" class="btn"><i class="icon-reorder"></i> Respostas</a>
                </li>
            </ul>
    
        </div>
        <div class="box-content nopadding">
            <form action="{{route('answers.store')}}" method="POST" class="form-horizontal form-bordered">
                @csrf
                <div class="control-group">
                    <label for="question_id" class="control-label">Exame</label>
                    <div class="controls">
                        <select name="question_id" id="question_id" class="select2-me input-xlarge">
                            @foreach ($questions as $value)

                                <option value="{{$value->id}}">{{$value->title}}</option>

                            @endforeach
                        </select>
                    </div>
                </div>
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
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{route('answers.index')}}" class="btn">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection