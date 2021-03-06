@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    @if (is_object($collItem))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Resposta <strong>{{$collItem->description}}</strong> craido com sucesso!
    </div>
    @endif

    <div class="box box-bordered">
        <div class="box-title">
            <h3><i class="icon-plus-sign"></i> Adicionar</h3>

            <ul class="tabs actions">
                <li>
                    <a href="{{route('collItems.create', ['collection' => $collItem->collection->id])}}" data-toggle="modal" class="btn"><i class="icon-edit"></i> Novo Item</a>
                </li>
                <li>
                    <a href="{{route('collItems.show',   ['collection'  => $collItem->collection->id])}}" data-toggle="modal" class="btn"><i class="glyphicon-tags"></i> Itens</a>
                </li>
                <li>
                    <a href="{{route('collections.index')}}" data-toggle="modal" class="btn"><i class="icon-reorder"></i> Coleções</a>
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
                        <td>{{$collItem->collection->title}}</td>
                        <td>{{$collItem->collection->description}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="box-content nopadding">
            <form action="{{route('collItems.update', ['collItem' => $collItem->id])}}" method="POST" class="form-horizontal form-bordered">
                @csrf
                @method('PUT')
                <div class="control-group">
                    <label for="title" class="control-label">Title</label>
                    <div class="controls">
                        <input type="text" name="title" value="{{$collItem->title}}" id="title" placeholder="Text input" class="input-xlarge">
                    </div>
                </div>
                <div class="control-group">
                    <label for="description" class="control-label">Descrição</label>
                    <div class="controls">
                        <textarea name="description" id="description" rows="5" class="ckeditor span12">{{$collItem->description}}</textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label for="release" class="control-label">Lançamento</label>
                    <div class="controls">
                        <input type="text" value="{{$collItem->release}}" name="release" id="release" class="input-medium datepick">
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{route('collItems.show', ['collection' => $collItem->collection->id])}}" class="btn">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    {literal}
    CKEDITOR.replace( 'description',
    {
        language: 'he'
    });
    {/literal}
</script>
@endsection
