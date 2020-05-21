@extends('dashboard.master.layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="pull-left">
            <h1>Favortio Item</h1>
        </div>
        <div class="pull-right">
            <div class="btn-toolbar">
                <a href="{{route('links.create')}}" class="btn btn-primary"><i class="icon-plus" title="Adicionar"></i> Adicionar</a>
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
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($links as $link)
                        <tr>
                            <td>{{$link->id}}</td>
                            <td>{{$link->title}}</td>
                            <td>
                                <form action="{{route('links.destroy', ['link' => $link->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('links.list', ['link' => $link->id])}}" class="btn" rel="tooltip" title="" data-original-title="Visualizar"><i class="icon-file-alt"></i></a>
                                    <a href="{{route('links.formEditLink', ['link' => $link->id])}}" class="btn" rel="tooltip" title="" data-original-title="Editar"><i class="icon-edit"></i></a>
                                    <input type="hidden" name="link" value="{{$link->id}}">
                                    <button type="submit" class="btn" rel="tooltip" title="" data-original-title="Excluir"><i class="icon-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $links->fragment('foo')->links() }}
            <style>li {display: inline;}</style>
            <div class="table-pagination">
                <a href="#" class="disabled">First</a>
                <a href="#" class="disabled">Previous</a>
                <span>
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                </span>
                <a href="#">Next</a>
                <a href="#">Last</a>
            </div>
        </div>
    </div>
</div>
    
@endsection