<?php

namespace App\Http\Controllers;

use App\Event;
use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AdminHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $users = UserModel::orderBy('id','desc')->get();


       /* $usersevents = DB::table('users')
            ->join('event', 'users.email' ,'=', 'event.user_email')
            ->select('users.*' , DB::raw('count(event.event_id) as anzahl_events'))
            ->groupBy('users.id')
            ->get();*/

        //dd($usersevents);

        return view('/auth/admin-dashboard')->with('users', $users);
    }



    public function deleteUser(Request $request){

        $user_id = $request->input('id');


        $user = DB::table('users')->where('id', $user_id);

        $user->delete();

        return redirect()->back()->with('success','Benutzer gelöscht');

    }
}
