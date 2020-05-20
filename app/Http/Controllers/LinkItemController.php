<?php

namespace App\Http\Controllers;

use App\LinkItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LinkItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function listAllLinksItems()
    {
        $linksItems = DB::table('links_items')->paginate(10);
        
        return view('listAllLinksItems', ['linksItems' => $linksItems]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent = DB::table('links')->get();
        return view('addLinkItem', ['parent' => $parent]);
    }

    public function formEditLink(LinkItem $linkItem)
    {
        $parent = DB::table('links')->get();
        return view('editLinkItem', ['linkItem' => $linkItem, 'parent' => $parent]);
    }

    public function list(LinkItem $linkItem)
    {
        $parent = DB::table('links')->get();
        return view('listLinkItem', ['linkItem' => $linkItem, 'parent' => $parent]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $linkItem = new LinkItem();
        $linkItem->title   = $request->title;
        $linkItem->link_id = $request->link_id;
        $linkItem->url     = $request->url;
        $linkItem->save();

        return \redirect()->route('linksItems.listAll');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LinkItem  $linkItem
     * @return \Illuminate\Http\Response
     */
    public function show(LinkItem $linkItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LinkItem  $linkItem
     * @return \Illuminate\Http\Response
     */
    public function edit(LinkItem $linkItem, Request $request)
    {
        $linkItem->title   = $request->title;
        $linkItem->url     = $request->url;
        $linkItem->link_id = $request->link_id;
        
        $linkItem->save();

        return redirect()->route('linksItems.listAll');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LinkItem  $linkItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LinkItem $linkItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LinkItem  $linkItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(LinkItem $linkItem)
    {
        $linkItem->delete();
        return \redirect()->route('linksItems.listAll');
    }
}
