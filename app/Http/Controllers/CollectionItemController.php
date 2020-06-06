<?php

namespace App\Http\Controllers;

use App\CollectionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CollectionItemController extends Controller
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
        return view('listAllCollectionItem');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(\App\Collection $collection)
    {
        return view('addCollectionItem', ['collection' => $collection, 'collItem' => '']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $collection = \App\Collection::where('id', $request->collection_id)->first();

        $collectionItem = new CollectionItem();
        $collectionItem->collection_id = $request->collection_id;
        $collectionItem->title         = $request->title;
        $collectionItem->description   = $request->description;
        $collectionItem->save();

        return view('addCollectionItem', ['collection' => $collection, 'collItem' => $collectionItem]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Collection $collection
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Collection $collection)
    {
        return view('showCollectionItem',['collection' => $collection]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CollectionItem  $collectionItem
     * @return \Illuminate\Http\Response
     */
    public function edit(CollectionItem $collectionItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CollectionItem  $collectionItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CollectionItem $collectionItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CollectionItem  $collItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(CollectionItem $collItem)
    {
        $collection = \App\Collection::where('id', $collItem->collection_id)->first();
        $collItem->delete();

        return redirect()->route('collItems.show', ['collection' => $collection]);
    }
}
