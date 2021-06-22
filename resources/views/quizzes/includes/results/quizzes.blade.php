<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Quiz</th>
            <th>Times Taken</th>
            <th>Created At</th>
            <th>Created By</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($results as $result)
            <tr>
                <td>{{$quiz->name}}</td>
                <td>{{$quiz}}</td>
                <td>{{$quiz}}</td>
                <td>{{$quiz}}</td>
                <td>
                    <a href="{{route('quizzes.view', [$result])}}" class="btn btn-primary">View Quiz</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
