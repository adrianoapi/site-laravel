<?php

namespace App\Http\Controllers;

use App\Diagram;
use App\DiagramItem;
use App\DiagramLinkData;
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

            if($request->type == 'mindMap'){

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
            }else{

                $item = json_decode($request->body);

                foreach($item->linkDataArray as $value):

                    $modelLink = new DiagramLinkData();
                    $modelLink->diagram_id = $model->id;
                    $modelLink->from = $value->from;
                    $modelLink->to = $value->to;
                    $modelLink->fromPort = $value->fromPort;
                    $modelLink->toPort = $value->toPort;
                    $modelLink->save();

                endforeach;

                foreach($item->nodeDataArray as $item):

                    $modelItem = new DiagramItem();
                    $modelItem->diagram_id = $model->id;
                    $modelItem->key = $item->key;

                    if(array_key_exists('category', $item)){
                        $modelItem->category = $item->category;
                    }
                    if(array_key_exists('text', $item)){
                        $modelItem->text = $item->text;
                    }

                    if(array_key_exists('loc', $item)){
                        $modelItem->loc = $item->loc;
                    }
                    $modelItem->save();

                endforeach;

            }

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
        if($diagram->type == 'mindMap'){

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
            $page = 'diagram.edit';

        }else{

            $json = NULL;
            $json .=  '{ "class": "go.GraphLinksModel",
                "linkFromPortIdProperty": "fromPort",
                "linkToPortIdProperty": "toPort",
                "nodeDataArray": [';
            $json .=  "\n";
            $limit = count($diagram->items);
            $i = 0;
            foreach($diagram->items as $item):
                $i++;
                $json .=  '{';
                if(!empty($item->category)){
                    $json .=  '"category":"'.$item->category.'",';
                }
                if(is_numeric($item->key)){
                    $json .=  '"key":'.$item->key.',';
                }
                if(!empty($item->text)){
                    $json .=  '"text":"'.preg_replace( "/\r|\n/", "", $item->text ).'",';
                }
                if(!empty($item->loc)){
                    $json .=  '"loc":"'.$item->loc.'"';
                }
                $json .=  '}';

                if($i < $limit){
                    $json .=  ',';
                }

            endforeach;

            $json .=  '],';
            $json .=  '"linkDataArray": [';

            $j = 0;
            $linkDataLimit = count($diagram->linkData);
            foreach($diagram->linkData as $item):
                $j++;
                $json .=  '{';
                if(!empty($item->from)){
                    $json .=  '"from":'.$item->from.',';
                }
                if(is_numeric($item->to)){
                    $json .=  '"to":'.$item->to.',';
                }
                if(!empty($item->fromPort)){
                    $json .=  '"fromPort":"'.$item->fromPort.'",';
                }
                if(!empty($item->toPort)){
                    $json .=  '"toPort":"'.$item->toPort.'"';
                }
                $json .=  '}';

                if($j < $linkDataLimit){
                    $json .=  ',';
                }

            endforeach;
            $json .=  ']}';
            $page = 'diagram.editFlowChart';
        }

        return view($page, ['diagram' => $diagram,'body' => $json]);
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

        if($diagram->type == 'mindMap'){
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
        }else{

        }

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
