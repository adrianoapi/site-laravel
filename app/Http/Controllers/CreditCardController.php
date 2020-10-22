<?php

namespace App\Http\Controllers;

use App\CreditCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CreditCardController extends Controller
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
        $credCards = DB::table('ledger_entries')
        ->select(
            'installments',
            'entry_date',
            DB::raw('ADDDATE(entry_date, INTERVAL installments MONTH) AS limite'),
            'amount')
        ->where([
            ['installments', '>', 0],
            [DB::raw('ADDDATE(entry_date, INTERVAL installments MONTH)'), '>', '2020-10-20']
        ])
        ->orderBy('entry_date', 'desc')
        ->get();
        
        
        $arr_data_limite = [];
        foreach($credCards as $value):
            array_push($arr_data_limite, $value->limite);
        endforeach;

        #Cria as colunas da tabela
        $columns = [];
        $date    = date('Y-m', strtotime("$arr_data_limite[0] -30 days"));
        do{
            array_push($columns, $date);
            $date = date('Y-m', strtotime("$date -30 days"));
        }
        while($date >= date('Y-m'));

        #Cria uma matriz de acordo com a data do array columns
        $table = [];
        foreach($columns as $key => $value):

            foreach($credCards as $cart):

                if(date('Y-m', strtotime("$cart->limite")) >= $value){
                    $table[$value][] = $cart->amount/$cart->installments;
                }

            endforeach;

        endforeach;

        ksort($table);

        return view('creditCard.index', ['table' => $table]);
    }

    function ordenar($a, $b)
    {
        return strcmp($a["limite"], $b["limite"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function show(CreditCard $creditCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditCard $creditCard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CreditCard $creditCard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditCard $creditCard)
    {
        //
    }
}
