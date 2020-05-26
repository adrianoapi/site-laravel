<?php

namespace App\Http\Controllers;

use App\TransitionType;
use Illuminate\Http\Request;

class TransitionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transitionTypes = TransitionType::paginate(10);
        return view('listAllTransitionType', ['transitionTypes' => $transitionTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addTransitionType');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transitionType = new TransitionType();
        $transitionType->title       = $request->title;
        $transitionType->description = $request->description;
        $transitionType->action      = $request->action;
        $transitionType->save();

        return redirect()->route('transitionTypes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TransitionType  $transitionType
     * @return \Illuminate\Http\Response
     */
    public function show(TransitionType $transitionType)
    {
        return view('listTransitionType', ['transitionType' => $transitionType]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TransitionType  $transitionType
     * @return \Illuminate\Http\Response
     */
    public function edit(TransitionType $transitionType)
    {
        return view('editTransitionType', ['transitionType' => $transitionType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TransitionType  $transitionType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransitionType $transitionType)
    {
        $transitionType->title       = $request->title;
        $transitionType->description = $request->description;
        $transitionType->action      = $request->action;
        $transitionType->save();

        return redirect()->route('transitionTypes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TransitionType  $transitionType
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransitionType $transitionType)
    {
        $transitionType->delete();
        return redirect()->route('transitionTypes.index');
    }
}
