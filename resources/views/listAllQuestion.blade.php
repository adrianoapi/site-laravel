@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    <div class="box box-bordered">
        <div class="box-title">

            <form action="{{route('questions.index')}}" method="GET" class="span3" style="margin: 0;padding:0;">
                <div class="input-append input-prepend" style="margin: 0;padding:0;">
                    <span class="add-on"><i class="icon-search"></i></span>
                    <input type="hidden" name="filtro" value="pesquisa">
                    <input type="text" name="pesquisar" value="{{array_key_exists('pesquisar', $_GET) ? $_GET['pesquisar'] : ''}}" placeholder="título..." class="input-medium">
                    <button class="btn" type="submit">Pesquisar</button>
                </div>
            </form>
        
            <ul class="tabs actions">
                <li class="active">
                    <a href="{{route('questions.create')}}" data-toggle="modal" class="btn"><i class="icon-plus-sign"></i> Adicionar Questão</a>
                </li>
            </ul>
        
        </div>
        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin">
                <thead>
                    <tr>
                        <th class="span2">ID</th>
                        <th class="span5">Título</th>
                        <th class="span3">Exame</th>
                        <th class="span2">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>{{$value->title}}</td>
                            <td>{{$value->exam->title}}</td>
                            <td>
                                <form action="{{route('questions.destroy', ['question' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('questions.show', ['question' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Visualizar"><i class="icon-file-alt"></i></a>
                                    <a href="{{route('questions.edit', ['question' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Editar"><i class="icon-edit"></i></a>
                                    <a href="{{route('answers.create', ['question' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Adicionar Resosta"><i class="icon-plus-sign"></i></a>
                                    <button type="submit" class="btn" rel="tooltip" title="" data-original-title="Excluir"><i class="icon-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $questions->links('dashboard.pagination') }}
        </div>
    </div>
</div>
    
@endsection