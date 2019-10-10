@extends('layout.mainlayout')

@section('title', 'Bezahlung')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif



    <div class="container">

        <div class="row">

            <div class="col-sm-12">
                <h1>Bezahlung ändern</h1>

                <p>
                    Sie haben sich für

                        @switch($abotype_new)
                            @case(1)
                            Free
                            @break

                            @case(2)
                            Pro
                            @break

                            @case(3)
                            Premium
                            @break

                            @default

                        @endswitch

                    entschieden
                </p>

                @if($abotype_new == 1)
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5 ">
                    <p>Für Abo-Typ Free ist keine Zahlung notwendig!</p>

                    <button class="btn btn-primary shadow" type="button"> Speichern und zurück zum Dashboard! </button>
                        </div>
                    </div>

                @else
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">

                        <ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#nav-tab-card">
                                    <i class="fa fa-credit-card"></i> Kreditkarte</a></li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#nav-tab-paypal">
                                    <i class="fab fa-paypal"></i>  Paypal</a></li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
                                    <i class="fa fa-university"></i> Überweisung</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="nav-tab-card">
                                <p class="alert alert-info">Bitte geben sie Ihre Daten ein</p>
                                <form role="form">
                                    <div class="form-group">
                                        <label for="username">Vollständiger Name</label>
                                        <input type="text" class="form-control" name="username" placeholder="" required="">
                                    </div>

                                    <div class="form-group">
                                        <label for="cardNumber">Kartennummer</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="cardNumber" placeholder="">
                                            <div class="input-group-append">
                                                <span class="input-group-text text-muted">
                                                    <i class="fab fa-cc-visa"></i>   <i class="fab fa-cc-amex"></i>  
                                                    <i class="fab fa-cc-mastercard"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label><span class="hidden-xs">Ablaufdatum</span> </label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" placeholder="MM" name="">
                                                    <input type="number" class="form-control" placeholder="YY" name="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i></label>
                                                <input type="number" class="form-control" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="subscribe btn btn-primary shadow" type="button"> bestätigen  </button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="nav-tab-paypal">
                                <p>Mit Paypal bezahlen</p>
                                <p class="alert alert-info">Sie werden zu einer externen Seite weitergeleitet</p>
                                <p>
                                    <button type="button" class="btn btn-primary shadow"> <i class="fab fa-paypal"></i> Weiter zu Paypal  </button>
                                </p>

                            </div>
                            <div class="tab-pane fade" id="nav-tab-bank">
                                <p>Unsere Bankdaten:</p>
                                <dl class="param">
                                    <dt>BANK: </dt>
                                    <dd> Hamburger Sparkasse </dd>
                                </dl>
                                <dl class="param">
                                    <dt>Kontonummer: </dt>
                                    <dd> 12345678912345</dd>
                                </dl>
                                <dl class="param">
                                    <dt>IBAN: </dt>
                                    <dd> 123456789</dd>
                                </dl>
                                <button class="subscribe btn btn-primary shadow" type="button"> bestätigen  </button>
                            </div>
                        </div>

                    </div>
                </div>

                @endif

            </div>
        </div>

    </div>




@endsection
