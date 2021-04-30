<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionAnswer;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Validator;

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
        $validator = Validator::make($request->all(), [
            'question_title' => 'required|min:4',
            'number_of_answers' => 'required',
            'correct_answer' => 'required',
        ]);

        $questions = [
          'answer_1' => 'required',
          'answer_2' => 'required',
          'answer_3' => 'required',
          'answer_4' => 'required',
        ];
        $questions = array_slice($questions, 0, $request->input('number_of_answers'));
        $validator->addRules($questions);

        if ($validator->fails()) {
        return redirect()->route('quizzes.edit', $quiz)
            ->withErrors($validator)
            ->withInput();
        }
        $correct_answer = $request->input('correct_answer');

        $question = new QuizQuestion();
        $question->question = trim($request->input('question_title'));
        $question->clue = trim($request->input('question_clue'));
        $question->number_of_answers = $request->input('number_of_answers');
        $question->quiz_id = $quiz->id;
        $question->created_by = Auth::id();
        $question->save();

        $answer1 = new QuizQuestionAnswer();
        $answer1->value = trim($request->input('answer_1'));
        $answer1->question_id = $question->id;
        $answer1->save();

        $answer2 = new QuizQuestionAnswer();
        $answer2->value = trim($request->input('answer_2'));
        $answer2->question_id = $question->id;
        $answer2->save();
        if(in_array($request->input('number_of_answers'), [3,4]))
        {
            $answer3 = new QuizQuestionAnswer();
            $answer3->value = trim($request->input('answer_3'));
            $answer3->question_id = $question->id;
            $answer3->save();
        }
        if($request->input('number_of_answers') == 4)
        {
            $answer4 = new QuizQuestionAnswer();
            $answer4->value = trim($request->input('answer_3'));
            $answer4->question_id = $question->id;
            $answer4->save();
        }

        switch($correct_answer)
        {
            case 1:
                $question->answer_id = $answer1->id;
            break;
            case 2:
                $question->answer_id = $answer2->id;
            break;
            case 3:
                $question->answer_id = $answer3->id;
            break;
            case 4:
                $question->answer_id = $answer4->id;
            break;
        }
        $question->save();
        Session::flash('message', 'Quiz Question Created!');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('quizzes.edit', [$quiz]);

    }

    public function delete_modal(Request $request, Quiz $quiz, QuizQuestion $question)
    {
        $formurl = route('quizzes.questions.submit_delete', [$quiz, $question]);
        $type = "question";
        return view('includes.delete_modal', compact('quiz', 'formurl', 'type', 'question'))->render();
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
