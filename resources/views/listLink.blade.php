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
            <h3><i class="icon-th-list"></i> Visualizar</h3>
        </div>
        <div class="box-content nopadding">
            <form action="" method="POST" class="form-horizontal form-bordered">
                <div class="control-group">
                    <label for="title" class="control-label">Title</label>
                    <div class="controls">
                        <input type="text" name="title" id="title" value="{{$link->title}}" placeholder="Text input" class="input-xlarge" readonly="true">
                    </div>
                </div>
                <div class="control-group">
                    <label for="link_id" class="control-label">Basic</label>
                    <div class="controls">
                        <select name="link_id" id="link_id" class="select2-me input-xlarge" readonly="true">
                            @foreach ($parent as $parentLink)
                
                                @if($parentLink->id == $link->link_id)         
                                    <option value="{{$parentLink->id}}" selected>{{$parentLink->title}}</option>
                                @else
                                    <option value="{{$parentLink->id}}">{{$parentLink->title}}</option>      
                                @endif
                                
                            @endforeach
                        </select>
                    </div>
                </div>

                <table class="table table-bordered table-hover">
                    @foreach($linksItems as $link)
                    <tr>
                        <td><li><a href="{{$link->url}}" target="_blank">{{$link->title}}</a></li></td>
                    </tr>
                    @endforeach
                </table>

                <div class="form-actions">
                    <p>{{date('d/m/Y H:i', strtotime($link->created_at))}}</p>
                </div>
                
            </form>
        </div>
    </div>
</div>
    
@endsection