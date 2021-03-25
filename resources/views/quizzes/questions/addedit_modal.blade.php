<form action="{{$formurl}}" method="POST" id="question_form">
    @csrf
    <div class="modal" tabindex="-1" id="question_modal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create new question</h5>
                    @csrf
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="question_title">Question <span class="required">*</span></label>
                                <input type="text" class="form-control" id="question_title" required>
                            </div>
                            <div class="form-group">
                                <label for="question_clue">Clue</label>
                                <textarea rows="2" type="text" class="form-control" id="question_clue"></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="number_of_answers">Number of Answers</label>
                                <select class="form-control" id="number_of_answers" name="number_of_answers" required>
                                    <option value=""></option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 question-col-1 d-none">
                            <div class="form-group">
                                <label for="answer_1">Answer 1 <span class="required">*</span></label>
                                <input type="text" class="form-control" id="answer_1" name="answer_1" >
                            </div>
                        </div>
                        <div class="col-3 question-col-2 d-none">
                            <div class="form-group">
                                <label for="answer_2">Answer 2 <span class="required">*</span></label>
                                <input type="text" class="form-control" id="answer_2" name="answer_2" >
                            </div>
                        </div>
                        <div class="col-3 question-col-3 d-none">
                            <div class="form-group">
                                <label for="answer_3">Answer 3 <span class="required">*</span></label>
                                <input type="text" class="form-control" id="answer_3" name="answer_3" >
                            </div>
                        </div>
                        <div class="col-3 question-col-4 d-none">
                            <div class="form-group">
                                <label for="answer_4">Answer 4 <span class="required">*</span></label>
                                <input type="text" class="form-control" id="answer_4" name="answer_4" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between" >
                    <button type="submit" id="submit_delete" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
