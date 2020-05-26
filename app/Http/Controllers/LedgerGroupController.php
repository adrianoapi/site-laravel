<?php

namespace App\Http\Controllers;

use App\LedgerGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LedgerGroupController extends Controller
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
        $ledgerGroups = LedgerGroup::paginate(10);
        return view('listAllLedgerGroup', ['ledgerGroups' => $ledgerGroups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = DB::table('ledger_groups')->get();
        return view('addLedgerGroup', ['parents' => $parents]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ledgerGroup                   = new LedgerGroup();
        $ledgerGroup->title            = $request->title;
        $ledgerGroup->description      = $request->description;
        $ledgerGroup->ledger_group_id = $request->ledger_group_id;
        $ledgerGroup->save();

        if($request->ledger_group_id < 1){
            $ledgerGroup->ledger_group_id = $ledgerGroup->id;
            $ledgerGroup->save();
        }

        return redirect()->route('ledgerGroups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LedgerGroup  $ledgerGroup
     * @return \Illuminate\Http\Response
     */
    public function show(LedgerGroup $ledgerGroup)
    {
        $parents = DB::table('ledger_groups')->get();
        return view('listLedgerGroup', ['ledgerGroup' => $ledgerGroup, 'parents' => $parents]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LedgerGroup  $ledgerGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(LedgerGroup $ledgerGroup)
    {
        $parents = DB::table('ledger_groups')->get();
        return view('editLedgerGroup', ['ledgerGroup' => $ledgerGroup, 'parents' => $parents]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LedgerGroup  $ledgerGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LedgerGroup $ledgerGroup)
    {
        $ledgerGroup->title            = $request->title;
        $ledgerGroup->description      = $request->description;
        $ledgerGroup->ledger_group_id = $request->ledger_group_id;
        $ledgerGroup->save();

        if($request->ledger_group_id < 1){
            $ledgerGroup->ledger_group_id = $ledgerGroup->id;
            $ledgerGroup->save();
        }

        return redirect()->route('ledgerGroups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LedgerGroup  $ledgerGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(LedgerGroup $ledgerGroup)
    {
        $ledgerGroup->delete();
        return redirect()->route('ledgerGroups.index');
    }
}
