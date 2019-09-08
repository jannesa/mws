@extends('layout.mainlayout')

@section('title', 'Login')

@section('content')


    @auth('admin')

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Adminregistrierung</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.register.post') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Vorname</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('vorname') ? ' is-invalid' : '' }}" name="vorname" value="{{ old('vorname') }}" required autofocus>

                                    @if ($errors->has('vorname'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('vorname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nachname</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('nachname') ? ' is-invalid' : '' }}" name="nachname" value="{{ old('nachname') }}" required autofocus>

                                    @if ($errors->has('nachname'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nachname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Addresse') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <div class="alert alert-info">
                                        Das Passwort muss aus mindestens 8 Zeichen bestehen (anpassen...)
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Passwort</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Passwort wiederholen</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Jetzt registrieren</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endauth

    @guest('admin')

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">nicht authorisiert!</div>
                </div>
            </div>
        </div>
    </div>

    @endguest

@endsection
