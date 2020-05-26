<?php

namespace App\Http\Controllers;

use App\TaskGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaskGroupController extends Controller
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
        $taskGroup = DB::table('task_groups')->paginate(10);
        return view('listAllTaskGroup', ['taskGroups' => $taskGroup]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addTaskGroup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new TaskGroup();
        $model->title = $request->title;
        $model->content = $request->content;
        $model->user_id  = Auth::id();
        $model->save();

        return \redirect()->route('taskGroups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TaskGroup  $taskGroup
     * @return \Illuminate\Http\Response
     */
    public function show(TaskGroup $taskGroup)
    {
        return view('listTaskGroup', ['taskGroup' => $taskGroup]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TaskGroup  $taskGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskGroup $taskGroup)
    {
        return view('editTaskGroup', ['taskGroup' => $taskGroup]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaskGroup  $taskGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskGroup $taskGroup)
    {
        $taskGroup->title   = $request->title;
        $taskGroup->content = $request->content;
        $taskGroup->save();

        return redirect()->route('taskGroups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaskGroup  $taskGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskGroup $taskGroup)
    {
        $taskGroup->delete();
        return \redirect()->route('taskGroups.index');
    }
}
