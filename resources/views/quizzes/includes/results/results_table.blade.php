<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Quiz</th>
            <th>Taken By</th>
            <th>Taken At</th>
            <th>Score</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($results as $result)
            <tr>
                <td>{{$result->quiz->name}}</td>
                <td>{{$result->user->display_name}}</td>
                <td>{{$result->created_at_display}}</td>
                <td>{{$result->score}}</td>
                <td>
                    <a href="{{route('quizzes.view', [$result])}}" class="btn btn-primary">View Quiz</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
