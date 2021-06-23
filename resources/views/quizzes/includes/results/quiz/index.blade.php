@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-10 offset-1">
                <div class="card">
                    <div class="card-header">
                        Results for: {{$quiz->name}}
                    </div>
                    <div class="card-body">
                        @include('quizzes.includes.results.quiz.includes.results_table', compact('quiz'))

                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
        <div id="modal_area">

        </div>
    </div>
@endsection
