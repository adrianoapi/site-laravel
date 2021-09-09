@extends('layouts.app')

@section('title', 'Lançamentos grupo: Editar')

@section('content')

<div class="wrapper wrapper-content  animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Lançamentos grupo: Editar</h5>
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
                    <form action="{{route('ledgerGroups.update', ['ledgerGroup' => $ledgerGroup->id])}}" method="POST" class="form-horizontal form-bordered">
                        @csrf
                        @method('PUT')
                        <div class="form-group row {{$errors->has('title') ? 'error' : ''}}"><label class="col-sm-2 col-form-label">Título</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" id="title" value="{{$ledgerGroup->title}}" class="form-control" tabindex="1">
                                @if ($errors->has('title'))
                                    <span class="help-inline">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Level</label>
                            <div class="col-sm-10">
                                <select name="ledger_group_id" id="ledger_group_id" data-placeholder="Choose a level..." class="chosen-select"  tabindex="2">
                                    <option value="">Select...</option>
                                    @foreach ($parents as $value)
                                        <option value="{{$value->id}}" {{$value->id == $ledgerGroup->ledger_group_id ? 'selected' : ''}}>{{$value->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group row"><label class="col-sm-2 col-form-label">Descrição</label>
                            <div class="col-sm-10">
                                <textarea id="content" name="description">{{$ledgerGroup->description}}</textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{route('ledgerGroups.index')}}" class="btn btn-white btn-sm">Cancelar</a>
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
