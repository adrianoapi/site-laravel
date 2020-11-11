@extends('layouts.app')

@section('title', 'Main page')

@section('content')

<div class="wrapper wrapper-content  animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Editar</h5>
                    <div class="ibox-tools">

                        <div class="btn-group">
                            <a href="{{route('collItems.show',   ['collection'  => $collection->id])}}" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-reply"></i> Listar itens</a>
                            <a href="{{route('collItems.show',   ['collection'  => $collItem->collection->id])}}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Send"><i class="fa fa-pencil"></i>  Novo Item</a>
                            <a href="{{route('collections.index')}}" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to draft folder"><i class="fa fa-search"></i> Coleção</a>
                        </div>

                    </div>
                </div>
                <div class="ibox-content">

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
                                    <td>{{$collItem->collection->title}}</td>
                                    <td>{{$collItem->collection->description}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <form action="{{route('collItems.update', ['collItem' => $collItem->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Titulo</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" value="{{$collItem->title}}" class="form-control"  tabindex="1">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Descrição</label>
                            <div class="col-sm-10">
                                <textarea id="content" name="description">{{$collItem->description}}</textarea>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row" id="data_1">
                            <label class="col-sm-2 col-form-label">Lançamento</label>
                            <div class="col-sm-5">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="release" value="{{$collItem->release}}" id="release" class="form-control" value="<?php echo date('d/m/yy'); ?>" tabindex="4">
                                </div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{route('collItems.index')}}" class="btn btn-white btn-sm">Cancelar</a>
                                <button class="btn btn-primary btn-sm" type="submit">Save </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection

@section('scripts')
<script>
    $('.chosen-select').chosen({width: "100%"});

    $(document).ready(function () {

        $('#content').summernote();

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

        var mem = $('#data_1 .input-group.date').datepicker({
        format: "dd/mm/yyyy",
            language: "pt-BR",
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
        });

    });
</script>
@endsection
