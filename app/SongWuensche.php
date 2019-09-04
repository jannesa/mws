<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SongWuensche extends Model
{

    protected $table = 'song_wuensche';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = ['song_titel', 'song_interpret','event_id'];

    public $timestamps = false;



    // Songwunsch gehört zu einem Event
    public function event()
    {
        return $this->belongsTo('App\Event', 'event_id');
    }


}
