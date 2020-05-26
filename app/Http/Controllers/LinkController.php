<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
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
        $links = DB::table('links')->paginate(10);
        return view('listAllLinks', ['links' => $links]);
    }

    public function listAllLinks()
    {
        $links = DB::table('links')->paginate(10);
        
        return view('listAllLinks', ['links' => $links]);
    }

    public function listLink(Link $link)
    {

        $linksItems = $link->links()->get();

        $parent = DB::table('links')->get();
        return view('listLink', ['link' => $link, 'linksItems' => $linksItems, 'parent' => $parent]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent = DB::table('links')->get();
        return view('addLink', ['parent' => $parent]);
    }

    public function formEditLink(Link $link)
    {
        $parent = DB::table('links')->get();
        return view('editLink', ['link' => $link, 'parent' => $parent]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $link = new Link();
        $link->title   = $request->title;
        $link->link_id = $request->link_id;
        $link->save();

        return \redirect()->route('links.listAll');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link, Request $request)
    {
        $link->title   = $request->title;
        $link->link_id = $request->link_id;
        
        $link->save();

        return redirect()->route('links.listAll');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        $link->delete();
        return \redirect()->route('links.listAll');
    }
}
