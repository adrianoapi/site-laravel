<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinancialChartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $rank_cost = DB::table('ledger_entries')
        ->select('ledger_entries.*')
        ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
        ->where([
            ['transition_types.action', '=', 'expensive'],
        ])
        ->orderByDesc('ledger_entries.amount', 'desc')
        ->limit(10)
        ->get();

        return view('financialChart.index', ['rank_cost' => $rank_cost]);
    }

}
