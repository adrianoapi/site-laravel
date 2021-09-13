@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="pull-left">
            <h1>/lancamento-grupo</h1>
        </div>
        <div class="pull-right">
            <div class="btn-toolbar">
                <a href="{{route('ledgerGroups.index')}}" class="btn btn-primary"><i class="icon-reorder" title="Listagem"></i> Listagem</a>
            </div>
        </div>
    </div>
    <div class="box box-bordered box-color">
        <div class="box-title">
            <h3><i class="icon-th-list"></i> Adicionar</h3>
        </div>
        <div class="box-content nopadding">
            <form action="{{route('ledgerGroups.edit', ['ledgerGroup' => $ledgerGroup->id])}}" method="POST" class="form-horizontal form-bordered">
                @csrf
                @method('PUT')
                <div class="control-group {{$errors->has('title') ? 'error' : ''}}">
                    {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('title', $ledgerGroup->title, array('class'=>'input-xlarge')) !!}
                        @if ($errors->has('title'))
                            <span class="help-inline">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                </div>
                <div class="control-group">
                    {!! Form::label('ledger_groups_id', 'Grupo', ['class' => 'control-label']) !!}
                    <div class="controls">
                        {{ Form::select('id', $parents, $ledgerGroup->ledger_group_id, [
                            'id' => 'ledger_groups_id',
                            'class' => 'select2-me input-xlarge'
                            ])
                        }}
                    </div>
                </div>
                <div class="control-group">
                    {!! Form::label('description', 'Conteúdo', ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::textarea('description', $ledgerGroup->description, array('class'=>'input-block-level', 'rows' => 5)) !!}
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{route('ledgerGroups.index')}}" class="btn">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('scripts')

@endsection
