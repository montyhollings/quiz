@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">{{$quiz->name}} </span>
                        <span class="float-right">  Question - [{{$quiz_counter}}/{{$quiz->number_of_questions}}]</span>
                    </div>
                    <div class="card-body">
                        @include('quizzes.take_quiz.includes.question', [$question])
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class=" d-none text-center no-selection-danger alert alert-danger w-100">Please select an option from the above</div>
                            <button id="nextbutton" class=" float-right btn btn-primary w-100">Next Question</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div id="modal_area">
        </div>
    </div>
@endsection
@section('custom-javascript')
    <script>
        $(document).ready(function(){
            $('#nextbutton').on('click', function(){
                checked = $("input[type=radio]:checked").length;
                console.log(checked);

                if(!checked) {
                    $('.no-selection-danger').removeClass('d-none');
                }else{
                    $('.no-selection-danger').addClass('d-none');
                }


            });
        });
    </script>
@endsection
