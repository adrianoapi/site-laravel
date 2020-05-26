<?php

namespace App\Http\Controllers;

use App\LedgerEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LedgerEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(array_key_exists('filtro',$_GET)){
            if($_GET['filtro'] == 'despesa'){

                $ledgerGroups = \App\LedgerGroup::where('ledger_group_id', $_GET['id'])->get();
                $ids = [];
                foreach($ledgerGroups as $value):
                    array_push($ids, $value->id);
                endforeach;

                $ledgerEntries = LedgerEntry::whereIn('ledger_group_id', $ids)->orderBy('entry_date', 'desc')->paginate(100);
            }else{
                $ledgerEntries = LedgerEntry::where('transition_type_id', $_GET['id'])->orderBy('entry_date', 'desc')->paginate(100);
            }
        }else{
            $ledgerEntries = LedgerEntry::orderBy('entry_date', 'desc')->paginate(100);
        }

        $ledgerGroups    = \App\LedgerGroup::whereColumn('id', 'ledger_group_id')->orderBy('title', 'asc')->get();
        $transitionTypes = DB::table('transition_types')->get();

        return view('listAllLedgerEntry', ['ledgerEntries' => $ledgerEntries, 'ledgerGroups' => $ledgerGroups, 'transitionTypes' => $transitionTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ledgerGroups    = DB::table('ledger_groups')->get();
        $transitionTypes = DB::table('transition_types')->get();

        return view('addLedgerEntry', ['ledgerGroups' => $ledgerGroups, 'transitionTypes' => $transitionTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ledgerEntry = new LedgerEntry();
        $ledgerEntry->user_id            = Auth::id();
        $ledgerEntry->ledger_group_id    = $request->ledger_group_id;
        $ledgerEntry->transition_type_id = $request->transition_type_id;
        $ledgerEntry->description        = $request->description;
        $ledgerEntry->entry_date         = $request->entry_date;
        $ledgerEntry->amount             = $request->amount;
        $ledgerEntry->save();

        return redirect()->route('ledgerEntries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LedgerEntry  $ledgerEntry
     * @return \Illuminate\Http\Response
     */
    public function show(LedgerEntry $ledgerEntry)
    {
        $ledgerGroups    = DB::table('ledger_groups')->get();
        $transitionTypes = DB::table('transition_types')->get();

        return view('listLedgerEntry', ['ledgerEntry' => $ledgerEntry, 'ledgerGroups' => $ledgerGroups, 'transitionTypes' => $transitionTypes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LedgerEntry  $ledgerEntry
     * @return \Illuminate\Http\Response
     */
    public function edit(LedgerEntry $ledgerEntry)
    {
        $ledgerGroups    = DB::table('ledger_groups')->get();
        $transitionTypes = DB::table('transition_types')->get();

        return view('editLedgerEntry', ['ledgerEntry' => $ledgerEntry, 'ledgerGroups' => $ledgerGroups, 'transitionTypes' => $transitionTypes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LedgerEntry  $ledgerEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LedgerEntry $ledgerEntry)
    {
        $ledgerEntry->ledger_group_id    = $request->ledger_group_id;
        $ledgerEntry->transition_type_id = $request->transition_type_id;
        $ledgerEntry->description        = $request->description;
        $ledgerEntry->entry_date         = $request->entry_date;
        $ledgerEntry->amount             = $request->amount;
        $ledgerEntry->save();

        return redirect()->route('ledgerEntries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LedgerEntry  $ledgerEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(LedgerEntry $ledgerEntry)
    {
        $ledgerEntry->delete();
        return redirect()->route('ledgerEntries.index');
    }
}
