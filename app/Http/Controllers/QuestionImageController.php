<?php

namespace App\Http\Controllers;

use App\QuestionImage;
use Illuminate\Http\Request;

class QuestionImageController extends Controller
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
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function create(\App\Question $question)
    {
        return view('addQuestionImage', ['question' => $question]);
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
            $questionImage = new QuestionImage();

            $image_base64 = base64_encode(file_get_contents($_FILES['fileUpload']['tmp_name']));
            
            $questionImage->image       = $image_base64;
            $questionImage->type        = $this->fileType($file->getClientOriginalName());
            $questionImage->size        = $file->getClientSize();
            $questionImage->question_id = $request->question_id;
            $questionImage->save();
        }

        $question = \App\Question::where('id', $questionImage->question_id)->first();

        return redirect()->route('questionImages.create', ['question' => $question]);
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
     * @param  \App\QuestionImage  $questionImage
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionImage $questionImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuestionImage  $questionImage
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionImage $questionImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuestionImage  $questionImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionImage $questionImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuestionImage  $questionImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionImage $questionImage)
    {
        //
    }
}
