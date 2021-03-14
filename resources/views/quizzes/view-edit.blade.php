@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">View Quiz</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 offset-2">
                                <div class="form-group">
                                    <label for="name" class="text-md-right">{{ __('Name') }} </label>
                                    <input id="name" type="text"
                                           class="form-control " name="name"
                                           value="{{ $quiz->name }}" required  disabled autofocus>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="description" class="text-md-right">{{ __('Description') }} </label>
                                    <textarea disabled class="form-control" id="description" name="description" rows="1">{{$quiz->description ?? null}}</textarea>

                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="card-footer justify-content-between d-flex">


                        <button  class="btn btn-success" type="submit">View Questions</button>
                        <button  class="btn btn-danger" type="submit">Take Quiz</button>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Options
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('quizzes.edit', [$quiz])}}">Edit</a>
                                <button type="button" id="delete_quiz" class="dropdown-item" data-url="{{route('quizzes.delete_modal', [$quiz])}}">Delete</button>
                            </div>
                        </div>

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
            $(document).on('click', '#delete_quiz', function() {
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

