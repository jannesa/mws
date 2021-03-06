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
use Illuminate\Support\Str;


class EventController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function openEventsPage(){
        $user = Auth::user();
        $events = Event::where('user_email',$user->email)->get();
        $count_active = 0;
        $count_inactive = 0;
        $user_abo_id = $user->abo_id;

        foreach ($events as $event) {

            if($event->status == "aktiv"){
                $count_active ++;
            } else {
                $count_inactive ++;
            }
        }

        return view('events_erstellen')->with('count_active',$count_active)->with('count_inactive',$count_inactive)->with('user_abo_id',$user_abo_id);
    }

    public function showAllEvents(){
        $user = Auth::user();
        $events = Event::where('user_email',$user->email)->get();

        $user_abo_id = $user->abo_id;

        $count_active = 0;
        $count_inactive = 0;

        foreach ($events as $event) {

            if($event->status == "aktiv"){
                $count_active ++;
            } else {
                $count_inactive ++;
            }
        }

        return view('events')->with('events', $events->reverse())->with('count_active',$count_active)->with('count_inactive',$count_inactive)->with('user_abo_id',$user_abo_id);
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
            $event_status = 'aktiv';
        }else{
            $event_status = 'inaktiv';
        }

        $user = Auth::user();
        $email = $user->email;
        $Event->titel = $event_titel;
        $Event->beschreibung = $event_beschreibung;
        $Event->user_email = $email;
        $Event->spamfilter = $event_spamfilter;
        $Event->status = $event_status;
        $Event->event_hash = Str::random(10);
        $Event->save();

        return redirect('/events');
    }
    public function delete(Request $request){
        $qrDelete = public_path().'/'.'qrCodeImages/'.$request['hash'].'.png';
        unlink($qrDelete);
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
            $event_status = 'aktiv';
        }else{
            $event_status = 'inaktiv';
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
        $event_name = $event_daten->titel;

        $songs = SongWunsch::where('event_id',$event_id)->get();
        return view('/songs',['songs' => $songs])->with('event_name', $event_name);
    }


    public function deleteSong(Request $request){
        DB::table('song_wuensche')
            ->where('song_titel', $request->titel)
            ->where('song_interpret', $request->interpret)
            ->where('event_id', $request->eventid)
            ->delete();

        $event_daten = DB::table('event')->where('event_id', $request->eventid)->first();
        $event_hash = $event_daten -> event_hash;
        return redirect('songs/'.$event_hash);
    }





    public function editSongStatus(Request $request){
        DB::table('song_wuensche')
            ->where('song_titel', $request->titel)
            ->where('song_interpret', $request->interpret)
            ->where('event_id', $request->eventid)
            ->update(['gespielt' => $request->gespielt]);

        //$songs = SongWunsch::where('event_id',$request->eventid)->get();
        //return view('/songs',['songs' => $songs]);

        $event_daten = DB::table('event')->where('event_id', $request->eventid)->first();
        $event_hash = $event_daten -> event_hash;
        return redirect('songs/'.$event_hash);
    }



}
