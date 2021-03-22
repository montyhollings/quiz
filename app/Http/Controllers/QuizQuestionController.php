<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    public function new_question(Request $request, Quiz $quiz)
    {
        $formurl = route('quizzes.questions.submit_new_question', [$quiz]);
        $type = "add";
        return view('quizzes.questions.addedit_modal', compact('quiz', 'type', 'formurl'))->render();
    }

    public function submit_new_question(Request $request, Quiz $quiz)
    {
        dd($request->input());

    }
}
