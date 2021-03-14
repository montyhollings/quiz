@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-10 offset-1">
                <div class="card">
                    <div class="card-header">
                        Quizzes
                    </div>
                    <div class="card-body">
                        @include('quizzes.includes.quiz_table', compact('quizzes'))
                    </div>
                    <div class="card-footer">
                        <a class=" float-right btn btn-success" href="{{route('quizzes.new')}}">Create Quiz</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal_area">

        </div>
    </div>
@endsection
