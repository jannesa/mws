@extends('layout.mainlayout')

@section('title', 'Dashboard')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <h3 class="mb-5 mt-5">User Daten</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">User ID: {{$data->id}}</h5>
                            <p class="card-text">Name: {{$data->vorname}} {{$data->nachname}}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">E-mail: {{$data->email}}</li>
                            <li class="list-group-item">Registrierungsdatum: {{$data->created_at}}</li>
                            <li class="list-group-item">Abo: {{$abo_type}}</li>
                        </ul>
                        <div class="card-body">
                            <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#collapse{{$data->id}}" aria-expanded="false" aria-controls="{{$data->id}}">
                                bearbeiten
                            </button>

                        </div>
                        <div class="card-footer collapse" id="collapse{{$data->id}}">
                            <form action="{{ route("auth.user.edit")}}" method="POST">
                                @csrf

                                <input type="hidden" name="user_id" value="{{$data->id}}" >

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Vorname</label>
                                    <input type="text" name="vorname" class="form-control" value="{{$data->vorname}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nachname</label>
                                    <input type="text" name="nachname" class="form-control" value="{{$data->nachname}}">
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="alert alert-info" role="alert">
                                            <strong> Upgrade auf Pro oder Premium ? </strong>
                                        </div>
                                        <div class="form-check">
                                            <fieldset>
                                                <input type="radio" id="free" name="abotype" value="1" @if($abo_type == 'Free')checked @endif>
                                                <label for="free"> Free </label>
                                                <br>
                                                <input type="radio" id="pro" name="abotype" value="2" @if($abo_type == 'Pro') checked @endif>
                                                <label for="pro"> Pro </label>
                                                <br>
                                                <input type="radio" id="premium" name="abotype" value="3" @if($abo_type == 'Premium') checked @endif>
                                                <label for="premium"> Premium </label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



@endsection

