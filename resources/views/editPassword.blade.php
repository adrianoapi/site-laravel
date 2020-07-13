@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    <div class="box box-bordered">
        <div class="box-title">
            <h3><i class="icon-plus-sign"></i> Editar</h3>

            <ul class="tabs actions">
                <li>
                    <a href="{{route('passwords.index')}}" data-toggle="modal" class="btn"><i class="icon-reorder"></i> Senhas</a>
                </li>
            </ul>

        </div>
        <div class="box-content nopadding">
            <form action="{{route('passwords.edit', ['password' => $password->id])}}" method="POST" class="form-horizontal form-bordered">
                @csrf
                @method('PUT')
                <div class="control-group">
                    <label for="title" class="control-label">Title</label>
                    <div class="controls">
                        <input type="text" name="title" id="title" value="{{$password->title}}" placeholder="Text input" class="input-xlarge">
                    </div>
                </div>
                <div class="control-group">
                    <label for="login" class="control-label">login</label>
                    <div class="controls">
                        <input type="text" name="login" id="login" value="{{$password->login}}" placeholder="Text input" class="input-xlarge">
                    </div>
                </div>
                <div class="control-group">
                    <label for="pass" class="control-label">pass</label>
                    <div class="controls">
                        <input type="text" name="pass" id="pass" value="{{$password->pass}}" placeholder="Text input" class="input-xlarge">
                    </div>
                </div>
                <div class="control-group">
                    <label for="url" class="control-label">url</label>
                    <div class="controls">
                        <input type="text" name="url" id="url" value="{{$password->url}}" placeholder="Text input" class="input-xlarge">
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{route('passwords.index')}}" class="btn">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection