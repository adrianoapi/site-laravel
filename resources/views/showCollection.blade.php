@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    <div class="box box-bordered">
        <div class="box-title">
            <h3><i class="icon-plus-sign"></i> Detalhes</h3>

            <ul class="tabs actions">
                <li>
                    <a href="{{route('collItems.create',    ['collection'   => $collection->id])}}" class="btn" rel="tooltip" title="" data-original-title="Adicionar Item"><i class="glyphicon-tag"></i></a>
                    <a href="{{route('collections.edit',    ['collection'   => $collection->id])}}" class="btn" rel="tooltip" title="" data-original-title="Editar"><i class="icon-edit"></i></a>
                    <a href="{{route('collections.index')}}" data-toggle="modal" class="btn"><i class="icon-reorder"></i> collectiones</a>
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
                        <td>{{$collection->title}}</td>
                        <td>{{$collection->description}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin">
                <thead>
                    <tr>
                        @if($collection->show_id)
                            <th class="span1">Id</th>
                        @endif

                        @if($collection->show_image)
                            <th class="span2">Imagem</th>
                        @endif

                        @if($collection->show_title)
                            <th class="span3">Titulo</th>
                        @endif

                        @if($collection->show_description)
                            <th class="span3">Descrição</th>
                        @endif

                        @if($collection->show_release)
                            <th class="span2">Lançamento</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collection->items as $value)
                    <tr>
                        @if($collection->show_id)
                            <td>{{$value->id}}</td>
                        @endif

                        @if($collection->show_image)
                            <td>
                                @if (!empty($value->images[0]->collection_item_id))
                                <a href="#new-task" data-toggle="modal" class='btn'>
                                    <img src="data:{{$value->images[0]->type}};base64, {{$value->images[0]->image}}" width="120" alt="" />
                                </a>
                                @endif    
                            </td>
                        @endif

                        @if($collection->show_description)
                            <td>{{$value->title}}</td>
                        @endif

                        @if($collection->show_description)
                            <td>{!! html_entity_decode($value->description) !!}</td>
                        @endif

                        @if($collection->show_release)
                            <td>{{$value->release}}</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<div id="new-task" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Add new task</h3>
    </div>
    <form action="#" class='new-task-form form-horizontal form-bordered'>
        <div class="modal-body nopadding">
            <div class="control-group">
                <label for="tasktitel" class="control-label">Icon</label>
                <div class="controls">
                    <select name="icons" id="icons" class='select2-me input-xlarge'>
                        <option value="icon-adjust">icon-adjust</option>
                        <option value="icon-asterisk">icon-asterisk</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label for="task-name" class="control-label">Task</label>
                <div class="controls">
                    <input type="text" name="task-name">
                </div>
            </div>
            <div class="control-group">
                <label for="tasktitel" class="control-label"></label>
                <div class="controls">
                    <label class="checkbox"><input type="checkbox" name="task-bookmarked" value="yep"> Mark as important</label>
                </div>
            </div>
        </div>
    </form>

</div>



@endsection