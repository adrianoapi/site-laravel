<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
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
        $answers = Answer::paginate(10);
        return view('listAllAnwser', ['answers' => $answers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(\App\Question $question)
    {

        $answers = Answer::where('question_id', $question->id)->orderBy('id', 'desc')->get();

        return view('addAnswer',['answers' => $answers, 'question' => $question, 'answer' => '']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = \App\Question::where('id', $request->question_id)->first();

        $answer = new Answer();
        $answer->question_id = $request->question_id;
        $answer->description = $request->description;
        $answer->correct     = $request->correct == 'true' ? true : false;
        $answer->save();

        $answers = Answer::where('question_id', $answer->question_id)->orderBy('id', 'desc')->get();

        return view('addAnswer',['answers' => $answers, 'question' => $question, 'answer' => $answer]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Question $question)
    {
        $answers = Answer::where('question_id', $question->id)->orderBy('id', 'desc')->get();
        return view('showAnswer',['answers' => $answers, 'question' => $question]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        $answer->question_id = $request->question_id;
        $answer->description = $request->description;
        $answer->correct     = $request->correct == 'true' ? true : false;
        $answer->save();

        return redirect()->route('answers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $question = \App\Question::where('id', $answer->question_id)->first();
        $answer->delete();

        return redirect()->route('answers.show', ['question' => $question]);
    }
}
