@extends('layout.mainlayout')

@section('title', 'Dashboard')

@section('content')

    @auth('admin')

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    <div class="album text-muted">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1> @if( Auth::guard('admin')->check())
                            Admin-Dashboard von {{{ Auth::user()->vorname }}}
                        @endif
                    </h1>
                    <h2>Registrierte User mit Events</h2>
                </div>
                <div class="col-12">
                    @if($users->count() > 0)
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">&nbsp;</th>
                            <th scope="col">ID</th>
                            <th scope="col">Vorname</th>
                            <th scope="col">Nachname</th>
                            <th scope="col">E-Mail</th>
                            <th scope="col">Abo-ID</th>
                            <th scope="col">Registriert am:</th>
                            <th scope="col">Anzahl Events</th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$loop->index}}</th>
                                <td>{{$user->id}}</td>
                                <td>{{$user->vorname}}</td>
                                <td>{{$user->nachname}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->abo_id}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>{{$user->anzahl_events}}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.delete.user') }}">
                                        @csrf
                                        <input type="hidden" class="form-control" name="id" value="{{$user->id}}">
                                        <button type="button" class="confirm-delete btn btn-primary">löschen</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>




                        @else
                        <p>
                            Es gibt noch keine User!
                        </p>
                        @endif
                </div>
            </div>
        </div>
    </div>
    @elseauth

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p>nicht erlaubter Zugriff!</p>
                </div>
            </div>
        </div>

    @endauth

@endsection

