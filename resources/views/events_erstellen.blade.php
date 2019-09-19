@extends('layout.mainlayout')

@section('title', 'Login')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Event erstellen</h5>

                        <form class="form-signin" method="post" action="speichern">
                            <div class="form-label-group">
                                <input type="text" name="inputTitel" class="form-control" placeholder="Titel" required autofocus>
                                <label for="inputTitel">Event titel</label>
                            </div>
                            <div class="form-label-group">
                                <input type="text" name="inputBeschreibung" class="form-control" placeholder="Infos" required autofocus>
                                <label for="inputTitel">Event infos</label>
                            </div>

                            <div class="form-label-group">
                                <input type="checkbox" name="status" value="aktiv" checked> Event aktiv
                            </div>
                            <br>


{{--                            <input type="checkbox" name="spamfilter" value="1">  Spamfilter aktiv--}}


                            <fieldset>
                                <input type="radio" id="spamaus" name="spamfilter" value="0">
                                <label for="spamaus"> Spamfilter aus</label>
                                <br>
                                <input type="radio" id="spamcaptcha" name="spamfilter" value="1">
                                <label for="spamcaptcha"> Spamfilter Captcha</label>
                                <br>
                                <input type="radio" id="spamlimit" name="spamfilter" value="2">
                                <label for="spamlimit"> Spamfilter Limit</label>
                            </fieldset>
                            <br>

                            <input type="hidden" name="_token" value=" {{ csrf_token() }}">
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">erstellen</button>
                            <hr class="my-4">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
