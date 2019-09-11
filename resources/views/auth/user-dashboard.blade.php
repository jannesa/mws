@extends('layout.mainlayout')

@section('title', 'Dashboard')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif



    <div class="album text-muted">
        <div class="container">
            <div class="row">
                <h1> @if( Auth::guard('user')->check())
                        Willkommen

                        {{{ Auth::user()->vorname }}}

                    @endif
                </h1>
            </div>
        </div>
    </div>


@endsection
