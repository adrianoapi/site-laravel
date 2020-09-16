@extends('layouts.app')

@section('title', 'Transação tipo / cadastrar')

@section('content')

<div class="wrapper wrapper-content  animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Transação tipo: cadastrar></h5>
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
                    <form action="{{route('transitionTypes.store')}}" method="POST" class="form-horizontal form-bordered">
                        @csrf
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Título</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" id="title" value="" class="form-control" tabindex="1">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Descrição</label>
                            <div class="col-sm-10">
                                <textarea id="content" name="description"></textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group row"><label class="col-sm-2 col-form-label">Tipo de despesa <br/><small class="text-navy">Entrada/Saída de dinheiro</small></label>

                            <div class="col-sm-10">
                                <div class="i-checks"><label> <input type="radio" name="action" value="recipe"     checked> <i></i> Receita</label></div>
                                <div class="i-checks"><label> <input type="radio" name="action" value="expensive"> <i></i> Despesa </label></div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Cartão de crédito<br>
                            <small>Define que será somado apenas na fatura</small></label>
                            <div class="col-sm-10">
                                <div class="i-checks"><label> <input type="checkbox" name="credit_card" id="credit_card" value="true" tabindex="6"> <i></i> Cartão de crédito </label></div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
          
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{route('transitionTypes.index')}}" class="btn btn-white btn-sm">Cancelar</a>
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