@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="pull-left">
            <h1>/transacoes-tipo</h1>
        </div>
        <div class="pull-right">
            <div class="btn-toolbar">
                <a href="{{route('transitionTypes.index')}}" class="btn btn-primary"><i class="icon-reorder" title="Listagem"></i> Listagem</a>
            </div>
        </div>
    </div>
    <div class="box box-bordered box-color">
        <div class="box-title">
            <h3><i class="icon-th-list"></i> Visualizar</h3>
        </div>
        <div class="box-content nopadding">
            <form action="" method="" class="form-horizontal form-bordered">

                <div class="control-group">
                    <label for="title" class="control-label">Title</label>
                    <div class="controls">
                        <input type="text" name="title" id="title" value="{{$transitionType->title}}" placeholder="Text input" class="input-xlarge" readonly>
                    </div>
                </div>
                <div class="control-group">
                    <label for="content" class="control-label">Conteúdo</label>
                    <div class="controls">
                        <textarea name="description" id="description" rows="5" class="input-block-level" readonly>{{$transitionType->description}}</textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Radios</label>
                    <div class="controls">
                        <label class="radio">
                            <input type="radio" name="action" value="expensive" {{ $transitionType->action === "expensive" ? "checked" : "" }} disabled> Despesa
                        </label>
                        <label class="radio">
                            <input type="radio" name="action" value="recipe" {{ $transitionType->action === "recipe" ? "checked" : "" }} disabled> Receita
                        </label>
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{route('transitionTypes.index')}}" class="btn">Voltar</a>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
