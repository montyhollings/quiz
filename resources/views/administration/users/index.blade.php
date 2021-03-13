@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-10 offset-1">
                <div class="card">
                    <div class="card-header">
                        Users
                    </div>
                    <div class="card-body">
                        @include('administration.users.includes.user_table', compact('users'))
                    </div>
                    <div class="card-footer">
                        <a class=" float-right btn btn-success" href="{{route('admin.users.new')}}">Create User</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal_area">

        </div>
    </div>
@endsection
@section('custom-javascript')
    <script>
        $(document).ready(function(){
            $(document).on('click', '#delete_user', function() {
                let url = $(this).data('url');
                $.ajax({
                    type:'GET',
                    url: url,
                    data:'_token = <?php echo csrf_token() ?>',
                    success:function(data){
                        $('#modal_area').html(data);
                        $('#delete_modal').modal('show')
                    },

                });
            });
            function submit_delete(e){
                e.preventDefault();
                let url = $('#submit_delete').data('url');
                let password = $('#password').val();
                $.ajax({
                    type:'POST',
                    url: url,
                    data: { "_token": "{{ csrf_token() }}",password},
                    success:function(data){
                        window.location = data.url;

                    },
                    error: function(data){
                        error = data.responseJSON;
                        $('#password_error').text(error.message);
                        $('#password').focus();
                    }
                });
            }
            $(document).on('click', '#submit_delete', function(e) {
                submit_delete(e);
            });
            $(document).on('keydown', '.modal', function(e) {
                var keyCode = (event.keyCode ? event.keyCode : event.which);
                if (keyCode == 13) {
                    submit_delete(e);
                }
            });


        });


    </script>
@endsection
