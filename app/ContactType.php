<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ContactType extends Authenticatable
{
    protected $table = 'contacts_types';

    protected $fillable = [
        'id',
        'code',
        'title',
    ];
}
