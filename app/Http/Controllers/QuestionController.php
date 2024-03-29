<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
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
        if(array_key_exists('filtro',$_GET)){
            if($_GET['filtro'] == 'exame'){
                $questions = Question::where('exam_id', $_GET['id'])->paginate(50);
            }elseif($_GET['filtro'] == 'pesquisa'){
                $questions = Question::where('title', 'like', '%' . $_GET['pesquisar'] . '%')->orderBy('title', 'asc')->paginate(50);
            }
        }else{
            $questions = Question::paginate(10);
        }

        $exams = \App\Exam::all();

        return view('listAllQuestion', ['questions' => $questions, 'exams' => $exams]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exams    = DB::table('exams')->get();
        return view('addQuestion',['exams' => $exams]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = new Question();
        $question->exam_id     = $request->exam_id;
        $question->title       = $request->title;
        $question->description = $request->description;
        $question->save();

        return redirect()->route('answers.create', ['question' => $question]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $exams    = DB::table('exams')->get();
        return view('showQuestion', ['question' => $question, 'exams' => $exams]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $exams    = DB::table('exams')->get();
        return view('editQuestion', ['question' => $question, 'exams' => $exams]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $question->exam_id     = $request->exam_id;
        $question->title       = $request->title;
        $question->description = $request->description;
        $question->save();

        return redirect()->route('questions.show', ['question' => $question]);
    }

    public function confirm(Request $request, Question $question)
    {
        $answer = \App\Answer::where('id', $request->answer_id)->first();
        $exam   = \App\Exam::where('id', $question->exam_id)->first();

        $question->answer = $question->answer +1;
        $question->save();

        return view('showExamConfirm', ['exam' => $exam, 'question' => $question, 'answer' => $answer]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index');
    }
}
