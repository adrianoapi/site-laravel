@extends('layouts.app')

@section('title', 'Main page')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Detalhes</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6 m-b-xs">
                                <a href="{{route('collections.index')}}" class="btn btn-white"> <i class="fa fa-arrow-circle-o-left"></i></a>
                                <a href="{{route('collItems.create',    ['collection'   => $collection->id])}}" class="btn btn-white" rel="tooltip" title="" data-original-title="Adicionar Item">Adicionar Item</a>
                                <a href="{{route('collections.edit',    ['collection'   => $collection->id])}}" class="btn btn-white" rel="tooltip" title="" data-original-title="Editar">Editar</a>
                            </div>
                            <div class="col-sm-6">
                                <form action="{{route('collections.show', ['collection'   => $collection->id])}}" method="GET" class="span3" style="margin: 0;padding:0;">
                                    <input type="hidden" name="filtro" value="pesquisa">
                                    <div class="input-group">
                                        <input placeholder="Search" type="text" name="pesquisar" value="{{array_key_exists('pesquisar', $_GET) ? $_GET['pesquisar'] : ''}}" class="form-control form-control-sm">
                                        <span class="input-group-append"> <button type="submit" class="btn btn-sm btn-primary">Go!</button> </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">


                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="span2">Título</th>
                                        <th class="span2">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$collection->title}}</td>
                                        <td>{{count($collection->items)}}</td>
                                    </tr>
                                </tbody>
                            </table>

                            @if($collection->layout == "gallery")

                            <div class="row">
                            @foreach ($collectionItems as $value)
                                    <div class="contact-box">
                                    <form name="frm-{{ $value->id }}" action="" method="POST">@csrf</form>
                                    <a href="#new-task" onclick="showAjax({{ $value->id }})" class="btn btn-sm btn-white" data-toggle="modal" data-target="#myModal5">
                                            <div class="text-center">
                                                <img alt="image" src="data:{{$value->images[0]->type}};base64, {{$value->images[0]->image}}" width="120">
                                                @if($collection->show_title)
                                                <div class="m-t-xs font-bold">{{$value->title}}</div>
                                                @endif
                                                @if($collection->show_release)
                                                <div class="m-t-xs font-bold">{{$value->release}}</div>
                                                @endif
                                                @if($collection->show_description)
                                                <div class="m-t-xs font-bold">{{$value->description}}</div>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            @else
                            <table class="table table-hover table-nomargin">
                                <thead>
                                    <tr>
                                        @if($collection->show_id)
                                            <th>Id</th>
                                        @endif

                                        @if($collection->show_image)
                                            <th class="span2">Imagem</th>
                                        @endif

                                        @if($collection->show_title)
                                            <th class="span3">Titulo</th>
                                        @endif

                                        @if($collection->show_description)
                                            <th class="span3">Descrição</th>
                                        @endif

                                        @if($collection->show_release)
                                            <th class="span2">Lançamento</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($collectionItems as $value)
                                    <tr>
                                        @if($collection->show_id)
                                            <td>{{$value->id}}</td>
                                        @endif

                                        @if($collection->show_image)
                                            <td>
                                                @if (!empty($value->images[0]->collection_item_id))
                                                <form name="frm-{{ $value->id }}" action="" method="POST">
                                                    @csrf
                                                <a href="#new-task" onclick="showAjax({{ $value->id }})" class="btn btn-sm btn-white" data-toggle="modal" data-target="#myModal5">
                                                    <img src="data:{{$value->images[0]->type}};base64, {{$value->images[0]->image}}" width="120" alt="" />
                                                </a>
                                                </form>
                                                @endif
                                            </td>
                                        @endif

                                        @if($collection->show_title)
                                            <td>{{$value->title}}</td>
                                        @endif

                                        @if($collection->show_description)
                                            <td>{!! html_entity_decode($value->description) !!}</td>
                                        @endif

                                        @if($collection->show_release)
                                            <td>{{$value->release}}</td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif

                            <div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                    <form name="addAjax" method="post" id="addTask" action="{{route('tasks.addAjax')}}">
                                        @csrf
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            Info
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

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>

function qsa(sel) {
    return Array.apply(null, document.querySelectorAll(sel));
}
qsa(".code").forEach(function (editorEl) {
  CodeMirror.fromTextArea(editorEl, {
    lineNumbers: true,
    styleActiveLine: true,
    matchBrackets: true,
    theme: 'monokai',
  });
});

    function showAjax(value)
    {
        $("#modal-content").html('');

        var attributes = $("form[name=frm-"+value+"]").serialize();
        $.ajax({
            url: "{{route('collItems.view')}}",
            type: "POST",
            data: attributes+'&id='+value,
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
