<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Quiz</th>
            <th>Times Taken</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($quizzes as $quiz)
            <tr>
                <td>{{$quiz->name}}</td>
                <td>{{$quiz->times_taken}}</td>
                <td>
                    <a href="{{route('quizzes.results.quiz.index', [$quiz])}}" class="btn btn-primary">View Results For This Quiz</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
