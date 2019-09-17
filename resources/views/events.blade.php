@extends('layout.mainlayout')

@section('title', 'Login')

@section('content')

    <p hidden id="p2">{{"http://127.0.0.1:8000/guestss/"}}</p>
    <button onclick="copyToClipboard('#p2')">Copy</button>


    <div class="album text-muted">
        <div class="container">
            <div class="row">
                <h1>Events</h1>
                <div class="container">
                    <a class="btn btn-primary" href="{!! url('events_erstellen') !!}">&nbsp;Event erstellen</a>


                @if(count($events)>0)
                    @foreach($events as $event )

                        <ul class="list-group">
                            <br>

                            <form method="post" action="event_bearbeiten">

                                <li class="list-group-item-dark"> Titel: {{$event->titel}}</li>
                                <li class="list-group-item">Status: {{$event->status}}</li>

                                @if($event->spamfilter ==0)
                                    <li class="list-group-item">Spamfilter: {{"off"}}</li>
                                @elseif($event->spamfilter ==1)
                                    <li class="list-group-item">Spamfilter: {{"on"}}</li>
                                @endif


                                <li class="list-group-item">Beschreibung: {{$event->beschreibung}}</li>
                                    {{$temp = "http://127.0.0.1:8000/guest/".$event->event_hash}}



                                <li class="list-group-item">  <a target="_blank"  href="{{"guest/".$event->event_hash}}" >Event-Link</a>
                                    <p hidden id="tocopy">{{"http://127.0.0.1:8000/guest/".$event->event_hash}}</p>
                                    <button type="button" onclick="copyToClipboard('tocopy')">Copy</button>
                                </li>


                                <input type="hidden" name="_token" value=" {{ csrf_token() }}">
                                <button class="btn btn-lg btn-secondary btn-block"  type="submit">Bearbeiten</button>

                            </form>
                        </ul>
                    @endforeach
                 @else
                    <div>Sie haben noch keine Events erstellt</div>
                 @endif
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    Quelle: https://codepen.io/shaikmaqsood/pen/XmydxJ
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }

    // function copyToClipboard(elementID) {
    //     var aux = document.createElement("input");
    //     aux.setAttribute('Value',document.getElementById(elementID).innerHTML);
    //     document.body.appendChild(aux);
    //     aux.select();
    //     document.execCommand("copy");
    //     document.body.removeChild(aux);
    //
    //
    // }

</script>

