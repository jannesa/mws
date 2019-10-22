@extends('layout.mainlayout')

@section('title', 'Login')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5 shadow-lg border-0">
                    <div class="card-body">
                        <h5 class="card-title text-center">Event erstellen</h5>

                        @switch($user_abo_id)
                            @case(1)

                            @if($count_active >= 2 && $count_inactive >= 5)

                                <div class="alert alert-warning">Sie haben ihre maximale Anzahl an aktiven und inaktiven Events erreicht.
                                    Löschen Sie zuerst ein Event um ein neues erstellen zu können.</div>
                                <a class="btn btn-primary mb-3 mt-3 shadow" href="{!! url('events') !!}">&nbsp;Zurück zu den Events</a>

                            @else
                                <form class="form-signin" method="post" action="speichern">
                                    <div class="form-label-group">
                                        <input type="text" name="inputTitel" class="form-control" placeholder="Titel" maxlength="191" required autofocus>
                                        <label for="inputTitel">Event titel</label>
                                    </div>
                                    <div class="form-label-group">
                                        <textarea name="inputBeschreibung" class="form-control" placeholder="Infos" maxlength="500"></textarea>
                                        <label for="inputBeschreibung">Event infos</label>
                                    </div>

                                    <div class="form-label-group">
                                        @switch($user_abo_id)
                                            @case(1)

                                            @if($count_active >= 2)

                                                <div class="alert alert-warning">Sie haben ihre maximale Anzahl an aktiven Events erreicht.
                                                    Löschen Sie zuerst ein Event um ein neues erstellen zu können.</div>

                                                <input type="checkbox" name="status" value="aktive" data-toggle="tooltip" disabled> Event aktiv

                                            @else
                                                <input type="checkbox" name="status" value="aktive" data-toggle="tooltip" title="Für inaktive Events können keine Wünsche abgegeben werden!" checked> Event aktiv

                                            @endif

                                            @break
                                            @case(2)

                                            @if($count_active >= 10)

                                                <div class="alert alert-warning">Sie haben ihre maximale Anzahl an aktiven Events erreicht.
                                                    Löschen Sie zuerst ein Event um ein neues erstellen zu können.</div>

                                                <input type="checkbox" name="status" value="aktive" data-toggle="tooltip" disabled> Event aktiv

                                            @else
                                                <input type="checkbox" name="status" value="aktive" data-toggle="tooltip" title="Für inaktive Events können keine Wünsche abgegeben werden!" checked> Event aktiv

                                            @endif

                                            @break
                                            @case(3)

                                            <input type="checkbox" name="status" value="aktive" data-toggle="tooltip" title="Für inaktive Events können keine Wünsche abgegeben werden!" checked> Event aktiv

                                            @break
                                        @endswitch


                                    </div>
                                    <br>


                                    <fieldset>
                                        <input type="radio" id="spamaus" name="spamfilter" value="0" checked>
                                        <label for="spamaus" data-toggle="tooltip" title="Unbegrenzte Wünsche möglich!"> Spamfilter aus</label>
                                        <br>
                                        <input type="radio" id="spamcaptcha" name="spamfilter" value="1">
                                        <label for="spamcaptcha" data-toggle="tooltip" title="Gäste müssen ein Captcha Code eingeben!"> Spamfilter Captcha</label>
                                        <br>
                                        <input type="radio" id="spamlimit" name="spamfilter" value="2">
                                        <label for="spamlimit" data-toggle="tooltip" title="Fünf Wünsche im Fünf-Minuten-Zyklus möglich"> Spamfilter Limit</label>
                                    </fieldset>
                                    <br>

                                    <input type="hidden" name="_token" value=" {{ csrf_token() }}">
                                    <button class="btn btn-primary btn-block" type="submit">Event erstellen</button>

                                </form>

                            @endif

                            @break
                            @case(2)

                            @if($count_active >= 10 && $count_inactive >= 20)

                                <div class="alert alert-warning">Sie haben ihre maximale Anzahl an aktiven oder inaktiven Events erreicht.
                                    Löschen Sie zuerst ein Event um ein neues erstellen zu können.</div>

                                <a class="btn btn-primary mb-3 mt-3 shadow" href="{!! url('events') !!}">&nbsp;Zurück zu den Events</a>

                            @else
                                <form class="form-signin" method="post" action="speichern">
                                    <div class="form-label-group">
                                        <input type="text" name="inputTitel" class="form-control" placeholder="Titel" maxlength="191" required autofocus>
                                        <label for="inputTitel">Event titel</label>
                                    </div>
                                    <div class="form-label-group">
                                        <textarea name="inputBeschreibung" class="form-control" placeholder="Infos" maxlength="500"></textarea>
                                        <label for="inputBeschreibung">Event infos</label>
                                    </div>

                                    <div class="form-label-group">
                                        @switch($user_abo_id)
                                            @case(1)

                                            @if($count_active >= 2)

                                                <div class="alert alert-warning">Sie haben ihre maximale Anzahl an aktiven Events erreicht.
                                                    Löschen Sie zuerst ein Event um ein neues erstellen zu können.</div>

                                                <input type="checkbox" name="status" value="aktive" data-toggle="tooltip" disabled> Event aktiv

                                            @else
                                                <input type="checkbox" name="status" value="aktive" data-toggle="tooltip" title="Für inaktive Events können keine Wünsche abgegeben werden!" checked> Event aktiv

                                            @endif

                                            @break
                                            @case(2)

                                            @if($count_active >= 10)

                                                <div class="alert alert-warning">Sie haben ihre maximale Anzahl an aktiven Events erreicht.
                                                    Löschen Sie zuerst ein Event um ein neues erstellen zu können.</div>

                                                <input type="checkbox" name="status" value="aktive" data-toggle="tooltip" disabled> Event aktiv

                                            @else
                                                <input type="checkbox" name="status" value="aktive" data-toggle="tooltip" title="Für inaktive Events können keine Wünsche abgegeben werden!" checked> Event aktiv

                                            @endif

                                            @break
                                            @case(3)

                                            <input type="checkbox" name="status" value="aktive" data-toggle="tooltip" title="Für inaktive Events können keine Wünsche abgegeben werden!" checked> Event aktiv

                                            @break
                                        @endswitch


                                    </div>
                                    <br>


                                    <fieldset>
                                        <input type="radio" id="spamaus" name="spamfilter" value="0" checked>
                                        <label for="spamaus" data-toggle="tooltip" title="Unbegrenzte Wünsche möglich!"> Spamfilter aus</label>
                                        <br>
                                        <input type="radio" id="spamcaptcha" name="spamfilter" value="1">
                                        <label for="spamcaptcha" data-toggle="tooltip" title="Gäste müssen ein Captcha Code eingeben!"> Spamfilter Captcha</label>
                                        <br>
                                        <input type="radio" id="spamlimit" name="spamfilter" value="2">
                                        <label for="spamlimit" data-toggle="tooltip" title="Fünf Wünsche im Fünf-Minuten-Zyklus möglich"> Spamfilter Limit</label>
                                    </fieldset>
                                    <br>

                                    <input type="hidden" name="_token" value=" {{ csrf_token() }}">
                                    <button class="btn btn-primary btn-block" type="submit">Event erstellen</button>

                                </form>
                            @endif

                            @break
                            @case(3)

                            <form class="form-signin" method="post" action="speichern">
                                <div class="form-label-group">
                                    <input type="text" name="inputTitel" class="form-control" placeholder="Titel" maxlength="191" required autofocus>
                                    <label for="inputTitel">Event titel</label>
                                </div>
                                <div class="form-label-group">
                                    <textarea name="inputBeschreibung" class="form-control" placeholder="Infos" maxlength="500"></textarea>
                                    <label for="inputBeschreibung">Event infos</label>
                                </div>

                                <div class="form-label-group">
                                    @switch($user_abo_id)
                                        @case(1)

                                        @if($count_active >= 2)

                                            <div class="alert alert-warning">Sie haben ihre maximale Anzahl an aktiven Events erreicht.
                                                Löschen Sie zuerst ein Event um ein neues erstellen zu können.</div>

                                            <input type="checkbox" name="status" value="aktive" data-toggle="tooltip" disabled> Event aktiv

                                        @else
                                            <input type="checkbox" name="status" value="aktive" data-toggle="tooltip" title="Für inaktive Events können keine Wünsche abgegeben werden!" checked> Event aktiv

                                        @endif

                                        @break
                                        @case(2)

                                        @if($count_active >= 10)

                                            <div class="alert alert-warning">Sie haben ihre maximale Anzahl an aktiven Events erreicht.
                                                Löschen Sie zuerst ein Event um ein neues erstellen zu können.</div>

                                            <input type="checkbox" name="status" value="aktive" data-toggle="tooltip" disabled> Event aktiv

                                        @else
                                            <input type="checkbox" name="status" value="aktive" data-toggle="tooltip" title="Für inaktive Events können keine Wünsche abgegeben werden!" checked> Event aktiv

                                        @endif

                                        @break
                                        @case(3)

                                        <input type="checkbox" name="status" value="aktive" data-toggle="tooltip" title="Für inaktive Events können keine Wünsche abgegeben werden!" checked> Event aktiv

                                        @break
                                    @endswitch


                                </div>
                                <br>


                                <fieldset>
                                    <input type="radio" id="spamaus" name="spamfilter" value="0" checked>
                                    <label for="spamaus" data-toggle="tooltip" title="Unbegrenzte Wünsche möglich!"> Spamfilter aus</label>
                                    <br>
                                    <input type="radio" id="spamcaptcha" name="spamfilter" value="1">
                                    <label for="spamcaptcha" data-toggle="tooltip" title="Gäste müssen ein Captcha Code eingeben!"> Spamfilter Captcha</label>
                                    <br>
                                    <input type="radio" id="spamlimit" name="spamfilter" value="2">
                                    <label for="spamlimit" data-toggle="tooltip" title="Fünf Wünsche im Fünf-Minuten-Zyklus möglich"> Spamfilter Limit</label>
                                </fieldset>
                                <br>

                                <input type="hidden" name="_token" value=" {{ csrf_token() }}">
                                <button class="btn btn-primary btn-block" type="submit">Event erstellen</button>

                            </form>

                            @break
                        @endswitch





                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
