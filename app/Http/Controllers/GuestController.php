<?php

namespace App\Http\Controllers;

use App\Event;
use App\SongWunsch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class guestController extends Controller
{

    public function index($link_hash)
    {
        $event_daten = DB::table('event')->where('event_hash', $link_hash)->first();
        if($event_daten){
            return view('guests')->with('event_daten', $event_daten);
        }
        else{
            return view('guests_no_event')->with('linkhash', $link_hash);
        }
    }


    public function addSong(Request $request)
    {
        $validate = false;
        $wartezeit = 300;
        $anz_wuensche = 5;
        //Limit-Spam-System
        $session_counter = Session::get('counter');
        $session_first_wish_time = Session::get('first_wish_time');

        // Initialisierung, falls SessId noch nichts gewünscht hat
        if($session_counter == null){
            Session::put('counter', 0);
            Session::put('first_wish_time', date('H:i'));
            $session_first_wish_time = Session::get('first_wish_time');
        }

        //Schauen welcher Spam Filter aktiv ist oder ob keiner aktiv ist und Spam Values prüfen....
        $spamfilter = $request['event_spam'];

        //Kein Spam System aktiv
        if($spamfilter == 0){
            $validate = true;
        }

        //Captcha Code aktiv
        else if($spamfilter == 1){
            // validate the user-entered Captcha code when the form is submitted
            //QUELLE: https://captcha.com/doc/php/laravel-captcha.html
            $code = $request->input('CaptchaCode');
            $validate = captcha_validate($code);
        }

        //Limit aktiv
        else if($spamfilter == 2){
            //$ldate = date('Y-m-d H:i:s');

            if($session_first_wish_time){

                //Differenz berechnen und Ausgabe in Sekunden
                $start_time = explode(":", Session::get('first_wish_time'));
                $end_time = explode(":", date('H:i'));
                $start_time_stamp = mktime($start_time[0], $start_time[1], 0, 0, 0, 0);
                $end_time_stamp = mktime($end_time[0], $end_time[1], 0, 0, 0, 0);
                $time_difference = $end_time_stamp - $start_time_stamp;

                //Handling mit Counter und Zeiten
                if($time_difference >= $wartezeit){
                    Session::put('counter', 0);
                    Session::put('first_wish_time', date('H:i'));
                    $time_difference = 0;
                    $session_counter = 0;
                }
                else if($time_difference < $wartezeit && $session_counter >= $anz_wuensche){
                    $validate = false;
                }
                else if($time_difference < $wartezeit && $session_counter < $anz_wuensche){
                    $sess_count = Session::get('counter') +1 ;
                    Session::put('counter', $sess_count);
                    $validate = true;
                }
            }
        }

        // Wenn Spamfilter richtig ist
        if($validate){
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

            $song = DB::table('song_wuensche')->where('song_titel',$songtitel )->where('song_interpret', $songinterpret)-> where('event_id', $eventid)->exists();

            if($song){
                $rank = $SongWunsch::where('song_titel', $songtitel)-> where('song_interpret', $songinterpret)-> where('event_id', $eventid)
                    ->value('ranking');
                $rank++;
                $SongWunsch::where('song_titel', $songtitel)-> where('song_interpret', $songinterpret)-> where('event_id', $eventid)
                    ->update(['ranking' => $rank, 'uhrzeit' => now()]);
            }
            else{
                $SongWunsch->save();
            }
            if($spamfilter == 2){
                return redirect('guest/'.$eventhash)->with('success', 'Abgabe erfolgreich! Noch '.(($anz_wuensche-1)-$session_counter) .' Wünsche bis Wartezeit.');
            }
            else{
                return redirect('guest/'.$eventhash)->with('success', 'Abgabe erfolgreich!');
            }
        }

        //Wenn Captcha falsch eingegeben wurde
        else if($spamfilter == 1){
            return redirect()->back()->withInput($request->only('song_titel','song_interpret'))->with('invalidcaptcha', 'Falscher Captcha-Code!');
        }

        //Wenn Limit erreicht wurde
        else if($spamfilter == 2){
            return redirect()->back()->withInput($request->only('song_titel','song_interpret'))
                ->with('invalidcaptcha', 'Zeitlimit eingetreten. Warten Sie '. (($wartezeit-$time_difference)/60). ' Minuten.' );
        }
    }
}
