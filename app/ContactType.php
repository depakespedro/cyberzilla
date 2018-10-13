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

    static function findByCode(string $code)
    {
        $models = self::where('code', $code)->get();

        if ($models->isEmpty()) {
            return null;
        }

        return $models->first();
    }
}
