<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuizResultsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submitted_quizzes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('quiz_id');
            $table->foreignId('user_id');
            $table->integer('score')->default(0)->nullable();

            $table->foreign('quiz_id')->references('id')->on('quizzes');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('submitted_quiz_answers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('submitted_quiz_id');
            $table->foreignId('question_id');
            $table->foreignId('answer_id');
            $table->boolean('is_correct');

            $table->foreign('submitted_quiz_id')->references('id')->on('submitted_quizzes');
            $table->foreign('question_id')->references('id')->on('quiz_questions');
            $table->foreign('answer_id')->references('id')->on('quiz_question_answers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
