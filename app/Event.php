<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $table = 'event';
    protected $keyType = 'integer';
    protected $primaryKey = 'event_id';

    //ein Event hat mehrere Songwünsche

    public function songWuensche(){

        return $this->hasMany('App\SongWuensche');
    }


    // ein Event gehört zu einem User

    public function user() {

        return $this->belongsTo('App\User', 'user_email');

    }



}
