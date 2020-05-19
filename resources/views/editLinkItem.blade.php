@extends('dashboard.master.layout')

@section('content')

<div class="span12">
    <div class="box box-bordered box-color">
        <div class="box-title">
            <h3><i class="icon-th-list"></i> Colored</h3>
        </div>
        <div class="box-content nopadding">
            <form action="{{route('linksItems.edit', ['linkItem' => $linkItem->id])}}" method="POST" class="form-horizontal form-bordered">
                @csrf
                @method('PUT')
                <div class="control-group">
                    <label for="textfield" class="control-label">Title</label>
                    <div class="controls">
                        <input type="text" name="title" value="{{$linkItem->title}}" placeholder="Text input" class="input-xlarge">
                    </div>
                </div>
                <div class="control-group">
                    <label for="password" class="control-label">URL</label>
                    <div class="controls">
                        <input type="text" name="url" value="{{$linkItem->url}}" placeholder="Password input" class="input-xlarge">
                    </div>
                </div>
                <div class="control-group">
                    <label for="textfield" class="control-label">Basic</label>
                    <div class="controls">
                        <select name="link_id" id="link_id" class="select2-me input-xlarge">
                            @foreach ($parent as $parentLink)
                
                                @if($parentLink->id == $linkItem->link_id)         
                                    <option value="{{$parentLink->id}}" selected>{{$parentLink->title}}</option>
                                @else
                                    <option value="{{$parentLink->id}}">{{$parentLink->title}}</option>      
                                @endif
                                
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <a href="{{route('linksItems.listAll')}}" class="btn">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
    
    @endsection