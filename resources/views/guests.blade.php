@extends('layout.mainlayout')

@section('title', 'Login')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Wünsch dir einen Song</h5>
                        <form class="form-signin">
                            @csrf
                            <div class="form-label-group">
                                <input type="text" id="inputSongname" class="form-control" placeholder="Songname" required autofocus>
                                <label for="inputSongname"></label>
                            </div>
                            <div class="form-label-group">
                                <input type="text" id="inputInterpret" class="form-control" placeholder="Interpret" required>
                                <label for="inputInterpret"></label>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Wunsch abschicken</button>
                            <hr class="my-4">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
