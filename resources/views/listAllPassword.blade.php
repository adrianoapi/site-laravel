@extends('dashboard.master.layout')

@section('content')

<script>
    function showAjax(value)
    {
        $("#modal-content").html('');

        var attributes = $("form[name=frm-"+value+"]").serialize().replace(/&_method=delete/i, '');
        
        $.ajax({
            url: "{{route('passwords.show')}}",
            type: "POST",
            data: attributes,
            dataType: 'json',
            success: function(data){
                $("#modal-content").html(data['body']);
            }
        });
    }
</script>

<div class="container-fluid">
    
    <div class="box box-bordered">
        <div class="box-title">
            <h3>
                <i class="icon-table"></i>
                Senhas
            </h3>

            <ul class="tabs actions">
                <li class="active">
                    <a href="{{route('passwords.create')}}" data-toggle="modal" class="btn"><i class="icon-plus-sign"></i> Adicionar Senha</a>
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
                                <form name="frm-{{ $value->id }}" action="{{route('passwords.destroy', ['password' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="passowrd" value="{{ $value->id }}">
                                    <a href="#new-task" onclick="showAjax({{ $value->id }})" data-toggle="modal" class='btn'><i class="icon-search"></i></a>
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

<div id="new-task" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h5 id="myModalLabel">Show</h5>
    </div>
    <div id="modal-content">conteúdo...</div>
</div>

@endsection