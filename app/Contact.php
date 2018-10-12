<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Contact extends Authenticatable
{
    protected $table = 'contacts';

    protected $fillable = [
        'id',
        'user_id',
        'contact_type_id',
        'info',
    ];

    public function type()
    {
        return $this->belongsTo(ContactType::class);
    }
}
