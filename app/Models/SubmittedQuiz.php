<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SubmittedQuiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtDisplayAttribute()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y H:i  ');
    }
}
