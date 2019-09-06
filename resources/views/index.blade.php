@extends('layout.mainlayout')

@section('title', 'Startseite')

@section('content')
    <section class="jumbotron text-center" style="background-image: url('/img/header_background.jpg');background-size: cover;background-position: bottom;">
        <div class="container">
            <h1 class="jumbotron-heading text-light">Willkommen beim MusikWunschSystem</h1>
            <p class="lead text-light">Musikwünsche in Echtzeit für Ihre Party! Ihre Gäste entscheiden was gespielt wird!</p>
            <p>

                <a class="btn btn-primary" href="{{ route('user.auth.login') }}">&nbsp;Login</a>

                <a href="#" class="btn btn-secondary">sonstige aktion</a>
            </p>
        </div>
    </section>
    <div class="album text-muted">
        <div class="container">
            <div class="row">

                <p>Mit unserem Musik-Wunsch-System wird es für Jedermann/ Frau ein Kinderspiel, die Musikwünsche der Gäste zu sammeln und auszuwerten.
                    Unsere Zielgruppe sind einfache Privatpersonen, die eine Geburtstagsfeier feiern, DJs die Musikwünsche des Publikums sammeln möchten bis hin zum Großveranstalter der z.B.
                    eine Analyse der zu spielenden Musik benötigt. Was ist zu tun? Loggen Sie sich im MWS Dashboard ein, erstellen Sie ein Event, versenden Sie den automatisch erzeugten Link an Ihre Gäste und überlassen Sie uns das Sammeln der Musikwünsche!
                </p>
            </div>
        </div>
    </div>
@endsection
