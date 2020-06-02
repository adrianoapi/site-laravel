@extends('dashboard.master.exam')

@section('content')

<div class="container-fluid">
    
    <div class="box box-bordered">

        <div class="box-title">
            <h3><i class="icon-plus-sign"></i> Exame Teste</h3>    
        </div>

        <div class="box-content nopadding">

            <form action="{{route('questions.confirm', ['question' => $question->id])}}" method="POST">
                @csrf
                @method('PUT')
                <table class="table table-hover table-nomargin">
                    <thead>
                        <tr>
                            <th>Questão</th>
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
                                    <input type="radio" id="{{$value->id}}" class='icheck-me' name="answer_id" value="{{$value->id}}" data-skin="square" data-color="blue"> <label class='inline' for="c7">{{$value->description}}</label>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

        </div>
        
    </div>
</div>
    
@endsection