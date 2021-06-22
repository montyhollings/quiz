<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEditQuizRequest;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionAnswer;
use App\Models\SubmittedQuiz;
use App\Models\SubmittedQuizAnswer;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Model\QuizQuestsion;
class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isrestricteduser');
    }

    public function index()
    {
        $quizzes = Quiz::with('createdby', 'questions')->get();

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
            'message' => '  Your password was incorrect, please try again.',

        ), 422);
    }

    public function take_quiz(Request $request, Quiz $quiz)
    {
        $quiz->load('questions.answers', 'createdby');
        Session(['quiz_counter' => 0]);
        $questions_count = $quiz->questions->count();

        return view('quizzes.take_quiz.take_quiz', compact('quiz', 'questions_count'));
    }

    public function load_question(Request $request, Quiz $quiz)
    {
       $quiz->load('questions.answers');
       if((Session::get('quiz_counter')) >= $quiz->questions->count())
       {
           $completed = true;
           return view('quizzes.take_quiz.includes.question', compact('quiz','completed'));
       }
       $completed = false;
       $question = $quiz->questions->offsetGet(Session::get('quiz_counter'));
       Session(['quiz_counter' => Session::get('quiz_counter') + 1]);
       return view('quizzes.take_quiz.includes.question', compact('quiz', 'question', 'completed'));

    }

    public function submit_quiz(Request $request, Quiz $quiz)
    {
        $request = $request->input();
        $submitted_quiz = new SubmittedQuiz;
        $submitted_quiz->quiz_id = $quiz->id;
        $submitted_quiz->user_id = Auth::user()->id;
        $submitted_quiz->save();
        $score = 0;

        foreach($request as $key => $object)
        {
            if(is_int($key)){
                $answer = new SubmittedQuizAnswer;
                $answer->submitted_quiz_id = $submitted_quiz->id;
                $answer->question_id = $key;
                $answer->answer_id = (int) $object ;
                $selected_question = QuizQuestion::findorfail($key);
                dump((int) $object   );
                dump($selected_question->answer_id);
                if($selected_question->answer_id === (int) $object)
                {
                    dump('CORRECT');
                    $answer->is_correct = true;
                    $score++;
                }else{
                    dump('INCORRECT');
                    $answer->is_correct = false;
                }
                $answer->save();
            }
        }
        $submitted_quiz->score = $score;
        $submitted_quiz->save();
        $quiz->increment('times_taken',1);
    }

    public function results_index(Request $request)
    {
        $results = SubmittedQuiz::orderBy('created_at', 'desc')->get();
        return view('quizzes.includes.results.index', compact('results'));
    }

    public function execute_procedures(Request $request)
    {


    }
}
