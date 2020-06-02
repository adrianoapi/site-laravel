@extends('dashboard.master.exam')

@section('content')

<div class="container-fluid">
    
    <div class="box box-bordered">
        
        <p>&nbsp;</p>
        @if ($answer->correct)
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            Resposta <strong>certa</strong>!
        </div>
        @else
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            Resposta <strong>errada</strong>!
        </div>
        @endif

        <div class="box-title">
            <h3><i class="icon-plus-sign"></i> Confirm</h3>    
        </div>

        <div class="box-content nopadding">

            <table class="table table-hover table-nomargin">
                <thead>
                    <tr>
                        <th colspan="2">Questão</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{!! html_entity_decode($question->description) !!}</td>
                    </tr>
                    @foreach ($question->answers as $value)
                    <tr>
                        <td>
                            <div class="check-line">
                            <input type="radio" id="{{$value->id}}" class='icheck-me' data-skin="square" data-color="blue" {{$value->id == $answer->id ? 'checked' : ''}}> <label class='inline' for="c7">{{$value->description}}</label>
                            </div>
                        </td>
                        <td>
                            @if ($value->correct)
                                <span class="btn btn-success">[certo]<span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    <thead>
                        <tr>
                            <td colspan="2">
                                <a href="{{route('exams.execute', ['exam' => $question->exam->id])}}" class="btn">Voltar</a>
                            </td>
                        </tr>
                    </thead>
                </tbody>
            </table>

        </div>
        
    </div>
</div>
    
@endsection