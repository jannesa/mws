@extends('layout.mainlayout')

@section('title', 'Login')

@section('content')

    <h1>Event bearbeiten</h1>

    <ul class="list-group">
        <br>
        <form method="post" action="event_bearbeiten">

            <input type="hidden" name="_token" value=" {{ csrf_token() }}">
            <button class="btn btn-lg btn-primary btn-block"  type="submit">Löschen</button>

            <li class="list-group-item-dark"> Titel: {{$event->titel}}</li>
            <li class="list-group-item">Status: {{$event->status}}</li>
            <li class="list-group-item">Spamfilter: {{$event->spamfilter}}</li>
            <li class="list-group-item">Beschreibung: {{$event->beschreibung}}</li>
        </form>
    </ul>
