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
                    <a href="{{route('exams.create')}}" data-toggle="modal" class="btn"><i class="icon-plus-sign"></i> Adicionar Exame</a>
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
                    @foreach ($exams as $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>{{$value->title}}</td>
                            <td>
                                <form action="{{route('exams.destroy', ['exam' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('exams.execute', ['exam'   => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Realizar Teste"><i class="icon-desktop"></i></a>
                                    <a href="{{route('exams.show',    ['exam'   => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Visualizar"><i class="icon-search"></i></a>
                                    <a href="{{route('exams.edit',    ['exam'   => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Editar"><i class="icon-edit"></i></a>
                                    <a href="{{route('questions.index', ['filtro' => 'exame', 'id' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Questões"><i class="icon-check"></i></a>
                                    <button type="submit" class="btn" rel="tooltip" title="" data-original-title="Excluir"><i class="icon-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $exams->links('dashboard.pagination') }}
        </div>
    </div>
</div>
    
@endsection