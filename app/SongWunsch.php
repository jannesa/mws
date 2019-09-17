<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SongWunsch extends Model
{

    protected $table = 'song_wuensche';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = ['song_titel', '','event_id'];

    public $timestamps = false;

    protected $fillable = [
        'song_titel','song_interpret','event_id',
    ];


    // Songwunsch gehört zu einem Event
    public function event()
    {
        return $this->belongsTo('App\Event', 'event_id');
    }


}
