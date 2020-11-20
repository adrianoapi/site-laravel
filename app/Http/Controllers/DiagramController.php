<?php

namespace App\Http\Controllers;

use App\Diagram;
use App\DiagramItem;
use Illuminate\Http\Request;

class DiagramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diagrams = Diagram::orderBy('id', 'desc')->paginate(50);
        return view('diagram.index', ['diagrams' => $diagrams]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('diagram.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Diagram();
        $model->title = $request->title;
        $model->type  = $request->type;
        if($model->save()){

            $item = json_decode($request->body);

            foreach($item->nodeDataArray as $item):

                $modelItem = new DiagramItem();
                $modelItem->diagram_id = $model->id;
                $modelItem->key = $item->key;
                if(array_key_exists('parent', $item)){
                    $modelItem->parent = $item->parent;
                }
                if(array_key_exists('text', $item)){
                    $modelItem->text = $item->text;
                }
                if(array_key_exists('brush', $item)){
                    $modelItem->brush = $item->brush;
                }
                if(array_key_exists('dir', $item)){
                    $modelItem->dir = $item->dir;
                }
                if(array_key_exists('loc', $item)){
                    $modelItem->loc = $item->loc;
                }
                $modelItem->save();

            endforeach;

        }

        return redirect()->route('diagrams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Diagram  $diagram
     * @return \Illuminate\Http\Response
     */
    public function show(Diagram $diagram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Diagram  $diagram
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagram $diagram)
    {
        $json = NULL;
        $json .=  '{ "class": "TreeModel",
            "nodeDataArray": [';
        $json .=  "\n";
        $limit = count($diagram->items);
        $i = 0;
        foreach($diagram->items as $item):
            $i++;
            $json .=  '{';
            $json .=  '"key":'.$item->key.',';
            if(is_numeric($item->parent)){
                $json .=  '"parent":'.$item->parent.',';
            }
            if(!empty($item->text)){
                $json .=  '"text":"'.preg_replace( "/\r|\n/", "", $item->text ).'",';
            }
            if(!empty($item->brush)){
                $json .=  '"brush":"'.$item->brush.'",';
            }
            if(!empty($item->dir)){
                $json .=  '"dir":"'.$item->dir.'",';
            }
            if(!empty($item->loc)){
                $json .=  '"loc":"'.$item->loc.'"';
            }
            $json .=  '}';

            if($i < $limit){
                $json .=  ',';
            }

        endforeach;
        $json .=  ']}';

        return view('diagram.edit', ['diagram' => $diagram,'body' => $json]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Diagram  $diagram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagram $diagram)
    {
        // Clear old items
        DiagramItem::where('diagram_id', $diagram->id)->delete();
        $item = json_decode($request->body);

            foreach($item->nodeDataArray as $item):

                $modelItem = new DiagramItem();
                $modelItem->diagram_id = $diagram->id;
                $modelItem->key = $item->key;
                if(array_key_exists('parent', $item)){
                    $modelItem->parent = $item->parent;
                }
                if(array_key_exists('text', $item)){
                    $modelItem->text = $item->text;
                }
                if(array_key_exists('brush', $item)){
                    $modelItem->brush = $item->brush;
                }
                if(array_key_exists('dir', $item)){
                    $modelItem->dir = $item->dir;
                }
                if(array_key_exists('loc', $item)){
                    $modelItem->loc = $item->loc;
                }
                $modelItem->save();

            endforeach;

        return redirect()->route('diagrams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Diagram  $diagram
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagram $diagram)
    {
        if($diagram->delete()){
            DiagramItem::where('diagram_id', $diagram->id)->delete();
        }

        return redirect()->route('diagrams.index');
    }
}
