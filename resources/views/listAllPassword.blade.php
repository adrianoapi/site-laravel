@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">
    
    <div class="box box-bordered">
        <div class="box-title">
            <h3>
                <i class="icon-table"></i>
                Senhas
            </h3>

            <ul class="tabs actions">
                <li class="active">
                    <a href="{{route('passwords.create')}}" data-toggle="modal" class="btn"><i class="icon-plus-sign"></i> Adicionar coleção</a>
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
                    @foreach ($passwords as $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>{{$value->title}}</td>
                            <td>
                                <form action="{{route('passwords.destroy', ['password' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('passwords.show',   ['password' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Visualizar"><i class="icon-search"></i></a>
                                    <a href="{{route('collItems.create', ['password' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Adicionar Item"><i class="glyphicon-tag"></i></a>
                                    <a href="{{route('passwords.edit',   ['password' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Editar"><i class="icon-edit"></i></a>
                                    <button type="submit" class="btn" rel="tooltip" title="" data-original-title="Excluir"><i class="icon-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $passwords->links('dashboard.pagination') }}
        </div>
    </div>
</div>
    
@endsection