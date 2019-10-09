<?php

namespace App\Http\Controllers;

use App\Abo;
use App\SongWunsch;
use App\User;
use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {

        $user_data = Auth::user();

        $id = $user_data->abo_id;

        $abo = Abo::where('abo_id',$id)->first();


        return view('/auth/user-dashboard')->with('data', $user_data)->with('abo_type', $abo->abo_typ);

    }

    public function editUserData(Request $request){

        $vorname_new = $request->input('vorname');
        $nachname_new = $request->input('nachname');

        $user_id = $request->input('user_id');

        $abotype_old = DB::table("users")->select("abo_id")->where("id", $user_id)->first()->abo_id;
        $abotype_new = $request->input('abotype');



        if($abotype_old == $abotype_new ) {


            $user = User::find($user_id);

            $user->vorname = $vorname_new;
            $user->nachname = $nachname_new;

            $user->save();

            return redirect()->route('user.dashboard')->with('success', 'Daten wurden geändert!');
            // Daten einfach speichern und zurück zum Dashboard leiten


        } else {

            // wenn was anderes gewählt wurde zur Bezahlseite weiterleiten
            return view('payment')->with("abotype_new", $abotype_new);

        }

    }


}
