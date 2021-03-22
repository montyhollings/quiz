<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Question\Question;

class QuizQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'clue',
        'created_by',
        'number_of_answers',
        'quiz_id',
        'answer_id',


    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'number_of_answers' => 'integer',

    ];

    public function createdby()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
    public function quiz()
    {
        return $this->hasOne(Quiz::class, 'id', 'quiz_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'question_id');
    }

}
