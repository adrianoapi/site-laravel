@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    <div class="box box-bordered">
        <div class="box-title">
            <h3><i class="icon-plus-sign"></i> Detalhes</h3>

            <ul class="tabs actions">
                <li>
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
                        <th class="span2">Imagem</th>
                        <th class="span5">Item</th>
                        <th class="span3">Descrição</th>
                        <th class="span2">Lançamento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collection->items as $value)
                    <tr>
                        <td>
                            @if (!empty($value->images[0]->collection_item_id))
                            <img src="data:{{$value->images[0]->type}};base64, {{$value->images[0]->image}}" width="120" alt="" />
                            @endif
                        <td>{{$value->title}}</td>
                        <td>{{$value->description}}</td>
                        <td>{{$value->release}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>



@endsection