<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Event;
use Illuminate\Support\Facades\Auth;


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

        if($request['spamfilter']){
            $event_spamfilter = '1';
        }else{
            $event_spamfilter = '0';
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

        $Event->save();

        $events = Event::where('user_email',$email)->get();

        return view('events')->with('events', $events->reverse());
    }

    public function editEvent(Request $request){
        return view('event_bearbeiten') ->with('event', $request['event']);
    }
}
