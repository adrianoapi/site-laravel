<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('dash.index');
    }

    public function ajaxChart()
    {
        $date_begin   = date('Y-m-d');
        $date_begin   = date('Y-m-d', strtotime("$date_begin -30 days"));
        $date_end     = date('Y-m-d');

        $expensive = DB::table('ledger_entries')
        ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
        ->select(DB::raw('sum( ledger_entries.amount ) as total'), 'ledger_entries.entry_date as dt_lancamento')
        ->where([
            ['transition_types.action', 'expensive'],
            ['ledger_entries.entry_date', '>=', $date_begin],
            ['ledger_entries.entry_date', '<=', $date_end]
        ])
        ->groupBy('ledger_entries.entry_date')
        ->orderByDesc('ledger_entries.entry_date')
        #->limit(3)
        ->get();

        $recipe = DB::table('ledger_entries')
        ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
        ->select(DB::raw('sum( ledger_entries.amount ) as total'), 'ledger_entries.entry_date as dt_lancamento')
        ->where([
            ['transition_types.action', 'recipe'],
            ['ledger_entries.entry_date', '>=', $date_begin],
            ['ledger_entries.entry_date', '<=', $date_end]
        ])
        ->groupBy('ledger_entries.entry_date')
        ->orderByDesc('ledger_entries.entry_date')
        #->limit(7)
        ->get();

        $totalExpensive = DB::table('ledger_entries')
        ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
        ->select(DB::raw('sum( ledger_entries.amount ) as total'))
        ->where([
            ['transition_types.action', '=', 'expensive'],
            ['transition_types.credit_card', '<>', true]
        ])
        ->orderByDesc('ledger_entries.entry_date')
        ->get();

        $totalExpensive = DB::table('ledger_entries')
        ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
        ->select(DB::raw('sum( ledger_entries.amount ) as total'), 'ledger_entries.entry_date as dt_lancamento')
        ->where([
            ['transition_types.action', '=', 'expensive'],
            ['transition_types.credit_card', '<>', true],
            ['ledger_entries.entry_date', '>=', $date_begin],
            ['ledger_entries.entry_date', '<=', $date_end]
        ])
        ->orderByDesc('ledger_entries.entry_date')
        ->get();

        $totalExpensiveCart = DB::table('ledger_entries')
        ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
        ->select(DB::raw('sum( ledger_entries.amount ) as total'), 'ledger_entries.entry_date as dt_lancamento')
        ->where([
            ['transition_types.action', '=', 'expensive'],
            ['transition_types.credit_card', '=', true],
            ['ledger_entries.entry_date', '>=', '2020-09-16'],
            ['ledger_entries.entry_date', '<=', $date_end]
        ])
        ->orderByDesc('ledger_entries.entry_date')
        ->get();

        return response()->json([
            'chart'   => view('dash.ajaxChart',   ['lancamentoTotal' => $this->legderSort($expensive, $recipe)])->render(),
            'finance' => view('dash.ajaxFinance', ['lancamentoTotal' => $this->legderSort($totalExpensive, $recipe), 'cart' => $totalExpensiveCart])->render(),
        ]);
    }

    public function ajaxTask()
    {
        $tasks = \App\Task::where('archived', false)->orderBy('title', 'asc')->get();
        return response()->json([
            'body' => view('dash.ajaxTask', ['tasks' => $tasks])->render()
        ]);
    }

    protected function legderSort($expensive, $recipe)
    {
        $dtLancamento    = array();
        $lancamentoTotal = array();
        
        $tempDespesas = array();
        foreach($expensive as $value):
            $tempDespesas[$value->dt_lancamento] = $value->total;
            array_push($dtLancamento, $value->dt_lancamento);
        endforeach;
        
        $tempLucro = array();
        foreach($recipe as $value):
            $tempLucro[$value->dt_lancamento] = $value->total;
            if(!in_array($value->dt_lancamento, $dtLancamento)){
                array_push($dtLancamento, $value->dt_lancamento);
            }
        endforeach;
        
        foreach($dtLancamento as $value):
            if(array_key_exists($value, $tempDespesas)){
                $lancamentoTotal[$value]['despesa'] = $tempDespesas[$value];
            }else{
                $lancamentoTotal[$value]['despesa'] = 0;
            }
            if(array_key_exists($value, $tempLucro)){
                $lancamentoTotal[$value]['lucro'] = $tempLucro[$value];
            }else{
                $lancamentoTotal[$value]['lucro'] = 0;
            }
        endforeach;

        return  $lancamentoTotal;
    }

    public function list()
    {
        die('dashboard');
    }
}
