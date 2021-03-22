<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestionAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'value',
        'question_id',
        'created_by',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];



    public function question()
    {
        return $this->hasOne(QuizQuestion::class, 'id', 'question_id');
    }
}
