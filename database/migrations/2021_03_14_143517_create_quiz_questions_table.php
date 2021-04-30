<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_question_answers', function(Blueprint $table) {
           $table->id();
           $table->timestamps();
           $table->foreignId('question_id');
           $table->string('value');
        });
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('question');
            $table->string('clue');
            $table->integer('number_of_answers');
            $table->foreignId('quiz_id');
            $table->foreignId('answer_id')->nullable()->default(null);
            $table->foreignId('created_by');

            $table->foreign('quiz_id')->references('id')->on('quizzes');
            $table->foreign('answer_id')->references('id')->on('quiz_question_answers');
            $table->foreign('created_by')->references('id')->on('users');
        });
        Schema::table('quiz_question_answers', function(Blueprint $table) {
            $table->foreign('question_id')->references('id')->on('quiz_questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_questions');
    }
}
