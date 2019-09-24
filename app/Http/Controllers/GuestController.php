<?php

namespace App\Http\Controllers;

use App\Event;
use App\SongWunsch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Session;
use Illuminate\Validation\ValidationException;

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
        if($event_daten){
            return view('guests')->with('event_daten', $event_daten);
        }
        else{
            return view('guests_no_event')->with('linkhash', $link_hash);
        }


    }



    public function addSong(Request $request)
    {
        //Schauen welcher Spam Filter aktiv ist oder ob keiner aktiv ist.
        $spamfilter = $request['event_spam'];
        if($spamfilter == 0){
            $validate = true;
        }
        else if($spamfilter == 1){
            // validate the user-entered Captcha code when the form is submitted
            //QUELLE: https://captcha.com/doc/php/laravel-captcha.html
            $code = $request->input('CaptchaCode');
            $validate = captcha_validate($code);
        }
        else if($spamfilter == 2){
            //Hier wird das Zeit-Limit-System eingebaut!
            $validate = true;
        }


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

            $song = DB::table('song_wuensche')->where('song_titel',$songtitel )->where('song_interpret', $songinterpret)->exists();


            if($song){

                $rank = $SongWunsch::where('song_titel', $songtitel)-> where('song_interpret', $songinterpret)
                    ->value('ranking');

                $rank++;

                error_log($rank);

                $SongWunsch::where('song_titel', $songtitel)-> where('song_interpret', $songinterpret)
                    ->update(['ranking' => $rank]);

            }
            else{
                $SongWunsch->save();
            }
            return redirect('guest/'.$eventhash)->with('success', 'Abgabe erfolgreich!');
        }
        else{
            return redirect()->back()->withInput($request->only('song_titel','song_interpret'))->with('invalidcaptcha', 'Falscher Captcha-Code!');
        }
    }
}
