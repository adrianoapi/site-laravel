<?php

namespace App\Http\Controllers;

use App\TransitionType;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTransitionTypeRequest;

class TransitionTypeController extends Controller
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
        $transitionTypes = TransitionType::paginate(10);
        return view('transitionType.index', ['transitionTypes' => $transitionTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transitionType.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransitionTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransitionTypeRequest $request)
    {
        $transitionType = new TransitionType();
        $transitionType->title       = $request->title;
        $transitionType->description = $request->description;
        $transitionType->action      = $request->action;
        $transitionType->credit_card = $request->credit_card == 'true' ? true : false;
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
        return view('transitionType.view', ['transitionType' => $transitionType]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TransitionType  $transitionType
     * @return \Illuminate\Http\Response
     */
    public function edit(TransitionType $transitionType)
    {
        return view('transitionType.edit', ['transitionType' => $transitionType]);
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
        $transitionType->credit_card = $request->credit_card == 'true' ? true : false;
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
