<?php

namespace App\Http\Controllers;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\SongWuensche;
use App\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class EventController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth:user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('guests');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addSong(Request $request)
    {
        $SongWunsch = new SongWuensche();

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


    //funktionen zum erstellen, bearbeiten und co von events
    public function openEventsPage(){
        return view('events_erstellen');
    }

    public function showAllEvents(){
        $user = Auth::user();

        $events = Event::where('user_email',$user->email);

        return view('events')->with('events', $events);
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

        $events = Event::where('user_email',$email);

        return view('events')->with('events', $events);
    }

    public function editEvent(Request $request){
        return view('event_bearbeiten') ->with('event', $request['event']);
    }
}
