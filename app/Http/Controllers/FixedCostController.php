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
        $fixedCosts      = FixedCost::orderBy('entry_date', 'desc')->paginate(50);
        $ledgerGroups    = \App\LedgerGroup::whereColumn('id', 'ledger_group_id')->orderBy('title', 'asc')->get();
        $transitionTypes = DB::table('transition_types')->get();

        return view('fixedCost.index',  ['fixedCosts' => $fixedCosts, 'ledgerGroups' => $ledgerGroups, 'transitionTypes' => $transitionTypes]);
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
        $ledgerEntry = new FixedCost();
        $ledgerEntry->user_id            = Auth::id();
        $ledgerEntry->ledger_group_id    = $request->ledger_group_id;
        $ledgerEntry->transition_type_id = $request->transition_type_id;
        $ledgerEntry->description        = $request->description;
        $ledgerEntry->entry_date         = $request->entry_date;
        $ledgerEntry->amount             = $request->amount;
        $ledgerEntry->recurrent          = $request->recurrent == 'true' ? true : false;
        $ledgerEntry->notify             = $request->notify    == 'true' ? true : false;
        $ledgerEntry->save();

        return redirect()->route('fixedCosts.index');
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
