@extends('layouts.app')

@section('title', 'Main page')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Senhas</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6 m-b-xs">
                                <a href="{{route('passwords.create')}}" class="btn btn-white">Adicionar</a>
                            </div>
                            <div class="col-sm-6">
                                <form action="{{route('passwords.index')}}" method="GET" class="span3" style="margin: 0;padding:0;">
                                    <div class="input-group">
                                    <input type="hidden" name="filtro" value="pesquisa">
                                        <input placeholder="Search" type="text" name="pesquisar" value="{{array_key_exists('pesquisar', $_GET) ? $_GET['pesquisar'] : ''}}" class="form-control form-control-sm">
                                        <span class="input-group-append">
                                            <button type="submit" class="btn btn-sm btn-primary">Go!</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            
                            <table class="table table-bordered table-hover table-nomargin">
                                <thead>
                                    <tr>
                                        <th class="">ID</th>
                                        <th class="w-75">Título</th>
                                        <th class="">Ações</th>
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
                                                     <button type="button" onclick="showAjax({{ $value->id }})" class="btn btn-sm btn-white" data-toggle="modal" data-target="#myModal5"> <i class="fa fa-search"></i></button>
                                                    <a href="{{route('passwords.edit',   ['password' => $value->id])}}" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Editar"><i class="fa fa-edit"></i></a>
                                                    <button type="submit" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Excluir"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $passwords->links('dashboard.pagination') }}

                            <div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                    <form name="addAjax" method="post" id="addTask" action="{{route('tasks.addAjax')}}">
                                        @csrf
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h6 class="modal-title">Cadastrar tarefa</h6>
                                        </div>
                                        <div class="modal-body">

                                            <div class="ibox-content" id="modal-content"></div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
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

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
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

    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
@endsection