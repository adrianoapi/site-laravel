@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    <div class="box box-bordered">
        <div class="box-title">
            <h3><i class="icon-plus-sign"></i> Altear</h3>
    
            <ul class="tabs actions">
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
                    <tr>
                        <td colspan="2">{{$question->description}}</td>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($question->answers as $value)
                    <tr>
                        <td>{{$value->description}}</td>
                        <td>{{$value->correct}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection