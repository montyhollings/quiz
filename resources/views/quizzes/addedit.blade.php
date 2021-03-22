@extends('layouts.app')

@section('content')
    <form method="POST" action="{{$formurl}}">
        @csrf
        @if($type == "edit")
            <input type="hidden" name="quiz_id" id="quiz_id" value="{{$quiz->id}}">
        @endif
        <div class="container">
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
                            <button class="btn btn-primary float-left  @if($type == "add") d-none @endif" type="button" data-url="">Add Question</button>
                            <button  class="btn btn-success float-right" type="submit"> @if($type == "add")Create @else Save @endif</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@if($type == "edit")
    @section('custom-javascript')
        <script>
            $(document).ready(function() {
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
            });
        </script>
    @endsection
@endif

