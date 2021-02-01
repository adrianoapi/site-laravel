@extends('layouts.app')

@section('title', 'Main page')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Lançamentos</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6 m-b-xs">
                                <a href="{{route('collItems.create', ['collection' => $collection->id])}}" class="btn btn-default"><i class="icon-edit"></i> Novo Item</a>
                                <a href="{{route('collItems.show',   ['collection'  => $collection->id])}}" class="btn btn-info"><i class="icon-shopping-cart"></i> Itens</a>
                                <a href="{{route('collections.show', ['collection'   => $collection->id])}}" class="btn btn-default"><i class="icon-reorder"></i> Coleção</a>
                            </div>
                            <div class="col-sm-6">

                            </div>
                        </div>

                        <div class="table-responsive">

                            <div class="box-content nopadding">
                                <table class="table table-hover table-nomargin">
                                    <thead>
                                        <tr>
                                            <th class="span2">Título</th>
                                            <th class="span2">Exame</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$collection->title}}</td>
                                            <td>{{$collection->description}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-content nopadding">
                                <table class="table table-hover table-nomargin">
                                    <thead>
                                        <tr>
                                            <th class="span4">Descrição</th>
                                            <th class="span4">Lançamento</th>
                                            <th class="span2">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($collection->items as $value)
                                        <tr>
                                            <td>{{$value->title}}</td>
                                            <td>{{$value->release}}</td>
                                            <td>
                                                <form action="{{route('collItems.destroy', ['collItem' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                                    @csrf
                                                    @method('delete')

                                                    <a href="{{route('collItemImages.create', ['collItem'  => $value->id])}}" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Imagem"><i class="fa fa-image"></i></a>
                                                    <a href="{{route('collItems.edit',        ['collItem'  => $value->id])}}" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Editar"><i class="fa fa-edit"></i></a>
                                                    <button type="submit" class="btn btn-white btn-sm" rel="tooltip" title="" data-original-title="Excluir"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
