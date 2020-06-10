@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">

    <div class="box box-bordered">
        <div class="box-title">
            <h3><i class="icon-plus-sign"></i> Adicionar</h3>

            <ul class="tabs actions">
                <li>
                    <a href="{{route('collItems.index')}}" data-toggle="modal" class="btn"><i class="icon-reorder"></i> Questões</a>
                </li>
            </ul>

        </div>

        <div class="box-content nopadding">
    
            <form id="file-upload-form" class="form-horizontal form-bordered" action="{{route('collItemImages.store')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                @csrf
                <input id="file-upload" type="file" name="fileUpload" accept="image/*" onchange="readURL(this);">
                <label for="file-upload" id="file-drag">
                    <img id="file-image" src="#" alt="Preview" class="hidden">
                    <div id="start" >
                        <i class="fa fa-download" aria-hidden="true"></i>
                        <div>Select a file or drag here</div>
                        <div id="notimage" class="hidden">Please select an image</div>
                        <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                        <br>
                        <span class="text-danger">{{ $errors->first('fileUpload') }}</span>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </label>
                <input type="hidden" name="collection_item_id" value="{{$collItem->id}}">
            </form>

        </div>

        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin">
                <thead>
                    <tr>
                        <th class="span10">Imagem</th>
                        <th class="span2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collItem->images as $value)
                        <tr>
                            <td><img src="data:{{$value->type}};base64, {{$value->image}}" width="120" alt="" /></td>
                            <td>
                                <form action="{{route('collItemImages.destroy', ['collItemImage' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-inverse"><i class="icon-trash"></i> Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>




@endsection