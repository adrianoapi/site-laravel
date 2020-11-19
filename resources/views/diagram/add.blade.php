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
                    <form action="{{route('diagrams.store')}}" method="POST">
                        @csrf

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control"  tabindex="1">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>


                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Body</label>
                            <div class="col-sm-10">
                                <textarea id="content" name="body"></textarea>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">type</label>
                            <div class="col-sm-10">
                                <input type="text" name="type" value="mindMap" class="form-control"  tabindex="1">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{route('diagrams.index')}}" class="btn btn-white btn-sm">Cancelar</a>
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


</script>
@endsection
