@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    <div class="box box-bordered">
        <div class="box-title">
            <h3><i class="icon-table"></i> Respostas</h3>
        
            <ul class="tabs actions">
                <li class="active">
                    <a href="{{route('answers.create')}}" data-toggle="modal" class="btn"><i class="icon-plus-sign"></i> Adicionar Resposta</a>
                </li>
            </ul>
        
        </div>
        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin">
                <thead>
                    <tr>
                        <th class="span1">ID</th>
                        <th class="span1">Tipo</th>
                        <th class="span5">Título</th>
                        <th class="span3">Questão</th>
                        <th class="span2">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($answers as $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>{{$value->correct == true ? 'Correta' : 'Errada'}}</td>
                            <td>{{$value->title}}</td>
                            <td>{{$value->question->title}}</td>
                            <td>
                                <form action="{{route('answers.destroy', ['answer' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('answers.show', ['answer' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Visualizar"><i class="icon-file-alt"></i></a>
                                    <a href="{{route('answers.edit', ['answer' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Editar"><i class="icon-edit"></i></a>
                                    <button type="submit" class="btn" rel="tooltip" title="" data-original-title="Excluir"><i class="icon-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $answers->links('dashboard.pagination') }}
        </div>
    </div>
</div>
    
@endsection