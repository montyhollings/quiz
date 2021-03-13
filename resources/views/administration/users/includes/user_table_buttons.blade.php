<div class="btn-group" role="group">
    <a href="{{route('admin.users.edit', [$user])}}" class="btn btn-primary">Edit</a>
    <button type="button" id="delete_user" data-url="{{route('admin.users.delete_modal', [$user])}}" class="btn btn-danger">Delete</button>
</div>
