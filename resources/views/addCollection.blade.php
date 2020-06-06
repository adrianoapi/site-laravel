@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    <div class="box box-bordered">
        <div class="box-title">
            <h3><i class="icon-plus-sign"></i> Adicionar</h3>

            <ul class="tabs actions">
                <li>
                    <a href="{{route('collections.index')}}" data-toggle="modal" class="btn"><i class="icon-reorder"></i> Exames</a>
                </li>
            </ul>

        </div>
        <div class="box-content nopadding">
            <form action="{{route('collections.store')}}" method="POST" class="form-horizontal form-bordered">
                @csrf
                <div class="control-group">
                    <label for="title" class="control-label">Title</label>
                    <div class="controls">
                        <input type="text" name="title" id="title" placeholder="Text input" class="input-xlarge">
                    </div>
                </div>
                <div class="control-group">
                    <label for="description" class="control-label">Conteúdo</label>
                    <div class="controls">
                        <textarea name="description" id="description" rows="5" class="input-block-level"></textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{route('collections.index')}}" class="btn">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection