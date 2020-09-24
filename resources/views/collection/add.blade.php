@extends('layouts.app')

@section('title', 'Main page')

@section('content')

<div class="wrapper wrapper-content  animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Adicionar</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#" class="dropdown-item">Config option 1</a>
                            </li>
                            <li><a href="#" class="dropdown-item">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form action="{{route('collections.store')}}" method="POST">
                        @csrf
                        
                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control"  tabindex="1">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Exibir</label>
                            <div class="col-sm-10">
                            <div class="i-checks"><label> <input type="checkbox" name="show_id" id="show_id" value="true" checked="" tabindex="6"> <i></i> ID </label></div>
                            <div class="i-checks"><label> <input type="checkbox" name="show_title" id="show_title" value="true" checked="" tabindex="6"> <i></i> Título </label></div>
                            <div class="i-checks"><label> <input type="checkbox" name="show_description" id="show_description" value="true" checked="" tabindex="6"> <i></i> Descrição </label></div>
                            <div class="i-checks"><label> <input type="checkbox" name="show_release" id="show_release" value="true" checked="" tabindex="6"> <i></i> Lançamento </label></div>
                            <div class="i-checks"><label> <input type="checkbox" name="show_image" id="show_image" value="true" checked="" tabindex="6"> <i></i> Imagem </label></div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Descrição</label>
                            <div class="col-sm-10">
                                <textarea id="content" name="description"></textarea>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Order</label>
                            <div class="col-sm-10">
                                <select name="order" data-placeholder="Choose a order..." class="chosen-select"  tabindex="2">
                                    @foreach ($order as $value)
                                        <option value="{{$value}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Layout</label>
                            <div class="col-sm-10">
                                <select name="layout" data-placeholder="Choose a layout..." class="chosen-select"  tabindex="2">
                                    @foreach ($layout as $value)
                                        <option value="{{$value}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
          
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{route('collections.index')}}" class="btn btn-white btn-sm">Cancelar</a>
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
    });
</script>
@endsection