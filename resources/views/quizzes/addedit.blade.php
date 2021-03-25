@extends('layouts.app')

@section('content')

        <div class="container">
            <form method="POST" action="{{$formurl}}">
                @csrf
                @if($type == "edit")
                    <input type="hidden" name="quiz_id" id="quiz_id" value="{{$quiz->id}}">
                @endif
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">@if($type == "add")Create @else Edit @endif Quiz</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 offset-2">
                                    <div class="form-group">
                                        <label for="name" class="text-md-right">{{ __('Name') }} <span class="required">*</span></label>
                                        <input id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               value="{{ $quiz->name ?? old('name') }}" required  autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="description" class="text-md-right">{{ __('Description') }} </label>
                                        <textarea class="form-control" id="description" name="description" rows="3">{{old('description')}}</textarea>

                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $quiz->description ?? $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="card-footer">
                            <button id="add_question" class="btn btn-primary float-left  @if($type == "add") d-none @endif" type="button" data-url="{{route('quizzes.questions.new', [$quiz])}}">Add Question</button>
                            <button  class="btn btn-success float-right" type="submit"> @if($type == "add")Create @else Save @endif</button>
                        </div>
                    </div>
                    <div class="error-area">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

    </form>

            <div id="modal_area">

            </div>
        </div>

@endsection
@if($type == "edit")
    @section('custom-javascript')
        <script>
            $(document).ready(function() {
                $(document).on('click', '#add_question', function() {
                    let url = $(this).data('url');
                    $.ajax({
                        type:'GET',
                        url: url,
                        data:'_token = <?php echo csrf_token() ?>',
                        success:function(data){
                            $('#modal_area').html(data);
                            $('#question_modal').modal('show')
                        },

                    });
                });
                $(document).on('change', '#number_of_answers', function() {
                    let val = $(this).val();

                    switch(val) {
                        case "2":
                            $('.question-col-1').removeClass('d-none');
                            $('.question-col-2').removeClass('d-none');
                            $('#question-col-1').removeClass('d-none');
                            $('#answer_1').prop('required',true);
                            $('#answer_2').prop('required',true);
                        break;
                        case "3":
                            $('.question-col-1').removeClass('d-none');
                            $('.question-col-2').removeClass('d-none');
                            $('.question-col-3').removeClass('d-none');
                            $('#answer_1').prop('required',true);
                            $('#answer_2').prop('required',true);
                            $('#answer_3').prop('required',true);

                        break;
                        case "4":
                            $('.question-col-1').removeClass('d-none');
                            $('.question-col-2').removeClass('d-none');
                            $('.question-col-3').removeClass('d-none');
                            $('.question-col-4').removeClass('d-none');
                            $('.answer_1').prop('required',true);
                            $('#answer_2').prop('required',true);
                            $('#answer_3').prop('required',true);
                            $('#answer_4').prop('required',true);

                            break;
                    }
                });



            });

        </script>
    @endsection
@endif

