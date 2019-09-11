<?php

namespace App\Http\Controllers;

use App\SongWunsch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class guestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('guests');

    }

    public function addSong(Request $request)
    {
        $SongWunsch = new SongWunsch();

        $songtitel = $request['song_titel'];
        $songinterpret = $request['song_interpret'];

        $SongWunsch->song_titel = $songtitel;
        $SongWunsch->song_interpret = $songinterpret;

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

        return view('guests');
    }
}
