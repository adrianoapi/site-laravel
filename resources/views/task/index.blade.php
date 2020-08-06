@extends('layouts.app')

@section('title', 'Main page')

@section('content')

    <div class="wrapper wrapper-content  animated fadeInRight">

        <div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <form name="addAjax" method="post" id="addTask" action="{{route('tasks.addAjax')}}">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h6 class="modal-title">Cadastrar tarefa</h6>
                    </div>
                    <div class="modal-body">

                        <div class="ibox-content">

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Título</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control"  tabindex="1">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Grupo</label>
                                <div class="col-sm-10">
                                    <select name="task_group_id" data-placeholder="Choose a Country..." class="chosen-select"  tabindex="2">
                                        @foreach ($taskGroup as $value)
                                            <option value="{{$value->id}}">{{$value->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Descrição</label>
                                <div class="col-sm-10">
                                    <textarea id="content" name="content"></textarea>
                                </div>
                            </div>
                                
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="ibox">
                    <div class="ibox-content">
                        <h3>To-do</h3>
                        <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p>

                        <div class="input-group">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-white" data-toggle="modal" data-target="#myModal5"> <i class="fa fa-plus"></i> Add task</button>
                             </span>
                        </div>

                        <ul class="sortable-list connectList agile-list" id="todo">
                            @foreach ($tasks as $value)
                                @if($value->status == "todo")
                                <li class="warning-element" id="{{$value->id}}">
                                    {!! html_entity_decode($value->content) !!}
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">{{$value->taskGroup->title}}</a>
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
                                    {!! html_entity_decode($value->content) !!}
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
                                    {!! html_entity_decode($value->content) !!}
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


    </div>
        
@endsection

@section('scripts')
<script>
        $('.chosen-select').chosen({width: "100%"});


        $(document).ready(function(){

            $('#content').summernote();

            $("#todo, #inprogress, #completed").sortable({
                connectWith: ".connectList",
                update: function( event, ui ) {
                    var todo = $( "#todo" ).sortable( "toArray" );
                    var inprogress = $( "#inprogress" ).sortable( "toArray" );
                    var completed = $( "#completed" ).sortable( "toArray" );
                    //$('.output').html("ToDo: " + window.JSON.stringify(todo) + "<br/>" + "In Progress: " + window.JSON.stringify(inprogress) + "<br/>" + "Completed: " + window.JSON.stringify(completed));
               
                    var token = $("[name='_token']").val();
                    var attributes = {
                        '_token'    : token,
                        'todo'      : todo,
                        'inprogress': inprogress,
                        'completed' : completed
                    };
                    
                    $.ajax({
                        url: "{{route('tasks.ajax')}}",
                        type: "POST",
                        data: attributes,
                        dataType: 'json',
                        success: function(data){
                            console.log(data);
                        }
                    });
                    

                }
            }).disableSelection();


            $("#addTask").submit(function(event) {
                event.preventDefault();

                var attributes = $("#addTask").serialize();

                $.ajax({
                    url:  $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $("#addTask").serialize(),
                    dataType: 'json',
                    success: function(data){
                        console.log(data);
                    }
                });

            });
            
           
        });

    </script>
    @endsection