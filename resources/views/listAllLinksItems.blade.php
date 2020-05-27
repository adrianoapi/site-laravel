@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="pull-left">
            <h1>Favortio Item</h1>
        </div>
        <div class="pull-right">
            <div class="btn-toolbar">
                <a href="{{route('linksItems.create')}}" class="btn btn-primary"><i class="icon-plus" title="Adicionar"></i> Adicionar</a>
            </div> 
        </div> 
    </div>
    <div class="box box-color box-bordered">
        <div class="box-title">
            <h3>
                <i class="icon-table"></i>
                Listagem
            </h3>
        </div>
        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Categoria</th>
                        <th>Url</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($linksItems as $value)
                    
                        <tr>
                            <td>{{$value->id}}</td>
                            <td><a href="{{$value->url}}" target="_blank" rel="noopener noreferrer">{{$value->title}}</a> <i class="icon-external-link"></i></td>
                            <td>{{$value->link->title}}</td>
                            <td>{{$value->url}}</td>
                            <td>
                                <form action="{{route('linksItems.destroy', ['linkItem' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('linksItems.list', ['linkItem' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Visualizar"><i class="icon-file-alt"></i></a>
                                    <a href="{{route('linksItems.formEditLink', ['linkItem' => $value->id])}}" class="btn" rel="tooltip" title="" data-original-title="Editar"><i class="icon-edit"></i></a>
                                    <input type="hidden" name="link" value="{{$value->id}}">
                                    <button type="submit" class="btn" rel="tooltip" title="" data-original-title="Excluir"><i class="icon-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $linksItems->links('dashboard.pagination') }}
        </div>
    </div>
</div>
    
@endsection