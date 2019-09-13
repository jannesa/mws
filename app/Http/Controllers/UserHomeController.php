<?php

namespace App\Http\Controllers;

use App\SongWunsch;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

        $songs = SongWunsch::all()->toArray();

        return view('/auth/user-dashboard',['songs' => $songs]);
        //return view('/auth/user-dashboard');
    }
}
