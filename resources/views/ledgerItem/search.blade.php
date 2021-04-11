@extends('layouts.app')

@section('title', 'Main page')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Itens Lançados</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                                <div class="col-sm-3">
                                    <form action="{{route('ledgerItems.search')}}" method="GET" class="span3" style="margin: 0;padding:0;">
                                        <div class="input-group">
                                            <input placeholder="Search" type="text" name="filtro" value="{{$filtro}}" class="form-control form-control-sm">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-sm btn-primary">Go!</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover table-nomargin">
                                    <thead>
                                        <tr>
                                            <th>Descriçãp</th>
                                            <th>Preço</th>
                                            <th>Quantidade</th>
                                            <th>Valor Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ledgerItems as $value)
                                            <tr>
                                                <td>{{$value->description}}</td>
                                                <td>{{$value->price}}</td>
                                                <td>{{$value->quantity}}</td>
                                                <td>{{$value->total_price}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $ledgerItems->links('dashboard.pagination') }}

                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
