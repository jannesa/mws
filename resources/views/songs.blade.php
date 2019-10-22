@extends('layout.mainlayout')

@section('title', 'Dashboard')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif



<div class="container">
    <div class="row">
        <div class="col-md-12">

            <a class="btn btn-primary mb-3 mt-3 shadow" href="{!! url('events') !!}">&nbsp;Zurück zu den Events</a>
            <br />
            <h3 align="center">Songwünsche für das Event {{$event_name}}</h3>
            <br />

            @if(isset($songs[0]['event_id']))
                <form method="post" action="{{ route('pdf.erstellen') }}" target="_blank">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="col">
                        <input type="hidden" class="form-control" name="id" value="{{$songs[0]['event_id']}}">
                    </div>
                    <button class="btn btn-secondary" type="submit" >Als PDF exportieren</button>
                </form>
            @endif

            <table id="myTable2" class="table table-hover table-striped table-bordered">
                <tr>
                    <th onclick="sortTable(0)">Songtitel</th>
                    <th onclick="sortTable(1)">Songinterpret</th>
                    <th onclick="sortTable(2)">Ranking</th>
                    <th onclick="sortTable(3)">Uhrzeit</th>
{{--                    <th onclick="sortTable(4)">Status</th>--}}
                    <th>Status</th>
                    <th>Löschen</th>
                </tr>

                @foreach($songs as $song)
                    <tr>

                        <td>{{$song['song_titel']}}</td>
                        <td>{{$song['song_interpret']}}</td>
                        <td>{{$song['ranking']}}</td>
                        <td>{{$song['uhrzeit']}}</td>

                        <td>
                            <form method="post" action="{{ route('song.aendern') }}" >
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="col">
                                    <input type="hidden" class="form-control" name="titel" value="{{$song['song_titel']}}">
                                    <input type="hidden" class="form-control" name="interpret" value="{{$song['song_interpret']}}">
                                    <input type="hidden" class="form-control" name="eventid" value="{{$song['event_id']}}">
                                    @if($song['gespielt'] == 0)
                                        <input type="hidden" class="form-control" name="gespielt" value="1">
                                    @elseif($song['gespielt'] == 1)
                                        <input type="hidden" class="form-control" name="gespielt" value="0">
                                    @endif
                                </div>
                                @if($song['gespielt'] == 0)
                                    <button class="btn btn-warning" type="submit">Noch nicht gespielt</button>
                                @elseif($song['gespielt'] == 1)
                                    <button class="btn btn-success" type="submit">Bereits gespielt</button>
                                @endif
                            </form>
                        </td>

                        <td>
                            <form method="post" action="{{ route('song.loeschen') }}" >
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="col">
                                    <input type="hidden" class="form-control" name="titel" value="{{$song['song_titel']}}">
                                    <input type="hidden" class="form-control" name="interpret" value="{{$song['song_interpret']}}">
                                    <input type="hidden" class="form-control" name="eventid" value="{{$song['event_id']}}">
                                </div>
                                <button class="btn btn-danger" type="submit">Löschen</button>
                            </form>
                        </td>

                    </tr>
                @endforeach

            </table>
        </div>
    </div>
</div>


@endsection

<script>
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("myTable2");
        switching = true;
        // Set the sorting direction to ascending:
        dir = "asc";
        /* Make a loop that will continue until
        no switching has been done: */
        while (switching) {
            // Start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /* Loop through all table rows (except the
            first, which contains table headers): */
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching:
                shouldSwitch = false;
                /* Get the two elements you want to compare,
                one from current row and one from the next: */
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                /* Check if the two rows should switch place,
                based on the direction, asc or desc: */
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                /* If a switch has been marked, make the switch
                and mark that a switch has been done: */
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                // Each time a switch is done, increase this count by 1:
                switchcount ++;
            } else {
                /* If no switching has been done AND the direction is "asc",
                set the direction to "desc" and run the while loop again. */
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>

