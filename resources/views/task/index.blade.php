@extends('layouts.app')

@section('title', 'Main page')

@section('content')

    <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h3>To-do</h3>
                            <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p>

                            <div class="input-group">
                                <input type="text" placeholder="Add new task. " class="input form-control-sm form-control">
                                <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-white"> <i class="fa fa-plus"></i> Add task</button>
                                </span>
                            </div>

                            <ul class="sortable-list connectList agile-list" id="todo">
                                @foreach ($tasks as $value)
                                    @if($value->status == "todo")
                                    <li class="warning-element" id="{{$value->id}}">
                                        {{$value->content}}
                                        <div class="agile-detail">
                                            <a href="#" class="float-right btn btn-xs btn-white">Tag</a>
                                            <i class="fa fa-clock-o"></i> 12.10.2015
                                        </div>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h3>In Progress</h3>
                            <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p>
                            <ul class="sortable-list connectList agile-list" id="inprogress">
                                @foreach ($tasks as $value)
                                    @if($value->status == "inprogress")
                                    <li class="warning-element" id="{{$value->id}}">
                                        {{$value->content}}
                                        <div class="agile-detail">
                                            <a href="#" class="float-right btn btn-xs btn-white">Tag</a>
                                            <i class="fa fa-clock-o"></i> 12.10.2015
                                        </div>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h3>Completed</h3>
                            <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p>
                            <ul class="sortable-list connectList agile-list" id="completed">
                                @foreach ($tasks as $value)
                                    @if($value->status == "completed")
                                    <li class="warning-element" id="{{$value->id}}">
                                        {{$value->content}}
                                        <div class="agile-detail">
                                            <a href="#" class="float-right btn btn-xs btn-white">Tag</a>
                                            <i class="fa fa-clock-o"></i> 12.10.2015
                                        </div>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">

                    <h4>
                        Serialised Output
                    </h4>
                    <p>
                        Serializes the sortable's item id's into an array of string.
                    </p>

                    <div class="output p-m m white-bg"></div>


                </div>
            </div>


        </div>

        @csrf
        

@endsection