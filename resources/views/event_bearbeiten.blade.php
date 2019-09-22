@extends('layout.mainlayout')

@section('title', 'Login')

@section('content')

    <h1>Event bearbeiten</h1>

    <form method="post" action="{{action('EventController@update',$event_id)}}">

        <input type="hidden" name="_token" value=" {{ csrf_token() }}">

        <div class="form-group">
            <input type="text" name="titel" class="form-control" value="{{$event->titel}}" placeholder="Titel eingeben">
            <label for="inputTitel">Event Titel</label>
        </div>
        <div class="form-group">
            <input type="text" name="beschreibung" class="form-control" value="{{$event->beschreibung}}" placeholder="Beschreibung eingeben">
            <label for="inputTitel">Event infos</label>
        </div>

        <div class="form-group">
            <input class="btn btn-primary text-uppercase" type="submit" value="Edit">
        </div>

    </form>
