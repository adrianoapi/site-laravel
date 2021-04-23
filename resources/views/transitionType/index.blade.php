@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    <div class="box box-bordered">
        <div class="box-title">
            <h3>
                <i class="icon-table"></i>
                Exames
            </h3>

            <ul class="tabs actions">
                <li class="active">
                    <a href="{{route('transitionTypes.create')}}" class="btn"><i class="icon-plus-sign"></i> Adicionar</a>
                </li>
            </ul>

        </div>
        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Categoria</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transitionTypes as $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>{{$value->title}}</td>
                            <td><span class="label label-{{$value->action == 'expensive' ? 'red' : 'info'}}">{{$value->action}}</span></td>
                            <td>
                            <form action="{{route('transitionTypes.destroy', ['transitionType' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('transitionTypes.show',    ['transitionType'   => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Visualizar"><i class="icon-search"></i></a>
                                    <a href="{{route('transitionTypes.edit',    ['transitionType'   => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Editar"><i class="icon-edit"></i></a>
                                    <button type="submit" class="btn" rel="tooltip" title="" data-original-title="Excluir"><i class="icon-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $transitionTypes->links('dashboard.pagination') }}
        </div>
    </div>
</div>

@endsection


