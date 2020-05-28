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

        return view('addLedgerItem', ['ledgerEntry' => $ledgerEntry]);
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
     * @param  \App\LedgerItem  $ledgerItem
     * @return \Illuminate\Http\Response
     */
    public function show(LedgerItem $ledgerItem)
    {
        //
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
        //
    }
}
