<?php

namespace App\Http\Controllers;

use App\FixedCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FixedCostController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ledgerGroups    = DB::table('ledger_groups'   )->get();
        $transitionTypes = DB::table('transition_types')->get();

        return view('fixedCost.add', ['ledgerGroups' => $ledgerGroups, 'transitionTypes' => $transitionTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FixedCost  $fixedCost
     * @return \Illuminate\Http\Response
     */
    public function show(FixedCost $fixedCost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FixedCost  $fixedCost
     * @return \Illuminate\Http\Response
     */
    public function edit(FixedCost $fixedCost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FixedCost  $fixedCost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FixedCost $fixedCost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FixedCost  $fixedCost
     * @return \Illuminate\Http\Response
     */
    public function destroy(FixedCost $fixedCost)
    {
        //
    }
}
