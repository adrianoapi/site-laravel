@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">
    
    <div class="box box-bordered">
        <div class="box-title">
            <h3>
                <i class="icon-table"></i>
                Coleção
            </h3>

            <ul class="tabs actions">
                <li class="active">
                    <a href="{{route('collections.create')}}" data-toggle="modal" class="btn"><i class="icon-plus-sign"></i> Adicionar coleção</a>
                </li>
            </ul>

        </div>
        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin">
                <thead>
                    <tr>
                        <th class="span2">ID</th>
                        <th class="span8">Título</th>
                        <th class="span2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collections as $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>{{$value->title}}</td>
                            <td>
                                <form action="{{route('collections.destroy', ['collection' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('collItems.create',    ['collection'   => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Adicionar Item"><i class="icon-file-alt"></i></a>
                                    <a href="{{route('collections.show',    ['collection'   => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Visualizar"><i class="icon-file-alt"></i></a>
                                    <a href="{{route('collections.edit',    ['collection'   => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Editar"><i class="icon-edit"></i></a>
                                    <button type="submit" class="btn" rel="tooltip" title="" data-original-title="Excluir"><i class="icon-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $collections->links('dashboard.pagination') }}
        </div>
    </div>
</div>
    
@endsection