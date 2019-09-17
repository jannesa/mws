<?php

namespace App\Http\Controllers;

use App\Event;
use App\SongWunsch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class guestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($link_hash)
    {

        $event_daten = DB::table('event')->where('event_hash', $link_hash)->first();


        return view('guests')->with('event_daten', $event_daten);
    }



    public function addSong(Request $request)
    {
        $SongWunsch = new SongWunsch();

        $songtitel = $request['song_titel'];
        $songinterpret = $request['song_interpret'];
        $eventid = $request['event_id'];
        $eventhash = $request['event_hash'];

        $SongWunsch->song_titel = $songtitel;
        $SongWunsch->song_interpret = $songinterpret;

        $SongWunsch->event_id= $eventid;

        $SongWunsch->gespielt= 0;

        $SongWunsch->ranking= 0;



        $song = DB::table('song_wuensche')->where('song_titel',$songtitel)->exists();

        if($song){

            $rank = $SongWunsch::where('song_titel', $songtitel)
                ->value('ranking');

            $rank++;

            error_log($rank);

            $SongWunsch::where('song_titel', $songtitel)
                ->update(['ranking' => $rank]);

        }
        else{

            $SongWunsch->save();
        }
        return redirect('guest/'.$eventhash);
    }
}
