@extends('layout.mainlayout')

@section('title', 'Login')

@section('content')

    <link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('invalidcaptcha'))
        <div class="alert alert-danger">
            {{ session('invalidcaptcha') }}
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">

                        @if($event_daten->status == 'aktive')
                            <h5 class="card-title text-center">Wünsch dir einen Song für das Event "{{$event_daten->titel}}"</h5>
                            <br>
                            @if($event_daten->beschreibung)
                                <h6 class="card-title text-left">Event-Infos: </h6>
                                <a>{{$event_daten->beschreibung}}</a>
                            @endif
                        @elseif($event_daten->status == 'inaktive')
                                <h5 class="card-title text-center">Das Event "{{$event_daten->titel}}" wurde vom Ersteller deaktiviert!</h5>
                        @endif

                        <br>
                        <br>
                        <br>
                        <form class="form-signin" method="post" action="guest">
                            @if($event_daten->status == 'aktive')
                                <div class="form-label-group">
                                    <input type="text" name="song_titel" class="form-control" placeholder="Titel" value="{{ old('song_titel') }}" required autofocus>
                                    <label for="song_titel"></label>
                                </div>
                                <div class="form-label-group">
                                    <input type="text" name="song_interpret" class="form-control" placeholder="Interpret" value="{{ old('song_interpret') }}" required>
                                    <label for="song_interpret"></label>
                                </div>
                            @elseif($event_daten->status == 'inaktive')
                                <div class="form-label-group">
                                    <input type="text" name="song_titel" class="form-control" placeholder="Titel" required autofocus disabled>
                                    <label for="song_titel"></label>
                                </div>
                                <div class="form-label-group">
                                    <input type="text" name="song_interpret" class="form-control" placeholder="Interpret" required disabled>
                                    <label for="song_interpret"></label>
                                </div>
                            @endif

                            <input type="hidden" name="_token" value=" {{ csrf_token() }}">
                            <input type="hidden" name="event_id" value=" {{$event_daten->event_id}}">
                            <input type="hidden" name="event_hash" value=" {{$event_daten->event_hash}}">
                            <input type="hidden" name="event_spam" value=" {{$event_daten->spamfilter}}">

                            @if($event_daten->status == 'aktive')

                                @if($event_daten->spamfilter == '1')
                                    {!! captcha_image_html('ExampleCaptcha') !!}
                                    <input type="text" id="CaptchaCode" name="CaptchaCode" required>
                                @endif

                               <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Wunsch abschicken</button>
                            @elseif($event_daten->status == 'inaktive')
                               <button disabled class="btn btn-outline-primary btn-block text-uppercase" type="submit">Wunsch abschicken</button>
                            @endif

                            <hr class="my-4">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
