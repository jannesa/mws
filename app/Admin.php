<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';


    // das hier ist das Admin Auth Model -> brauchen wir nachher für den login und Email Verifizierung etc

    protected $table = 'admin';


    protected $fillable = [
        'admin_id', 'vorname','nachname', 'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
