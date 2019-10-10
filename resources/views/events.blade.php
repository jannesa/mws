@extends('layout.mainlayout')

@section('title', 'Login')

@section('content')

    <div class="my-5">
        <div class="container pb-5">
            <div class="row">
                <div class="col-12">
                    <h1>Events</h1>
                    <a class="btn btn-primary" href="{!! url('events_erstellen') !!}">&nbsp;Event erstellen</a>
                </div>
                @if(count($events)>0)
                    @foreach($events as $event )
                        <div class="col-12 mt-2 mb-2">

                            <div class="card">
                                <div class="card-header">
                                    Event-Name: {{$event->titel}}
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Beschreibung: {{$event->beschreibung}}</p>
                                    <p class="card-text">Status: {{$event->status}}</p>
                                    @if($event->spamfilter ==0)
                                        <p class="card-text">Spamfilter: {{"Aus"}}</p>
                                    @elseif($event->spamfilter ==1)
                                        <p class="card-text">Spamfilter: {{"Captcha"}}</p>
                                    @elseif($event->spamfilter ==2)
                                        <p class="card-text">Spamfilter: {{"Limit"}}</p>
                                    @endif


                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a class="btn btn-secondary" href="{{"songs/".$event->event_hash}}" data-toggle="tooltip" title="Musikwünsche für dieses Event anzeigen">Songwünsche</a>

                                        <button data-clipboard-action="copy" data-clipboard-target="#Z{{$event->event_hash}}" type="button" class="copyButton btn btn-primary" data-toggle="tooltip" title="Link für Gäste kopieren">
                                            Event-Link
                                            <span style="display: none;" class="animation">in die Zwischenablage kopiert!</span>
                                        </button>
                                        <span style="position: absolute; top: -2000px; left: -2000px;" id="Z{{$event->event_hash}}">{{url("guest/".$event->event_hash)}}</span>

                                        <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#collapse{{$event->event_id}}" aria-expanded="false" aria-controls="{{$event->event_hash}}" data-toggle="tooltip" title="Event bearbeiten">
                                            bearbeiten
                                        </button>
                                    </div>
                                </div>
                                <div class="card-footer collapse" id="collapse{{$event->event_id}}">
                                    <div class="row">
                                        <div class="col">
                                            <form method="post" action="{{ route('event.bearbeiten') }}" >
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                <div class="form-row">
                                                    <div class="col-7">
                                                        <p class="card-text">Event-Name:</p>
                                                        <input type="text" class="form-control" name="titel" value="{{$event->titel}}" maxlength="191" required>
                                                    </div>
                                                    <div class="col">
                                                        <p class="card-text">Beschreibung: </p>
                                                        <textarea class="form-control" name="beschreibung" maxlength="500">{{$event->beschreibung}}</textarea>
                                                    </div>
                                                    <input type="hidden" class="form-control" name="id" value="{{$event->event_id}}">
                                                </div>
                                                <br>
                                                @if($event->status == 'aktiv')
                                                    <div class="form-label-group">
                                                        <input type="checkbox" name="status" value="aktiv" checked> Event aktiv
                                                    </div>
                                                @else
                                                    <div class="form-label-group">
                                                        <input type="checkbox" name="status" value="aktiv" > Event aktiv
                                                    </div>
                                                @endif
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-check">
                                                            <fieldset>
                                                                <input type="radio" id="spamaus" name="spamfilter" value="0" @if($event->spamfilter ==0)checked @endif>
                                                                <label for="spamaus" data-toggle="tooltip" title="Unbegrenzte Wünsche möglich!"> Spamfilter aus</label>
                                                                <br>
                                                                <input type="radio" id="spamcaptcha" name="spamfilter" value="1" @if($event->spamfilter ==1) checked @endif>
                                                                <label for="spamcaptcha" data-toggle="tooltip" title="Gäste müssen ein Captcha Code eingeben!"> Spamfilter Captcha</label>
                                                                <br>
                                                                <input type="radio" id="spamlimit" name="spamfilter" value="2" @if($event->spamfilter ==2) checked @endif>
                                                                <label for="spamlimit" data-toggle="tooltip" title="Fünf Wünsche im Fünf-Minuten-Zyklus möglich"> Spamfilter Limit</label>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-dark" type="submit">Änderung speichern</button>
                                            </form>
                                        </div>
                                        <div class="col-lg-2 align-self-lg-end">
                                            <form method="post" action="{{ route('event.loeschen') }}" >
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="col">
                                                    <input type="hidden" class="form-control" name="id" value="{{$event->event_id}}">
                                                </div>
                                                <button class="confirm-delete btn btn-danger" type="button">Löschen</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div>Sie haben noch keine Events erstellt</div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>


        $(document).ready(function(){

            var clipboard = new ClipboardJS('.copyButton');

            function setTooltip(btn, message) {
                $(btn).tooltip('hide')
                    .attr('data-original-title', message)
                    .tooltip('show');
            }

            function hideTooltip(btn) {
                setTimeout(function() {
                    $(btn).tooltip('hide');
                }, 1000);
            }

            clipboard.on('success', function(e) {
                console.log(e);
                setTooltip(e.trigger, 'Link Kopiert!');
                hideTooltip(e.trigger);
            });

            clipboard.on('error', function(e) {
                console.log(e);
            });
        });


    </script>

@endsection
