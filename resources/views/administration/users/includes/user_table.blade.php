<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created At</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->display_name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->Role->description}}</td>
                <td>{{$user->created_at_date_display}}</td>
                <td>@include('administration.users.includes.user_table_buttons')</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
