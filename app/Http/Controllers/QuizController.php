<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEditQuizRequest;
use App\Models\Quiz;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isrestricteduser');
    }

    public function index()
    {
        $quizzes = Quiz::with('createdby')->get();

        return view('quizzes.index', compact('quizzes'));
    }

    public function view(Request$request, Quiz $quiz )
    {
        $quiz->load('questions.answers');
        $questions = $quiz->questions;
        return view('quizzes.view-edit', compact('quiz', 'questions'));


    }

    public function new_quiz(Request $request)
    {
        $type = "add";
        $formurl = route('quizzes.submit_new_quiz');
        return view('quizzes.addedit', compact('formurl', 'type'));


    }

    public function submit_new_quiz(CreateEditQuizRequest $request)
    {
        $request->request->add(['created_by' => Auth::id()]);
        $quiz = Quiz::create($request->input());
        Session::flash('message', 'Quiz Created!');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('quizzes.view', [$quiz]);

    }

    public function edit(Request $request, Quiz $quiz)
    {
        $type = "edit";
        $formurl = route('quizzes.save', [$quiz]);
        return view('quizzes.addedit', compact('formurl', 'type', 'quiz'));
    }

    public function save(CreateEditQuizRequest $request, Quiz $quiz)
    {
        $quiz->update($request->input());
        Session::flash('message', 'Quiz Updated!');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('quizzes.view', [$quiz]);
    }

    public function delete_modal(Request $request, Quiz $quiz)
    {
        $formurl = route('quizzes.submit_delete', [$quiz]);
        $type = "quiz";
        return view('includes.delete_modal', compact('quiz', 'formurl', 'type'))->render();
    }

    public function submit_delete(Request $request, Quiz $quiz)
    {

        if (Hash::check($request->input('password'), Auth::user()->password)) {
            $quiz->delete();
            Session::flash('message', 'Quiz Deleted!');
            Session::flash('alert-class', 'alert-success');
            return response()->json(['url'=>route('quizzes.index')]);

        }
        return response()->json(array(
            'success' => false,
            'message' => 'Your password was incorrect, please try again.',

        ), 422);
    }

}
