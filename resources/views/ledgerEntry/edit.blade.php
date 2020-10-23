@extends('layouts.app')

@section('title', 'Main page')

@section('content')

<div class="wrapper wrapper-content  animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>All form elements <small>With custom checbox and radion elements.</small></h5>
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
                    <form action="{{route('ledgerEntries.update', ['ledgerEntry' => $ledgerEntry->id])}}" method="POST" class="form-horizontal form-bordered">
                        @csrf
                        @method('PUT')
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Descrição</label>
                            <div class="col-sm-10">
                                <input type="text" name="description" id="description" value="{{$ledgerEntry->description}}" class="form-control" tabindex="1">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Level</label>
                            <div class="col-sm-10">
                                <select name="ledger_group_id" id="ledger_group_id" data-placeholder="Choose a level..." class="chosen-select"  tabindex="2">
                                   <?php
                                    foreach ($ledgerGroups as $value):
                                        $data = explode('||-', $value);
                                        $selected = ($ledgerEntry->ledger_group_id == $data[0]) ? " selected" : NULL;
                                        if (isset($data[1])) {
                                            echo '<option value="'.$data[0].'" '.$selected.'>'. $data[1] .'</option>';
                                        }
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Level</label>
                            <div class="col-sm-10">
                                <select name="transition_type_id" id="transition_type_id" data-placeholder="Choose a level..." class="chosen-select"  tabindex="3">
                                    @foreach ($transitionTypes as $value)
                                        <option value="{{$value->id}}" {{$value->id == $ledgerEntry->transition_type_id ? 'selected':''}}>{{$value->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row" id="data_1">
                            <label class="col-sm-2 col-form-label">Level</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="entry_date" id="entry_date" class="form-control" value="{{$ledgerEntry->entry_date}}" tabindex="4">
                                </div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group row"><label class="col-sm-2 col-form-label">Valor</label>
                            <div class="col-sm-10">
                                <input type="text" name="amount" id="amount" value="{{$ledgerEntry->amount}}" placeholder="0,00" class="form-control" tabindex="5">
                            </div>
                        </div>
                  
                        <div class="hr-line-dashed"></div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group row"><label class="col-sm-2 col-form-label">Parcelas</label>
                            <div class="col-sm-10">
                                <input type="text" name="installments" id="installments" value="{{$ledgerEntry->installments}}" placeholder="0" class="form-control" tabindex="6">
                            </div>
                        </div>
                  
                        <div class="hr-line-dashed"></div>
          
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{route('ledgerEntries.index')}}" class="btn btn-white btn-sm">Cancelar</a>
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