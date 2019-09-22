@extends('layout.mainlayout')

@section('title', 'Login')

@section('content')


    <div class="album text-muted">
        <div class="container">
            <div class="row">
                <h1>Events</h1>
                <div class="container">
                    <a class="btn btn-primary" href="{!! url('events_erstellen') !!}">&nbsp;Event erstellen</a>
                    @if($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{$message}}</p>
                        </div>
                    @endif

                    @if(count($events)>0)
                        @foreach($events as $event )

                            <ul class="list-group">
                                <br>

                                    <li class="list-group-item-dark"> Titel: {{$event->titel}}</li>
                                    <li class="list-group-item">Status: {{$event->status}}</li>
                                    <li class="list-group-item">Spamfilter: {{$event->spamfilter}}</li>
                                    <li class="list-group-item">Beschreibung: {{$event->beschreibung}}</li>

                                <a href="{{action('EventController@edit',$event['event_id'])}}" class="btn btn-secondary">Bearbeiten</a>
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
