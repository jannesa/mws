<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\SongWuensche;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Symfony\Component\Console\Tests\Input\InputTest;

class EventController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
            //error_log($rank);
            $SongWunsch::where('song_titel', $songtitel)
                ->update(['ranking' => $rank]);
        }
        else{
            $SongWunsch->save();
        }
        return view('guests');
    }
}
