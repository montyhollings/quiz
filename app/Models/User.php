<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'surname',
        'email',
        'password',
        'super_admin',
        'role'

    ];
    protected $dates = [
      'created_at',
      'updated_at',
      'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getDisplayNameAttribute()
    {
        if($this->first_name && $this->surname)
        {
            return $this->first_name . ' ' . $this->surname;
        }

    }

    public function getCreatedAtDateDisplay()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

    public function Role()
    {
        return $this->hasOne(Role::class, 'id', 'role');
    }
}
