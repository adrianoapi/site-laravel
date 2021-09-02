<?php

namespace App\Http\Controllers;

use App\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
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
        $exams = Exam::paginate(10);
        return view('listAllExam', ['exams' => $exams]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addExam');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exam = new Exam();
        $exam->user_id     = Auth::id();
        $exam->title       = $request->title;
        $exam->description = $request->description;
        $exam->save();

        return redirect()->route('exams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        return view('showExam', ['exam' => $exam]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        return view('editExam', ['exam' => $exam]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        $exam->title       = $request->title;
        $exam->description = $request->description;
        $exam->save();

        return redirect()->route('exams.index');
    }

    /**
     * Show the form for execute the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function execute(Exam $exam)
    {
        $question = \App\Question::inRandomOrder()
        ->where('exam_id', $exam->id)
        ->where('answer', 0)
        ->first();

        if(empty($question))
        {
            die('Não há questões para responder!');
        }

        return view('showExamExecute', ['exam' => $exam, 'question' => $question]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();

        return redirect()->route('exams.index');
    }
}
