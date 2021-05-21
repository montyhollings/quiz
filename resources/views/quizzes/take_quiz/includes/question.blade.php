    <div class="card">
    <div class="card-header">
        <span class="float-left">{{$quiz->name}} </span>
        @if(!$completed)
            <input type="hidden" id="question_id" name="question_id" value="{{$question->id}}">
        @endif
        <span class="float-right">  Question - [{{Session::get('quiz_counter')}}/{{$quiz->number_of_questions}}]</span>
    </div>
    <div class="card-body question_div">
        <div class="text-center">
            @if(!$completed)
                {{$question->question}}?
            @else
                Finished test
            @endif

        </div>
        @if(!$completed)
            <div class="radio-divs">
                @foreach($question->answers as $answer)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer_radio" id="questionid-{{$answer->id}}" value="{{$answer->id}}">
                        <label class="form-check-label" for="questionid-{{$answer->id}}">
                            {{$answer->value}}
                        </label>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="d-none text-center no-selection-danger alert alert-danger w-100">Please select an option from the above</div>
            @if(!$completed)

                <button type="button" id="nextbutton" class="float-right btn btn-primary w-100">Next Question</button>

            @else
                <button type="submit" id="quizsubmit" class="float-right btn btn-success w-100">Submit Quiz</button>

            @endif
        </div>
    </div>
</div>

