<div class="modal" tabindex="-1" id="delete_modal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete @if($type == "user") User @else Quiz @endif</h5>
                @csrf
            </div>
            <div class="modal-body text-center">
                <div class="alert alert-danger">
                    <p class="mb-0 fs-2">Are you sure you wish to delete @if($type == "user") {{$user->display_name}}? @else {{$quiz->name}}? @endif This action cannot be undone.</p>
                    <label for="password">Please enter your password as confirmation</label>
                    <input type="password" autocomplete="password" class="form-control w-50 mx-auto @error('password') is-invalid @enderror" required name="password" id="password">
                    <span class="" role="alert">
                        <strong ><span class="fs-1" id="password_error">

                            </span></strong>
                    </span>
                </div>
                <div>

                </div>
            </div>
            <div class="modal-footer justify-content-between" >
                <button type="button" class="btn btn-secondary" data-bs-dismiss="delete_modal">Close</button>
                <button type="button" id="submit_delete" class="btn btn-danger" data-url="{{$formurl}}" >Delete</button>
            </div>
        </div>
    </div>
</div>
