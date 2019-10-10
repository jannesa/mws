@extends('layout.mainlayout')

@section('title', 'Startseite')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <section class="masthead masthead-page mb-5 text-center startpage-header">
        <svg style="pointer-events: none" class="wave" width="100%" height="50px" preserveAspectRatio="none"
             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1920 75">
            <defs>
                <style>
                    .a {
                        fill: none;
                    }

                    .b {
                        clip-path: url(#a);
                    }

                    .c,
                    .d {
                        fill: #f9f9fc;
                    }

                    .d {
                        opacity: 0.5;
                        isolation: isolate;
                    }
                </style>
                <clipPath id="a">
                    <rect class="a" width="1920" height="75"></rect>
                </clipPath>
            </defs>
            <title>wave</title>
            <g class="b">
                <path class="c"
                      d="M1963,327H-105V65A2647.49,2647.49,0,0,1,431,19c217.7,3.5,239.6,30.8,470,36,297.3,6.7,367.5-36.2,642-28a2511.41,2511.41,0,0,1,420,48"></path>
            </g>
            <g class="b">
                <path class="d"
                      d="M-127,404H1963V44c-140.1-28-343.3-46.7-566,22-75.5,23.3-118.5,45.9-162,64-48.6,20.2-404.7,128-784,0C355.2,97.7,341.6,78.3,235,50,86.6,10.6-41.8,6.9-127,10"></path>
            </g>
            <g class="b">
                <path class="d"
                      d="M1979,462-155,446V106C251.8,20.2,576.6,15.9,805,30c167.4,10.3,322.3,32.9,680,56,207,13.4,378,20.3,494,24"></path>
            </g>
            <g class="b">
                <path class="d"
                      d="M1998,484H-243V100c445.8,26.8,794.2-4.1,1035-39,141-20.4,231.1-40.1,378-45,349.6-11.6,636.7,73.8,828,150"></path>
            </g>
        </svg>


        <h1 class="jumbotron-heading text-light">Willkommen beim MusikWunschSystem</h1>
         <p class="lead text-light">Musikwünsche in Echtzeit für Ihre Party! Ihre Gäste entscheiden was gespielt
                wird!</p>

    </section>

    <div class="container mb-5">
        <div class="row">
            <div class="col-12 text-center my-5">
                <a class="btn btn-primary btn-lg shadow" href="{{ route('user.auth.login') }}"> &nbsp;Login</a>
                <a class="btn btn-success btn-lg shadow" href="{{ route('user.auth.register') }}">&nbsp;Registrieren</a>

            </div>
            <div class="col-12">

                <h5 class="text-primary">Mit unserem Musik-Wunsch-System ist es für Jeden ein Kinderspiel die Musikwünsche der Gäste zu
                    sammeln und auszuwerten.
                    Was ist zu tun? Loggen Sie sich im MWS Dashboard
                    ein, erstellen Sie ein Event, versenden Sie den automatisch erzeugten Link an Ihre Gäste und
                    überlassen Sie uns das Sammeln der Musikwünsche!
                </h5>
            </div>
        </div>

        <h3 class="my-4">Für jeden Anlass</h3>

        <div class="card-deck">
            <div class="card shadow-lg border-0">
                <div class="card-body">
                    <h2 class="card-title"> <i class="fas fa-birthday-cake"></i> Geburtstage</h2>
                    <p class="card-text">Auch geeignet für einfache Privatpersonen, die eine Geburtstagsfeier feiern. Testen Sie unseren Free-Account!</p>
                </div>
            </div>
            <div class="card shadow-lg border-0">
                <div class="card-body">
                    <h2 class="card-title"><i class="fas fa-headphones"></i> DJ's</h2>
                    <p class="card-text">... die Musikwünsche des Publikums sammeln möchten</p>
                </div>
            </div>
            <div class="card shadow-lg border-0">
                <div class="card-body">
                    <h2 class="card-title"><i class="fas fa-glass-cheers"></i> Veranstaltungen</h2>
                    <p class="card-text">Vom Klein- bis hin zum Großveranstalter der z.B.
                        eine Analyse der zu spielenden Musik benötigt.</p>
                </div>
            </div>
        </div>
    </div>



@endsection
