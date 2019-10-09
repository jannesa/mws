<?php

namespace App\Http\Controllers;

use App\Abo;
use App\SongWunsch;
use App\User;
use App\Event;

use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


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

        $validation = $this->validator($request->all());

        if ($validation->fails())  {

            return redirect()->back()->withInput()->withErrors($validation->errors());
        }


        $vorname_new = $request->input('vorname');
        $nachname_new = $request->input('nachname');
        $email_new = $request->input('email');
        $abotype_new = $request->input('abotype');
        $user_id = $request->input('user_id');



        $abotype_old = DB::table("users")->select("abo_id")->where("id", $user_id)->first()->abo_id;
        $email_old = DB::table("users")->select("email")->where("id", $user_id)->first()->email;



        // wenn alles gut is user finden und speichern
        $user = UserModel::find($email_old);

        //dd($user);

        $user->vorname = $vorname_new;
        $user->nachname = $nachname_new;
        $user->email = $email_new;


        $user->save();


        if($abotype_old == $abotype_new ) {

            return redirect()->route('user.dashboard')->with('success', 'Daten wurden geändert!');
            // Daten einfach speichern und zurück zum Dashboard leiten


        } else {

            // wenn was anderes gewählt wurde zur Bezahlseite weiterleiten
            return view('payment')->with('success', 'Daten wurden geändert, passen sie hier ihre zahlungsdaten an!')->with("abotype_new", $abotype_new);

        }

    }

    protected function validator(array $data)
    {
        $messages = [

            'vorname.required' => 'Es wurde kein Vorname angegeben!',
            'vorname.max' => 'Der Vorname ist zu lang!',
            'vorname.string' => 'Der Vorname muss eine Zeichenkette sein!',
            'nachname.required' => 'Es wurde keine Nachname angegeben!',
            'nachname.max' => 'Der Vorname ist zu lang!',
            'nachname.string' => 'Der Vorname muss eine Zeichenkette sein!',
            'email.required' => 'Es wurde keine E-Mail angegeben!',
            'email' => 'Das ist keine gültige E-Mail Adresse!',
            'email.unique' => ' Diese E-Mail-Adresse wurde schon verwendet!'
        ];

        return Validator::make($data, [
            'vorname' => ['required', 'string', 'max:25'],
            'nachname' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:50'],
        ], $messages);


    }
}
