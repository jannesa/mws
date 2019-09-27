<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DynamicPDFController extends Controller
{

    function get_song_data($eId)
    {
        $song_data = DB::table('song_wuensche')
            ->where('event_id', $eId)
            ->get();
        return $song_data;
    }

    function pdf(Request $request)
    {
        $eId= $request->id;
        error_log($eId);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_song_data_to_html($eId));
        return $pdf->stream();
    }

    function convert_song_data_to_html($eId)
    {
        $song_data = $this->get_song_data($eId);
        $output = '
     <h3 align="center">Songwünsche Export</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
    <th style="border: 1px solid; padding:12px;" width="20%">Titel</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Interpret</th>
    <th style="border: 1px solid; padding:12px;" width="15%">Ranking</th>
    <th style="border: 1px solid; padding:12px;" width="15%">Uhrzeit</th>
   </tr>
     ';
        foreach($song_data as $song)
        {
            $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$song->song_titel.'</td>
       <td style="border: 1px solid; padding:12px;">'.$song->song_interpret.'</td>
       <td style="border: 1px solid; padding:12px;">'.$song->ranking.'</td>
       <td style="border: 1px solid; padding:12px;">'.$song->uhrzeit.'</td>
      </tr>
      ';
        }
        $output .= '</table>';
        return $output;
    }
}
