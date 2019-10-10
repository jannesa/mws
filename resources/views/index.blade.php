@extends('layout.mainlayout')

@section('title', 'Startseite')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <section class="jumbotron text-center startpage-header">
        <div class="container">
            <h1 class="jumbotron-heading text-light">Willkommen beim MusikWunschSystem</h1>
            <p class="lead text-light">Musikwünsche in Echtzeit für Ihre Party! Ihre Gäste entscheiden was gespielt wird!</p>
            <p>

                <a class="btn btn-primary" href="{{ route('user.auth.login') }}">&nbsp;Login</a>
                <a class="btn btn-success" href="{{ route('user.auth.register') }}">&nbsp;Registrieren</a>

            </p>
        </div>
    </section>
    <div class="album text-muted">
        <div class="container">
            <div class="row">

                <p>Mit unserem Musik-Wunsch-System ist es für Jeden ein Kinderspiel, die Musikwünsche der Gäste zu sammeln und auszuwerten.
                    Unsere Zielgruppe sind einfache Privatpersonen, die eine Geburtstagsfeier feiern, DJs die Musikwünsche des Publikums sammeln möchten bis hin zum Großveranstalter der z.B.
                    eine Analyse der zu spielenden Musik benötigt. Was ist zu tun? Loggen Sie sich im MWS Dashboard ein, erstellen Sie ein Event, versenden Sie den automatisch erzeugten Link an Ihre Gäste und überlassen Sie uns das Sammeln der Musikwünsche!
                </p>
            </div>
        </div>
    </div>


@endsection
