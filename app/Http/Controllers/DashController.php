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
        $expensive = DB::table('ledger_entries')
        ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
        ->select(DB::raw('sum( ledger_entries.amount ) as total'), 'ledger_entries.entry_date as dt_lancamento')
        ->where('transition_types.action', 'expensive')
        ->groupBy('ledger_entries.entry_date')
        ->orderByDesc('ledger_entries.entry_date')
        ->limit(3)
        ->get();

        $recipe = DB::table('ledger_entries')
        ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
        ->select(DB::raw('sum( ledger_entries.amount ) as total'), 'ledger_entries.entry_date as dt_lancamento')
        ->where('transition_types.action', 'recipe')
        ->groupBy('ledger_entries.entry_date')
        ->orderByDesc('ledger_entries.entry_date')
        ->limit(7)
        ->get();

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
        
        return view('dash.index', ['lancamentoTotal' => $lancamentoTotal]);
    }

    public function list()
    {
        die('dashboard');
    }
}
