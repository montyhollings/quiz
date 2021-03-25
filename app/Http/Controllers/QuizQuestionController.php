<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionAnswer;
use Auth;
use Illuminate\Http\Request;
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

        $question = new QuizQuestion();
        $question->question = trim($request->input('question_title'));
        $question->clue = trim($request->input('question_clue'));
        $question->number_of_answers = $request->input('number_of_answers');
        $question->quiz_id = $quiz->id;
        $question->created_by = Auth::id();

        $answer = new QuizQuestionAnswer();
        $answer->value = trim($request->input('answer_1'));
        $answer->question_id;

    }
}
