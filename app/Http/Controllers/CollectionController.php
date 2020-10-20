<?php

namespace App\Http\Controllers;

use App\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getOrder()
    {
        return ['title', 'release','id'];
    }

    public function getLayout()
    {
        return ['list', 'gallery'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(array_key_exists('filtro',$_GET)){
            $collections = Collection::where('title', 'like', '%' . $_GET['pesquisar'] . '%')->orderBy('title', 'asc')->paginate(50);
        }else{
            $collections = Collection::orderBy('title', 'asc')->paginate(20);
        }
        
        return view('collection.index', ['collections' => $collections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('collection.add', ['order' => $this->getOrder(), 'layout' => $this->getLayout()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $collection = new Collection();
        $collection->user_id          = Auth::id();
        $collection->title            = $request->title;
        $collection->description      = $request->description;
        $collection->show_id          = $request->show_id          == 'true' ? true : false;
        $collection->show_image       = $request->show_image       == 'true' ? true : false;
        $collection->show_title       = $request->show_title       == 'true' ? true : false;
        $collection->show_description = $request->show_description == 'true' ? true : false;
        $collection->show_release     = $request->show_release     == 'true' ? true : false;
        $collection->order            = $request->order;
        $collection->layout           = $request->layout;
        $collection->save();

        return redirect()->route('collections.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection, Request $request)
    {
        if(array_key_exists('filtro',$_GET)){
            $collectionItems = \App\CollectionItem::
            where([
                ['description', 'like', '%' . $_GET['pesquisar'] . '%'],
                ['collection_id', $collection->id]
            ])
            ->orderBy($collection->order, 'asc')->get();
        }else{
            $collectionItems = \App\CollectionItem::where('collection_id', $collection->id)
            ->orderBy($collection->order, 'asc')
            ->get();
        }
        
        
        return view('collection.view', [
            'collection' => $collection,
            'collectionItems' => $collectionItems
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(Collection $collection)
    {
        return view('collection.edit', [
            'collection' => $collection,
            'order'      => $this->getOrder(),
            'layout'     => $this->getLayout()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection)
    {
        $collection->title            = $request->title;
        $collection->description      = $request->description;
        $collection->show_id          = $request->show_id          == 'true' ? true : false;
        $collection->show_image       = $request->show_image       == 'true' ? true : false;
        $collection->show_title       = $request->show_title       == 'true' ? true : false;
        $collection->show_description = $request->show_description == 'true' ? true : false;
        $collection->show_release     = $request->show_release     == 'true' ? true : false;
        $collection->order            = $request->order;
        $collection->layout           = $request->layout;
        $collection->save();

        return redirect()->route('collections.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        $collection->delete();
        return redirect()->route('collections.index');
    }
}
