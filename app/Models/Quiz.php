<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Question\Question;

class Quiz extends Model
{
    use HasFactory;

    public $table = 'quizzes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name',
       'description',
       'created_by',
       'times_taken',
       'times_viewed',
       'number_of_questions',



    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'times_taken' => 'integer',
        'times_viewed' => 'integer',

    ];


    public function createdby()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
    public function questions()
    {
        return $this->hasMany(QuizQuestion::class, 'quiz_id');
    }

    public function getNumberOfQuestionsAttribute()
    {
        return $this->questions->count();

    }

    public function results()
    {
        return $this->hasMany(SubmittedQuiz::class, 'quiz_id');
    }


}
