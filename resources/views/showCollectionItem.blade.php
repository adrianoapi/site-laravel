@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    <div class="box box-bordered">
        <div class="box-title">
            <h3><i class="icon-plus-sign"></i> Adicionar</h3>

            <ul class="tabs actions">
                <li>
                    <a href="{{route('collItems.create', ['collection' => $collection->id])}}" data-toggle="modal" class="btn"><i class="icon-edit"></i> Novo Item</a>
                </li>
                <li class="active">
                    <a href="{{route('collItems.show',   ['collection'  => $collection->id])}}" data-toggle="modal" class="btn"><i class="glyphicon-tags"></i> Resostas</a>
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
                        <th class="span4">Descrição</th>
                        <th class="span2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collection->items as $value)
                    <tr>
                        <td>{{$value->title}}</td>
                        <td>
                            <form action="{{route('collItems.destroy', ['collItem' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-inverse"><i class="icon-trash"></i> Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    
@endsection