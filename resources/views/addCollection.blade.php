@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    <div class="box box-bordered">
        <div class="box-title">
            <h3><i class="icon-plus-sign"></i> Adicionar</h3>

            <ul class="tabs actions">
                <li>
                    <a href="{{route('collections.index')}}" data-toggle="modal" class="btn"><i class="icon-reorder"></i> Exames</a>
                </li>
            </ul>

        </div>
        <div class="box-content nopadding">
            <form action="{{route('collections.store')}}" method="POST" class="form-horizontal form-bordered">
                @csrf
                <div class="control-group">
                    <label for="title" class="control-label">Title</label>
                    <div class="controls">
                        <input type="text" name="title" id="title" placeholder="Text input" class="input-xlarge">
                    </div>
                </div>
                <div class="control-group">
                    <label for="show_id" class="control-label">show_id</label>
                    <div class="controls">
                        <div class="check-demo-col">
                            <div class="check-line">
                                <input type="checkbox" id="show_id" name="show_id" value="true" class='icheck-me' data-skin="square" data-color="blue">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label for="show_image" class="control-label">show_image</label>
                    <div class="controls">
                        <div class="check-demo-col">
                            <div class="check-line">
                                <input type="checkbox" id="show_image" name="show_image" value="true" class='icheck-me' data-skin="square" data-color="blue">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label for="show_title" class="control-label">show_title</label>
                    <div class="controls">
                        <div class="check-demo-col">
                            <div class="check-line">
                                <input type="checkbox" id="show_title" name="show_title" value="true" class='icheck-me' data-skin="square" data-color="blue">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label for="show_description" class="control-label">show_description</label>
                    <div class="controls">
                        <div class="check-demo-col">
                            <div class="check-line">
                                <input type="checkbox" id="show_description" name="show_description" value="true" class='icheck-me' data-skin="square" data-color="blue">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label for="show_release" class="control-label">show_release</label>
                    <div class="controls">
                        <div class="check-demo-col">
                            <div class="check-line">
                                <input type="checkbox" id="show_release" name="show_release" value="true" class='icheck-me' data-skin="square" data-color="blue">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label for="description" class="control-label">Conteúdo</label>
                    <div class="controls">
                        <textarea name="description" id="description" rows="5" class="input-block-level"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label for="description" class="control-label">Conteúdo</label>
                    <div class="controls">
                        <select name="order" id="order" class="select2-me input-xlarge">
                            @foreach ($order as $value)
                                <option value="{{$value}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{route('collections.index')}}" class="btn">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection