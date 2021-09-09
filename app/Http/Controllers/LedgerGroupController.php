<?php

namespace App\Http\Controllers;

use App\LedgerGroup;
use App\Http\Requests\StoreLedgerGroupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LedgerGroupController extends Controller
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
        $ledgerGroups = LedgerGroup::paginate(10);
        return view('ledgerGroup.index', ['ledgerGroups' => $ledgerGroups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = DB::table('ledger_groups')->get();
        return view('ledgerGroup.add', ['parents' => $parents]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLedgerGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLedgerGroupRequest $request)
    {
        $ledgerGroup                   = new LedgerGroup();
        $ledgerGroup->title            = $request->title;
        $ledgerGroup->description      = $request->description;
        $ledgerGroup->ledger_group_id  = $request->ledger_group_id;
        $ledgerGroup->save();

        if($request->ledger_group_id < 1){
            $ledgerGroup->ledger_group_id = $ledgerGroup->id;
            $ledgerGroup->save();
        }

        return redirect()->route('ledgerGroups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LedgerGroup  $ledgerGroup
     * @return \Illuminate\Http\Response
     */
    public function show(LedgerGroup $ledgerGroup)
    {
        $parents = DB::table('ledger_groups')->get();
        return view('ledgerGroup.view', ['ledgerGroup' => $ledgerGroup, 'parents' => $parents]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LedgerGroup  $ledgerGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(LedgerGroup $ledgerGroup)
    {
        $parents = DB::table('ledger_groups')->get();
        return view('ledgerGroup.edit', ['ledgerGroup' => $ledgerGroup, 'parents' => $parents]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LedgerGroup  $ledgerGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LedgerGroup $ledgerGroup)
    {
        $ledgerGroup->title           = $request->title;
        $ledgerGroup->description     = $request->description;
        $ledgerGroup->ledger_group_id = $request->ledger_group_id;
        $ledgerGroup->save();

        if($request->ledger_group_id < 1){
            $ledgerGroup->ledger_group_id = $ledgerGroup->id;
            $ledgerGroup->save();
        }

        return redirect()->route('ledgerGroups.index');
    }

    public function getTree()
    {
        return explode('-||',$this->getEstruturaMenu(LedgerGroup::all()));
    }

    public function organize()
    {
        return view('ledgerGroup.organize');
    }

    public function getEstruturaMenu($array)
    {
        $html = '';

        foreach ($array as $key => $value):

            //Verifica se o item do array é o próprio pai
            if ($value->id == $value->ledger_group_id) {

                $html .= $value->id . "||-" . $value->title . "-||";

                //Remove o indice pai
                unset($array[$key]);

                $html .= $this->getEstruturaMenuSub($value->id, $array, $novo_count = 0, $ultima_categoria = 0);
            }

        endforeach;

        return $html;
    }

    public function getEstruturaMenuSub($id, $array, $novo_count, $ultima_categoria = 0)
    {

        $html = '';

        //Laço sub
        foreach ($array as $key => $data):

            if ($id == $data->ledger_group_id) {

                /* Passa sempre o último id da categoria para verificar
                 * se ela pertence ao pai anterior, se sim ela permanecerá
                 * no mesmo nível
                 */
                if ($ultima_categoria == $data->ledger_group_id) {
                    $novo_count;
                } else {
                    $novo_count++;
                }

                $ultima_categoria = $data->ledger_group_id;

                $html .= $data->id . "||-" . $this->identarEstruturaMenu($novo_count) . $data->title . "-||";

                //Remove que já foi encotrado na comparação
                unset($array[$key]);

                $html .= $this->getEstruturaMenuSub($data->id, $array, $novo_count, $ultima_categoria);
            }

        endforeach;

        return $html;
    }

    public function identarEstruturaMenu($value)
    {
        $indentacao = '|';
        for ($i = 0; $i < $value; $i++) {
            $indentacao .= " - ";
        }
        return $indentacao;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LedgerGroup  $ledgerGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(LedgerGroup $ledgerGroup)
    {
        $ledgerGroup->delete();
        return redirect()->route('ledgerGroups.index');
    }
}
