@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    <div class="box box-bordered">
        <div class="box-title">
            <h3><i class="icon-plus-sign"></i> Detalhes</h3>

            <ul class="tabs actions">
                <li>
                    <a href="{{route('exams.index')}}" data-toggle="modal" class="btn"><i class="icon-reorder"></i> Exames</a>
                </li>
            </ul>

        </div>
        <div class="box-content nopadding">
            <form action="" method="POST" class="form-horizontal form-bordered">
                <div class="control-group">
                    <label for="title" class="control-label">Title</label>
                    <div class="controls">
                        <input type="text" name="title" id="title" value="{{$exam->title}}" placeholder="Text input" class="input-xlarge" disabled>
                    </div>
                </div>
                <div class="control-group">
                    <label for="description" class="control-label">Conteúdo</label>
                    <div class="controls">
                        <textarea name="description" id="description" rows="5" class="input-block-level" disabled>{{$exam->description}}</textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{route('exams.index')}}" class="btn">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection