@extends('layout.mainlayout')

@section('title', 'Login')

@section('content')

       <div class="album text-muted">
        <div class="container">
            <div class="row">
                <h1>Events</h1>
                <div class="container">
                    <a class="btn btn-primary" href="{!! url('events_erstellen') !!}">&nbsp;Event erstellen</a>


                @if(count($events)>0)
                    @foreach($events as $event )

                        <ul class="list-group list-unstyled">
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

                                <li class="list-group-item">

                                    <a target="_blank"  href="{{"guest/".$event->event_hash}}" >Event-Link</a>

                                    <button data-clipboard-action="copy" data-clipboard-target="#{{$event->event_hash}}" type="button" class="copyButton">Copy</button>

                                    <span style="position: absolute; top: -2000px; left: -2000px;" id="{{$event->event_hash}}">{{url("guest/".$event->event_hash)}}</span>
                                </li>


                                <p type="hidden" name="_token" value=" {{ csrf_token() }}">
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

@section('script')
<script>


    $(document).ready(function(){

        var clipboard = new ClipboardJS('.copyButton');


        clipboard.on('success', function(e) {
            console.log(e);
        });

        clipboard.on('error', function(e) {
            console.log(e);
        });
    });


</script>

@endsection
