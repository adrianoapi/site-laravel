<?php

namespace App\Http\Controllers;

use App\GroupTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GroupTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupTask = DB::table('group_tasks')->paginate(10);
        return view('listAllGroupTask', ['groupTasks' => $groupTask]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addGroupTask');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new GroupTask();
        $model->title = $request->title;
        $model->content = $request->content;
        $model->user_id  = Auth::id();
        $model->save();

        return \redirect()->route('groupTasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GroupTask  $groupTask
     * @return \Illuminate\Http\Response
     */
    public function show(GroupTask $groupTask)
    {
        return view('listGroupTask', ['groupTask' => $groupTask]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GroupTask  $groupTask
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupTask $groupTask)
    {
        return view('editGroupTask', ['groupTask' => $groupTask]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroupTask  $groupTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupTask $groupTask)
    {
        $groupTask->title   = $request->title;
        $groupTask->content = $request->content;
        $groupTask->save();

        return redirect()->route('groupTasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroupTask  $groupTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupTask $groupTask)
    {
        $groupTask->delete();
        return \redirect()->route('groupTasks.index');
    }
}
