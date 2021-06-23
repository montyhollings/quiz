<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Taken By</th>
            <th>Taken At</th>
            <th>Score</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($quiz->results as $result)
            <tr>
                <td>{{$result->user->display_name}}</td>
                <td>{{$result->created_at_display}}</td>
                <td>{{$result->score}} / {{$result->quiz->number_of_questions}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
