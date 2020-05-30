@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    <div class="box box-bordered">
        <div class="box-title">
            <h3><i class="icon-plus-sign"></i> Adicionar</h3>

            <ul class="tabs actions">
                <li>
                    <a href="{{route('answers.create', ['question' => $question->id])}}" data-toggle="modal" class="btn"><i class="icon-edit"></i> Nova Resposta</a>
                </li>
                <li class="active">
                    <a href="{{route('answers.show',   ['question'  => $question->id])}}" data-toggle="modal" class="btn"><i class="icon-shopping-cart"></i> Resostas</a>
                </li>
                <li>
                    <a href="{{route('questions.index')}}" data-toggle="modal" class="btn"><i class="icon-reorder"></i> Questões</a>
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
                        <td>{{$question->title}}</td>
                        <td>{{$question->exam->title}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin">
                <thead>
                    <tr>
                        <th class="span4">Descrição</th>
                        <th class="span2">Tipo</th>
                        <th class="span2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($answers as $value)
                    <tr>
                        <td>{{$value->description}}</td>
                        <td>{{$value->correct}}</td>
                        <td>
                            <form action="{{route('answers.destroy', ['answer' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
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