@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{route('quizzes.take.submit_quiz', [$quiz])}}" method="post" id="take_quiz">
            <div class="hidden_input_div">

            </div>
            @csrf
            <div class="row">
                <div class="col-6 offset-3 question_div">

                </div>
            </div>
        </form>
        <div id="modal_area">
        </div>
    </div>
@endsection
@section('custom-javascript')
    <script>
        $(document).ready(function(){
            function load_question(initial){
                let url = "{{route('quizzes.take.load_question', [$quiz])}}";
                let question_id = $('#question_id').val();
                let answer = $('input:checked', '#take_quiz').val();
                let input = `<input type="hidden" name="${question_id}" value="${answer}">`
                if(!initial)
                {
                    $('.hidden_input_div').append(input);
                }
                $.ajax({
                    type:'GET',
                    url: url,
                    data:'_token = <?php echo csrf_token() ?>',
                    success:function(data){
                        $('.question_div').html(data);
                    },
                });
            }
            load_question(true);
            $(document).on('click','#nextbutton', function(){
                checked = $("input[type=radio]:checked").length;

                if(!checked) {
                    $('.no-selection-danger').removeClass('d-none');
                }else{
                    $('.no-selection-danger').addClass('d-none');
                }
                load_question(false);


            });
        });
    </script>
@endsection
