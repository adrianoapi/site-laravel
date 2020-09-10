<?php

namespace App\Http\Controllers;

use App\LedgerItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LedgerItemController extends Controller
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
    public function create(\App\LedgerEntry $ledgerEntry)
    {
        if($ledgerEntry->user_id != Auth::id()){
            die('erro');
        }

        $ledgerItems = LedgerItem::where('ledger_entry_id', $ledgerEntry->id)->orderBy('id', 'desc')->get();
        
        return view('ledgerItem.add', ['ledgerItems' => $ledgerItems, 'ledgerEntry' => $ledgerEntry, 'ledgerItem' => '']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ledgerEntry = \App\LedgerEntry::where('id', $request->ledger_entry_id)->first();
        if($ledgerEntry->user_id != Auth::id()){
            die('erro');
        }

        $ledgerItem = new LedgerItem();
        $ledgerItem->ledger_entry_id = $request->ledger_entry_id;
        $ledgerItem->description = $request->description;
        $ledgerItem->quantity = $request->quantity;
        $ledgerItem->price = $request->price;
        $ledgerItem->total_price = $request->total_price;
        $ledgerItem->save();

        $ledgerItems = LedgerItem::where('ledger_entry_id', $ledgerEntry->id)->orderBy('id', 'desc')->get();

        return view('ledgerItem.add', ['ledgerItems' => $ledgerItems, 'ledgerEntry' => $ledgerEntry, 'ledgerItem' => $ledgerItem]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LedgerEntry  $ledgerEntry
     * @return \Illuminate\Http\Response
     */
    public function show(\App\LedgerEntry $ledgerEntry)
    {
        if($ledgerEntry->user_id != Auth::id()){
            die('erro');
        }

        $ledgerItems = LedgerItem::where('ledger_entry_id', $ledgerEntry->id)->orderBy('id', 'desc')->get();
        
        return view('ledgerItem.show', ['ledgerItems' => $ledgerItems, 'ledgerEntry' => $ledgerEntry]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LedgerItem  $ledgerItem
     * @return \Illuminate\Http\Response
     */
    public function edit(LedgerItem $ledgerItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LedgerItem  $ledgerItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LedgerItem $ledgerItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LedgerItem  $ledgerItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(LedgerItem $ledgerItem)
    {
        $ledgerEntry = \App\LedgerEntry::where('id', $ledgerItem->ledger_entry_id)->first();
        if($ledgerEntry->user_id != Auth::id()){
            die('erro');
        }

        $ledgerItem->delete();

        return redirect()->route('ledgerItems.show', ['ledgerEntry' => $ledgerEntry]);
    }
}
