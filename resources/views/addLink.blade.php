@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="pull-left">
            <h1>Favortio Item</h1>
        </div>
        <div class="pull-right">
            <div class="btn-toolbar">
                <a href="{{route('links.listAll')}}" class="btn btn-primary"><i class="icon-reorder" title="Listagem"></i> Listagem</a>
            </div> 
        </div> 
    </div>
    <div class="box box-bordered box-color">
        <div class="box-title">
            <h3><i class="icon-th-list"></i> Adicionar</h3>
        </div>
        <div class="box-content nopadding">
            <form action="{{route('links.store')}}" method="POST" class="form-horizontal form-bordered">
                @csrf
                <div class="control-group">
                    <label for="title" class="control-label">Title</label>
                    <div class="controls">
                        <input type="text" name="title" id="title" placeholder="Text input" class="input-xlarge">
                    </div>
                </div>
                <div class="control-group">
                    <label for="link_id" class="control-label">Basic</label>
                    <div class="controls">
                        <select name="link_id" id="link_id" class="select2-me input-xlarge">
                            @foreach ($parent as $parentLink)

                                <option value="{{$parentLink->id}}">{{$parentLink->title}}</option>

                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{route('links.listAll')}}" class="btn">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection
