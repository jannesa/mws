@extends('layout.mainlayout')

@section('title', 'User Registrierung')

@section('content')




    <div class="container">
        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-sm-12">
                <div class="card shadow-lg border-0">
                    <div class="card-header">User Registrierung</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.register.post') }}">
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
                                    <input id="name" type="text" class="form-control{{ $errors->has('nachname') ? ' is-invalid' : '' }}" name="nachname" value="{{ old('nachname') }}" required>

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

                            <div class="row mb-3 text-center">
                                <div class="col-sm-12 col-md-4">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h4 class="my-0 font-weight-normal">Free</h4>
                                        </div>
                                        <div class="card-body">
                                            <h1 class="card-title pricing-card-title">€0 <small class="text-muted">/ Monat</small></h1>
                                            <ul class="list-unstyled mt-3 mb-4">
                                                <li>für Privatpersonen</li>
                                                <li>2 aktive Events</li>
                                                <li>5 inaktive Events</li>
                                            </ul>

                                            <button type="submit" name="abotype" value="free" class="btn shadow btn-primary">Kostenlos registrieren</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h4 class="my-0 font-weight-normal">Pro</h4>
                                        </div>
                                        <div class="card-body">
                                            <h1 class="card-title pricing-card-title">€2.99 <small class="text-muted">/ Monat</small></h1>
                                            <ul class="list-unstyled mt-3 mb-4">
                                                <li>10 aktive Events</li>
                                                <li>20 inaktive Events</li>
                                                <li>&nbsp;</li>
                                            </ul>
                                            <button type="submit" name="abotype" value="pro" class="btn shadow btn-outline-primary">Pro abbonieren</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h4 class="my-0 font-weight-normal">Premium</h4>
                                        </div>
                                        <div class="card-body">
                                            <h1 class="card-title pricing-card-title">€6.99 <small class="text-muted">/ Monat</small></h1>
                                            <ul class="list-unstyled mt-3 mb-4">
                                                <li>unbegrenzte Anzahl an Events</li>
                                                <li>&nbsp;</li>
                                                <li>&nbsp;</li>
                                            </ul>
                                            <button type="submit" name="abotype" value="premium" class="btn shadow btn-outline-primary">Premium abbonieren</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
