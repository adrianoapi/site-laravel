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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = Collection::orderBy('title', 'asc')->paginate(20);
        return view('collection.index', ['collections' => $collections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addCollection', ['order' => $this->getOrder()]);
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
        $collection->save();

        return redirect()->route('collections.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        #showCollection
        return view('collection.view', ['collection' => $collection]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(Collection $collection)
    {
        return view('editCollection', ['collection' => $collection, 'order' => $this->getOrder()]);
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
        //
    }
}
