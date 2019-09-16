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
                                <input type="checkbox" name="status" value="aktiv"> Event aktiv
                            </div>


                            <input type="checkbox" name="spamfilter" value="1">  Spamfilter aktiv

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
