<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abo extends Model
{

    protected $table = 'abo';
    protected $keyType = 'integer';
    protected $primaryKey = 'abo_id';

    public $timestamps = false;


    public function user()
    {
        // ein Abo kann von mehrere Users genutzt werden

        return $this->hasMany('App\UserModel');
    }


    protected $fillable = [
        'abo_id',
        'abo_typ',
        'abo_laenge',
        'abo_preis',
        'aktive_events' ,
        'inaktive_events',
        'buchungsbeginn',
        'zahlungsart',
        'zahlungsrhythmus'
    ];

}
