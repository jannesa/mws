<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Event;
use App\SongWunsch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class EventController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function openEventsPage(){
        return view('events_erstellen');
    }

    public function showAllEvents(){
        $user = Auth::user();

        $events = Event::where('user_email',$user->email)->get();

        return view('events')->with('events', $events->reverse());
    }

    public function addEvent(Request $request)
    {
        $Event = new Event();
        $event_titel = $request['inputTitel'];
        $event_beschreibung= $request['inputBeschreibung'];

        if($request['spamfilter']== 0){
            $event_spamfilter = '0';
        }else if($request['spamfilter']== 1){
            $event_spamfilter = '1';
        }else if($request['spamfilter']== 2){
            $event_spamfilter = '2';
        }

        if($request['status']){
            $event_status = 'aktive';
        }else{
            $event_status = 'inaktive';
        }

        $user = Auth::user();
        $email = $user->email;

        $Event->titel = $event_titel;
        $Event->beschreibung = $event_beschreibung;
        $Event->user_email = $email;
        $Event->spamfilter = $event_spamfilter;
        $Event->status = $event_status;
        $Event->event_hash = str_random(10);

        $Event->save();

        return redirect('/events');
    }
    public function delete(Request $request){


        Event::find($request['id']) -> delete();
        return redirect('/events');
    }

    public function editEvent(Request $request){

        if($request['spamfilter']== 0){
            $event_spamfilter = '0';
        }else if($request['spamfilter']== 1){
            $event_spamfilter = '1';
        }else if($request['spamfilter']== 2){
            $event_spamfilter = '2';
        }

        if($request['status']){
            $event_status = 'aktive';
        }else{
            $event_status = 'inaktive';
        }

        $event = Event::find($request['id']);
        $event -> titel= $request['titel'];
        $event -> beschreibung= $request['beschreibung'];
        $event -> spamfilter = $event_spamfilter;
        $event -> status = $event_status;

        $event -> save();

        return redirect('events');
    }

    public function showSongs($link_hash){
        $event_daten = DB::table('event')->where('event_hash', $link_hash)->first();
        $event_id = $event_daten -> event_id;

        $songs = SongWunsch::where('event_id',$event_id)->get();

        return view('/songs',['songs' => $songs]);

    }


//    public function deleteSong(Request $request){
//        //SongWunsch::find($request['song_titel'],$request['song_interpret'],$request['event_id']) -> delete();
//        //DB::table('song_wuensche')->where('song_titel', $request['song_titel'])->delete();
//
//
//        error_log('LOG:',$request->song_titel);
//
////        DB::table('song_wuensche')
////            ->where('song_titel', $request->song_titel)
////            ->delete();
//
//        return redirect('/events');
//        //$songs = SongWunsch::where('event_id',$request['event_id'])->get();
//        //return view('/songs',['songs' => $songs]);
//    }





    public function editSongStatus(Request $request){
        DB::table('song_wuensche')
            ->where('song_titel', $request->titel)
            ->where('song_interpret', $request->interpret)
            ->where('event_id', $request->eventid)
            ->update(['gespielt' => $request->gespielt]);

        $songs = SongWunsch::where('event_id',$request->eventid)->get();

        return view('/songs',['songs' => $songs]);
    }



}
