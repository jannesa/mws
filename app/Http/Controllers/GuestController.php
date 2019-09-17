<?php

namespace App\Http\Controllers;

use App\Events\newSong as SONG;
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
       /* $SongWunsch = new SongWunsch();

        $songtitel = $request['song_titel'];
        $songinterpret = $request['song_interpret'];

        $SongWunsch->song_titel = $songtitel;
        $SongWunsch->song_interpret = $songinterpret;

        $SongWunsch->event_id= 1;

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

            //dd($SongWunsch);

            $SongWunsch->save();
        }*/


        //$song = SongWunsch::create($request->only('song_titel', 'song_interpret'));

        // fire ShoutoutAdded event if shoutout successfully added to database

        $SongWunsch = SongWunsch::create([
            'song_titel' => $request->song_titel,
            'song_interpret' => $request->song_interpret,
            'event_id' => 1,
            'gespielt' => 1,
            'ranking' => 1,

        ]);

        $song = SongWunsch::where('song_titel', $SongWunsch->song_titel)->first();
        event(new SONG($song));

        return response()->json(['message' => 'jow'], 201);


        //return $song->toJson();

        //$ev = event(new SONG($SongWunsch));

        //dd($ev);

        //return response()->json(['message' => 'jow'], 201);

        //return redirect('/')->with('success', 'Wunsch eingegangen');
    }
}
