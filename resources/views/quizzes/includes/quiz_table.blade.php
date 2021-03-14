<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Created By</th>
            <th>Times Taken</th>
            <th>Number of Questions</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($quizzes as $quiz)
            <tr>
                <td>{{$quiz->name}}</td>
                <td>{{$quiz->createdby->display_name}}</td>
                <td>{{$quiz->times_taken}}</td>
                <td>{{$quiz->number_of_questions}}</td>
                <td>
                    <a href="{{route('quizzes.view', [$quiz])}}" class="btn btn-primary">View Quiz</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
