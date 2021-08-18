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
        $fixedCosts      = FixedCost::where('status', true)->orderBy('entry_date', 'asc')->paginate(100);
        $ledgerGroups    = \App\LedgerGroup::whereColumn('id', 'ledger_group_id')->orderBy('title', 'asc')->get();
        $transitionTypes = DB::table('transition_types')->get();

        return view('fixedCost.index',  [
            'fixedCosts' => $fixedCosts,
            'ledgerGroups' => $ledgerGroups,
            'transitionTypes' => $transitionTypes,
            'filtro' => NULL,
            ]
        );
    }

    public function trash()
    {
        $fixedCosts      = FixedCost::where('status', false)->orderBy('entry_date', 'asc')->paginate(100);
        $ledgerGroups    = \App\LedgerGroup::whereColumn('id', 'ledger_group_id')->orderBy('title', 'asc')->get();
        $transitionTypes = DB::table('transition_types')->get();

        return view('fixedCost.trash',  ['fixedCosts' => $fixedCosts, 'ledgerGroups' => $ledgerGroups, 'transitionTypes' => $transitionTypes]);
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
        $fixedCost = new FixedCost();
        $fixedCost->user_id            = Auth::id();
        $fixedCost->ledger_group_id    = $request->ledger_group_id;
        $fixedCost->transition_type_id = $request->transition_type_id;
        $fixedCost->description        = $request->description;
        $fixedCost->entry_date         = $request->entry_date;
        $fixedCost->amount             = $request->amount;
        $fixedCost->recurrent          = $request->recurrent == 'true' ? true : false;
        $fixedCost->notify             = $request->notify    == 'true' ? true : false;
        $fixedCost->save();

        return redirect()->route('fixedCosts.index');
    }

    public function search(Request $request)
    {
        $filtro = NULL;
        if(array_key_exists('descricao',$_GET))
        {
            $filtro     = $request->descricao;
            $fixedCosts = FixedCost::where('description', 'like', '%' .$filtro. '%')
                                    ->where('status', true)->orderBy('created_at', 'desc')->paginate(50);
        }else{
            $fixedCosts = FixedCost::where()->orderBy('entry_date', 'asc')->paginate(100);
        }

        $ledgerGroups    = \App\LedgerGroup::whereColumn('id', 'ledger_group_id')->orderBy('title', 'asc')->get();
        $transitionTypes = DB::table('transition_types')->get();

        return view('fixedCost.index',  [
            'fixedCosts' => $fixedCosts,
            'ledgerGroups' => $ledgerGroups,
            'transitionTypes' => $transitionTypes,
            'filtro' => $filtro,
            ]
        );

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
        $ledgerGroups    = DB::table('ledger_groups')->get();
        $transitionTypes = DB::table('transition_types')->get();

        return view('fixedCost.edit', ['fixedCost' => $fixedCost, 'ledgerGroups' => $ledgerGroups, 'transitionTypes' => $transitionTypes]);

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
        $fixedCost->user_id            = Auth::id();
        $fixedCost->ledger_group_id    = $request->ledger_group_id;
        $fixedCost->transition_type_id = $request->transition_type_id;
        $fixedCost->description        = $request->description;
        $fixedCost->entry_date         = $request->entry_date;
        $fixedCost->amount             = $request->amount;
        $fixedCost->recurrent          = $request->recurrent == 'true' ? true : false;
        $fixedCost->notify             = $request->notify    == 'true' ? true : false;
        $fixedCost->save();

        return redirect()->route('fixedCosts.index');
    }

    /**
     * Get attributes form FixedCost for insert to LedgerEntry
     *
     * @param  \App\FixedCost  $fixedCost
     */
    public function entry(FixedCost $fixedCost)
    {


        $ledgerEntry = new \App\LedgerEntry();
        $ledgerEntry->user_id            = $fixedCost->user_id;
        $ledgerEntry->ledger_group_id    = $fixedCost->ledger_group_id;
        $ledgerEntry->transition_type_id = $fixedCost->transition_type_id;
        $ledgerEntry->description        = $fixedCost->description;
        $ledgerEntry->entry_date         = $fixedCost->entry_date;
        $ledgerEntry->amount             = $fixedCost->amount;

        if($ledgerEntry->save()){

            if($fixedCost->recurrent)
            {
                $date    = str_replace('/', '-', $ledgerEntry->entry_date);
                $newDate = date('d/m/Y', strtotime("$date +1 month"));

                $fixedCost->entry_date = $newDate;
                $fixedCost->save();
            }


        }

        return redirect()->route('ledgerEntries.edit', ['ledgerEntry' => $ledgerEntry->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FixedCost  $fixedCost
     * @return \Illuminate\Http\Response
     */
    public function destroy(FixedCost $fixedCost)
    {
        #$fixedCost->delete();
        $fixedCost->status = false;
        $fixedCost->save();

        return redirect()->route('fixedCosts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FixedCost  $fixedCost
     * @return \Illuminate\Http\Response
     */
    public function recycle(FixedCost $fixedCost)
    {
        $fixedCost->status = true;
        $fixedCost->save();

        return redirect()->route('fixedCosts.trash');
    }

}
