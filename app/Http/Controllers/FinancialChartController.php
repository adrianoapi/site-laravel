<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinancialChartController extends Controller
{
    private $date_begin;
    private $date_end;

    public function __construct()
    {
        $this->middleware('auth');

        $this->date_begin = date('Y-m-d');
        $this->date_begin = date('Y-m-d', strtotime("$this->date_begin -30 days"));
        $this->date_end   = date('Y-m-d');
    }

    public function index()
    {
        $fixedCost = \App\FixedCost::orderBy('entry_date', 'asc')->limit(3)->get();

        return view('financialChart.index', [
            'rank_cost' => $this->rankCost(),
            'monthly'   => [
                'monthlyExpense' =>$this->monthlyExpense(),
                'monthlyExpenseCart' => $this->monthlyExpenseCart(),
                'monthlyRecipe' => $this->monthlyRecipe()
            ],
            'fixedCost' => $fixedCost
            ]);
    }

    /**
     * Rank de Despesas
     */
    public function rankCost()
    {
        return DB::table('ledger_entries')
        ->select('ledger_entries.*')
        ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
        ->where([
            ['transition_types.action', '=', 'expensive'],
            ['ledger_entries.entry_date', '>=', $this->date_begin],
            ['ledger_entries.entry_date', '<=', $this->date_end]
        ])
        ->orderByDesc('ledger_entries.amount', 'desc')
        ->limit(10)
        ->get();
    }

    /**
     * Movimentacao mensal sem cartao de creito
     */
    public function monthlyExpense()
    {
        return DB::table('ledger_entries')
        ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
        ->select(DB::raw('sum( ledger_entries.amount ) as total'))
        ->where([
            ['transition_types.action', '=', 'expensive'],
            ['transition_types.credit_card', '<>', true],
            ['ledger_entries.entry_date', '>=', $this->date_begin],
            ['ledger_entries.entry_date', '<=', $this->date_end]
        ])
        ->orderByDesc('ledger_entries.entry_date')
        ->get();
    }

    /**
     * Movimentacao mensal com cartao de credito
     */
    public function monthlyExpenseCart()
    {
        return DB::table('ledger_entries')
        ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
        ->select(DB::raw('sum( ledger_entries.amount ) as total'))
        ->where([
            ['transition_types.action', '=', 'expensive'],
            ['transition_types.credit_card', '=', true],
            ['ledger_entries.entry_date', '>=', $this->date_begin],
            ['ledger_entries.entry_date', '<=', $this->date_end]
        ])
        ->orderByDesc('ledger_entries.entry_date')
        ->get();
    }

    /**
     * Receita mensal
     */
    public function monthlyRecipe()
    {
        return DB::table('ledger_entries')
        ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
        ->select(DB::raw('sum( ledger_entries.amount ) as total'))
        ->where([
            ['transition_types.action', '=', 'recipe'],
            ['ledger_entries.entry_date', '>=', $this->date_begin],
            ['ledger_entries.entry_date', '<=', $this->date_end]
        ])
        ->orderByDesc('ledger_entries.entry_date')
        ->get();
    }

    public function fixedCoastAjax()
    {
        $fixedCost = \App\FixedCost::orderBy('entry_date', 'asc')->limit(5)->get();

        return response()->json([
            'body' => view('financialChart.fixedCost', ['fixedCost' => $fixedCost])->render()
        ]);
    }

}
