@extends('layouts.app')

@section('title', 'Main page')

@section('content')

<div class="wrapper wrapper-content  animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><i class="fa fa-plus"></i> Item <small>Adicção de intes no orçamento.</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-6 m-b-xs">
                            <a href="{{route('ledgerItems.create', ['ledgerEntry' => $ledgerEntry->id])}}" class="btn btn-info"><i class="icon-edit"></i> Novo Item</a>
                            <a href="{{route('ledgerItems.show', ['ledgerEntry' => $ledgerEntry->id])}}" class="btn btn-default"><i class="icon-shopping-cart"></i> Itens</a>
                            <a href="{{route('ledgerEntries.index')}}" class="btn btn-default"><i class="icon-reorder"></i> Lancamentos</a>
                        </div>
                        <div class="col-sm-6">
                            
                        </div>
                    </div>

                    <table class="table table-bordered table-hover table-nomargin">
                        <thead>
                            <tr>
                                <th class="span2">Data</th>
                                <th class="span2">Valor</th>
                                <th class="span2">Lançamento</th>
                                <th class="span4">Tipo de Despesa</th>
                                <th class="span2">Tipo de Transação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$ledgerEntry->entry_date}}</td>
                                <td>{{$ledgerEntry->amount}}</td>
                                <td>{{$ledgerEntry->description}}</td>
                                <td>{{$ledgerEntry->ledgerGroup->ledgerGroup->title}} > {{$ledgerEntry->ledgerGroup->title}}</td>
                                <td>{{$ledgerEntry->transitionType->title}}</td>
                            </tr>
                        </tbody>
                    </table>

                    <form action="{{route('ledgerItems.store')}}" method="POST">
                        @csrf
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Descrição</label>
                            <div class="col-sm-10">
                                <input type="text" name="description" id="description" placeholder="descrição..." class="form-control" tabindex="1">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row"><label class="col-sm-2 col-form-label">quantity</label>
                            <div class="col-sm-10">
                                <input type="text" name="quantity" id="quantity" placeholder="1" class="form-control" tabindex="1">
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row"><label class="col-sm-2 col-form-label">price</label>
                            <div class="col-sm-10">
                                <input type="text" name="price" id="price" placeholder="00,0" class="form-control" tabindex="1">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row"><label class="col-sm-2 col-form-label">total_price</label>
                            <div class="col-sm-10">
                                <input type="text" name="total_price" id="total_price" placeholder="00,0" class="form-control" tabindex="1">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <input type="hidden" name="ledger_entry_id" value="{{$ledgerEntry->id}}">

          
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
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
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
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

</script>
@endsection