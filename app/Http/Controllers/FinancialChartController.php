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
        $rank_cost = DB::table('ledger_entries')
        ->select('ledger_entries.*')
        ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
        ->where([
            ['transition_types.action', '=', 'expensive'],
            ['ledger_entries.entry_date', '>=', $this->date_begin],
            ['ledger_entries.entry_date', '<=', $this->date_end]
        ])
        ->orderByDesc('ledger_entries.amount', 'desc')
        ->limit(3)
        ->get();

        $monthlyExpense = DB::table('ledger_entries')
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
        
        $monthlyExpenseCart = DB::table('ledger_entries')
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

        $monthlyRecipe = DB::table('ledger_entries')
        ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
        ->select(DB::raw('sum( ledger_entries.amount ) as total'))
        ->where([
            ['transition_types.action', '=', 'recipe'],
            ['ledger_entries.entry_date', '>=', $this->date_begin],
            ['ledger_entries.entry_date', '<=', $this->date_end]
        ])
        ->orderByDesc('ledger_entries.entry_date')
        ->get();

        return view('financialChart.index', [
            'rank_cost' => $rank_cost,
            'monthly'   => ['monthlyExpense' => $monthlyExpense, 'monthlyExpenseCart' => $monthlyExpenseCart, 'monthlyRecipe' => $monthlyRecipe]
            ]);
    }

}
