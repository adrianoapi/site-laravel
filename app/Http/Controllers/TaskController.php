<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks     = Task::paginate(10);
        $taskGroup = DB::table('task_groups')->get();

        return view('task.index', ['tasks' => $tasks, 'taskGroup' => $taskGroup]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $taskGroup = DB::table('task_groups')->get();
        return view('addTask', ['taskGroup' => $taskGroup]);
    }

    public function addAjax(Request $request)
    {
        $task = new Task();
        $task->task_group_id = $request->task_group_id;
        $task->title         = $request->title;
        $task->content       = $request->content;
        $task->level         = $request->level;
        $task->status        = 'todo';
        
        if($task->save()){
            return response()->json(['status' => true]);
        }else{
            return response()->json(['status' => faslse]);
        }
    }

    public function upAjax(Request $request)
    {
        $data = $request->all();

        if(array_key_exists('todo', $data)){
            $i = 0;
            foreach ($data['todo'] as $key => $value) {
                DB::table('tasks')
                    ->where('id', $value)
                    ->update(['status' => 'todo', 'order' => ++$i]);
            }
        }

        if(array_key_exists('inprogress', $data)){
            $i = 0;
            foreach ($data['inprogress'] as $key => $value) {
                DB::table('tasks')
                    ->where('id', $value)
                    ->update(['status' => 'inprogress', 'order' => ++$i]);
            }
        }

        if(array_key_exists('completed', $data)){
            $i = 0;
            foreach ($data['completed'] as $key => $value) {
                DB::table('tasks')
                    ->where('id', $value)
                    ->update(['status' => 'completed', 'order' => ++$i]);
            }
        }

        exit();
        return response()->json([
            $request->attributes['_token']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task();
        $task->task_group_id = $request->task_group_id;
        $task->title         = $request->title;
        $task->content       = $request->content;
        $task->status        = $request->status;
        $task->save();

        return \redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $taskGroup = DB::table('task_groups')->get();
        return view('listTask', ['task' => $task, 'taskGroup' => $taskGroup]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $taskGroup = DB::table('task_groups')->get();
        return view('editTask', ['task' => $task, 'taskGroup' => $taskGroup]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task->task_group_id = $request->task_group_id;
        $task->title         = $request->title;
        $task->content       = $request->content;
        $task->status        = $request->status;
        $task->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return \redirect()->route('tasks.index');
    }

    public function delAjax(Request $request)
    {
        $task =Task::findOrFail($request->id);
        if($task->delete()){
            return response()->json(['status' => true]);
        }else{
            return response()->json(['status' => faslse]);
        }
    }
}
