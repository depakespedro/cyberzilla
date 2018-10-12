<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Profile extends Authenticatable
{
    protected $table = 'profiles';

    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'age',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
