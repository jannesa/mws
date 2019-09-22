@extends('layout.mainlayout')

@section('title', 'Login')

@section('content')

    <link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">


    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">

                        <h5 class="card-title text-center">Das Event mit der ID "{{$linkhash}}" existiert nicht! </h5>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
