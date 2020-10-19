<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashController extends Controller
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
        return view('dash.index');
    }

    public function graphPie()
    {
        if($_GET['range'] == "today"){
            $expensive = DB::table('ledger_entries AS le')
            ->join('transition_types AS tt', 'le.transition_type_id', '=', 'tt.id')
            ->join('ledger_groups AS lg', 'le.ledger_group_id', '=', 'lg.id')
            ->join('ledger_groups AS parent', 'lg.ledger_group_id', '=', 'parent.id')
            ->select(DB::raw('sum( le.amount ) as total'), 'parent.title')
            ->where([
                ['tt.action', 'expensive'],
                ['le.entry_date', '>=', $this->date_begin],
                ['le.entry_date', '<=', $this->date_end]
            ])
            ->orderBy('parent.title')
            ->groupBy('parent.id')
            ->get();
        }

        if($_GET['range'] == "monthly"){

            $date_begin = date('Y-m-d', strtotime("$this->date_begin -1 year"));

            $expensive = DB::table('ledger_entries AS le')
            ->join('transition_types AS tt', 'le.transition_type_id', '=', 'tt.id')
            ->join('ledger_groups AS lg', 'le.ledger_group_id', '=', 'lg.id')
            ->join('ledger_groups AS parent', 'lg.ledger_group_id', '=', 'parent.id')
            ->select(DB::raw('sum( le.amount ) as total'), 'parent.title')
            ->where([
                ['tt.action', 'expensive'],
                ['le.entry_date', '>=', $date_begin],
                ['le.entry_date', '<=', $this->date_end]
            ])
            ->orderBy('parent.title')
            ->groupBy('parent.id')
            ->get();
        }

        if($_GET['range'] == "annual"){

            $date_begin = date('Y-m-d', strtotime("$this->date_begin -10 year"));

            $expensive = DB::table('ledger_entries AS le')
            ->join('transition_types AS tt', 'le.transition_type_id', '=', 'tt.id')
            ->join('ledger_groups AS lg', 'le.ledger_group_id', '=', 'lg.id')
            ->join('ledger_groups AS parent', 'lg.ledger_group_id', '=', 'parent.id')
            ->select(DB::raw('sum( le.amount ) as total'), 'parent.title')
            ->where([
                ['tt.action', 'expensive'],
                ['le.entry_date', '>=', $date_begin],
                ['le.entry_date', '<=', $this->date_end]
            ])
            ->orderBy('parent.title')
            ->groupBy('parent.id')
            ->get();
        }

        return response()->json([
            'body' => view('dash.ajaxGraphPie', ['expensive' => $expensive, 'range' => $_GET['range']])->render()
        ]);
    }

    public function ajaxChart()
    {
        if($_GET['range'] == "today"){
            $cart = DB::table('ledger_entries')
            ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
            ->select(DB::raw('sum( ledger_entries.amount ) as total'), 'ledger_entries.entry_date as dt_lancamento')
            ->where([
                ['transition_types.action', 'expensive'],
                ['transition_types.credit_card', '=', true],
                ['ledger_entries.entry_date', '>=', $this->date_begin],
                ['ledger_entries.entry_date', '<=', $this->date_end]
            ])
            ->groupBy('ledger_entries.entry_date')
            ->orderByDesc('ledger_entries.entry_date')
            ->get();

            $expensive = DB::table('ledger_entries')
            ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
            ->select(DB::raw('sum( ledger_entries.amount ) as total'), 'ledger_entries.entry_date as dt_lancamento')
            ->where([
                ['transition_types.action', 'expensive'],
                ['transition_types.credit_card', '<>', true],
                ['ledger_entries.entry_date', '>=', $this->date_begin],
                ['ledger_entries.entry_date', '<=', $this->date_end]
            ])
            ->groupBy('ledger_entries.entry_date')
            ->orderByDesc('ledger_entries.entry_date')
            ->get();

            $recipe = DB::table('ledger_entries')
            ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
            ->select(DB::raw('sum( ledger_entries.amount ) as total'), 'ledger_entries.entry_date as dt_lancamento')
            ->where([
                ['transition_types.action', 'recipe'],
                ['ledger_entries.entry_date', '>=', $this->date_begin],
                ['ledger_entries.entry_date', '<=', $this->date_end]
            ])
            ->groupBy('ledger_entries.entry_date')
            ->orderByDesc('ledger_entries.entry_date')
            ->get();

        }
        

        if($_GET['range'] == "monthly"){

            $date_begin = date('Y-m-d', strtotime("$this->date_begin -1 year"));

            $cart = DB::table('ledger_entries')
            ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
            ->select(DB::raw('sum( ledger_entries.amount ) as total'), DB::raw("DATE_FORMAT(ledger_entries.entry_date, '%Y-%m') dt_lancamento"))
            ->where([
                ['transition_types.action', 'expensive'],
                ['transition_types.credit_card', '=', true],
                ['ledger_entries.entry_date', '>=', $date_begin],
                ['ledger_entries.entry_date', '<=', $this->date_end]
            ])
            ->groupBy('dt_lancamento')
            ->orderByDesc('dt_lancamento')
            ->get();

            $expensive = DB::table('ledger_entries')
            ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
            ->select(DB::raw('sum( ledger_entries.amount ) as total'), DB::raw("DATE_FORMAT(ledger_entries.entry_date, '%Y-%m') dt_lancamento"))
            ->where([
                ['transition_types.action', 'expensive'],
                ['transition_types.credit_card', '<>', true],
                ['ledger_entries.entry_date', '>=', $date_begin],
                ['ledger_entries.entry_date', '<=', $this->date_end]
            ])
            ->groupBy('dt_lancamento')
            ->orderByDesc('dt_lancamento')
            ->get();

            $recipe = DB::table('ledger_entries')
            ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
            ->select(DB::raw('sum( ledger_entries.amount ) as total'), DB::raw("DATE_FORMAT(ledger_entries.entry_date, '%Y-%m') dt_lancamento"))
            ->where([
                ['transition_types.action', 'recipe'],
                ['ledger_entries.entry_date', '>=', $date_begin],
                ['ledger_entries.entry_date', '<=', $this->date_end]
            ])
            ->groupBy('dt_lancamento')
            ->orderByDesc('dt_lancamento')
            ->get();

        }

        if($_GET['range'] == "annual"){

            $cart = DB::table('ledger_entries')
            ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
            ->select(DB::raw('sum( ledger_entries.amount ) as total'), DB::raw('YEAR(ledger_entries.entry_date) dt_lancamento'))
            ->where([
                ['transition_types.action', 'expensive'],
                ['transition_types.credit_card', '=', true]
            ])
            ->groupBy('dt_lancamento')
            ->orderByDesc('dt_lancamento')
            ->get();

            $expensive = DB::table('ledger_entries')
            ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
            ->select(DB::raw('sum( ledger_entries.amount ) as total'), DB::raw('YEAR(ledger_entries.entry_date) dt_lancamento'))
            ->where([
                ['transition_types.action', 'expensive'],
                ['transition_types.credit_card', '<>', true]
            ])
            ->groupBy('dt_lancamento')
            ->orderByDesc('dt_lancamento')
            ->get();

            $recipe = DB::table('ledger_entries')
            ->join('transition_types', 'ledger_entries.transition_type_id', '=', 'transition_types.id')
            ->select(DB::raw('sum( ledger_entries.amount ) as total'), DB::raw('YEAR(ledger_entries.entry_date) dt_lancamento'))
            ->where([
                ['transition_types.action', 'recipe']
            ])
            ->groupBy('dt_lancamento')
            ->orderByDesc('dt_lancamento')
            ->get();
        }

        return response()->json([
            'range' => $_GET['range'],
            'chart'   => view('dash.ajaxChart',   ['lancamentoTotal' => $this->legderSort($expensive, $recipe, $cart), 'range' => $_GET['range']])->render(),
            'finance' => view('dash.ajaxFinance', ['lancamentoTotal' => $this->legderSort($expensive, $recipe, $cart)])->render(),
        ]);
    }

    public function ajaxTask()
    {
        $tasks = \App\Task::where('archived', false)->orderBy('title', 'asc')->limit(5)->get();
        return response()->json([
            'body' => view('dash.ajaxTask', ['tasks' => $tasks])->render()
        ]);
    }

    protected function legderSort($expensive, $recipe, $cart)
    {
        $dtLancamento    = array();
        $lancamentoTotal = array();

        $tempCartao = array();
        foreach($cart as $value):
            $tempCartao[$value->dt_lancamento] = $value->total;
            array_push($dtLancamento, $value->dt_lancamento);
        endforeach;

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
            if(array_key_exists($value, $tempCartao)){
                $lancamentoTotal[$value]['cartao'] = $tempCartao[$value];
            }else{
                $lancamentoTotal[$value]['cartao'] = 0;
            }
        endforeach;

        return  $lancamentoTotal;
    }

    public function list()
    {
        die('dashboard');
    }
}
