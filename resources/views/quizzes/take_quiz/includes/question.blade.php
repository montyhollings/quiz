<div class="text-center">
    {{$question->question}}?
</div>
<div class="radio-divs">
    @foreach($question->answers as $answer)
        <div class="form-check">
            <input class="form-check-input" type="radio" name="answer_radio" id="questionid-{{$answer->id}}" value="{{$answer->value}}">
            <label class="form-check-label" for="questionid-{{$answer->id}}">
                {{$answer->value}}
            </label>
        </div>
    @endforeach
</div>

