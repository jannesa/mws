@extends('layout.mainlayout')

@section('title', 'Login')

@section('content')


    <div class="album text-muted">
        <div class="container">
            <div class="row">
                <h1>Events</h1>
               <div class="container">
                <a class="btn btn-primary" href="{!! url('events_erstellen') !!}">&nbsp;Event erstellen</a>
                   <div>Hier können dann später die anderen events von den eingeloggten benutzer angezeit werden</div>
               </div>
            </div>
        </div>
    </div>
@endsection
