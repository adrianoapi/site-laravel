<?php

namespace App\Http\Controllers;

use App\CollectionItemImage;
use Illuminate\Http\Request;

class CollectionItemImageController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(\App\CollectionItem $collItem)
    {
        return view('addCollectionItemImage', ['collItem' => $collItem]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fileUpload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('fileUpload')) {
            $atendimento = $request->all();
            $file      = $request->file('fileUpload');
            $collectionItemImage = new CollectionItemImage();

            $image_base64 = base64_encode(file_get_contents($_FILES['fileUpload']['tmp_name']));
            
            $collectionItemImage->image       = $image_base64;
            $collectionItemImage->type        = $this->fileType($file->getClientOriginalName());
            $collectionItemImage->size        = $file->getClientSize();
            $collectionItemImage->collection_item_id = $request->collection_item_id;
            $collectionItemImage->save();
        }

        $collItem = \App\CollectionItem::where('id', $collectionItemImage->collection_item_id)->first();

        return redirect()->route('collItemImages.create', ['collItem' => $collItem]);
    }

    public function fileType($value)
    {
        $formato = explode('.', $value);
        
        $tipos = array(
            "htm" => "text/html",
            "exe" => "application/octet-stream",
            "zip" => "application/zip",
            "doc" => "application/msword",
            "jpg" => "image/jpg",
            "php" => "text/plain",
            "xls" => "application/vnd.ms-excel",
            "ppt" => "application/vnd.ms-powerpoint",
            "gif" => "image/gif",
            "pdf" => "application/pdf",
            "txt" => "text/plain",
            "html"=> "text/html",
            "png" => "image/png",
            "jpeg"=> "image/jpg"
        );

        $ext = NULL;
        foreach($tipos as $key => $value){
            if(end($formato) == $key){
                $ext = $value;
                break;
            }
        }

        return $ext;
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\CollectionItemImage  $collectionItemImage
     * @return \Illuminate\Http\Response
     */
    public function show(CollectionItemImage $collectionItemImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CollectionItemImage  $collectionItemImage
     * @return \Illuminate\Http\Response
     */
    public function edit(CollectionItemImage $collectionItemImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CollectionItemImage  $collectionItemImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CollectionItemImage $collectionItemImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CollectionItemImage  $collItemImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(CollectionItemImage $collItemImage)
    {
        $collItem = \App\CollectionItem::where('id', $collItemImage->collection_item_id)->first();
        $collItemImage->delete();

        
        return redirect()->route('collItemImages.create', ['collItem' => $collItem]);
    }
}
