@extends('layout.mainlayout')

@section('title', 'Login')

@section('content')

    <div class="album text-muted">
        <div class="container">
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


                                    <a target="_blank"  class="btn btn-secondary" href="{{"guest/".$event->event_hash}}">Zum Event</a>

                                    <button data-clipboard-action="copy" data-clipboard-target="#Z{{$event->event_hash}}" type="button" class="copyButton btn btn-primary">
                                        Link Kopieren
                                        <span style="display: none;" class="animation">in die Zwischenablage kopiert!</span>
                                    </button>
                                    <span style="position: absolute; top: -2000px; left: -2000px;" id="Z{{$event->event_hash}}">{{url("guest/".$event->event_hash)}}</span>


                                    <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#collapse{{$event->event_id}}" aria-expanded="false" aria-controls="{{$event->event_hash}}">
                                        bearbeiten
                                    </button>
                                </div>
                                <div class="card-footer collapse" id="collapse{{$event->event_id}}">

                                    <form method="post" action="{{ route('event.bearbeiten') }}">

                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="form-row">
                                            <div class="col-7">
                                                <input type="text" class="form-control" name="titel" value="{{$event->titel}}">
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="beschreibung" value="{{$event->beschreibung}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-check">
                                                    <fieldset>
                                                        <input type="radio" id="spamaus" name="spamfilter" value="0" @if($event->spamfilter ==0)checked @endif>
                                                        <label for="spamaus"> Spamfilter aus</label>
                                                        <br>
                                                        <input type="radio" id="spamcaptcha" name="spamfilter" value="1" @if($event->spamfilter ==1) checked @endif>
                                                        <label for="spamcaptcha"> Spamfilter Captcha</label>
                                                        <br>
                                                        <input type="radio" id="spamlimit" name="spamfilter" value="2" @if($event->spamfilter ==2) checked @endif>
                                                        <label for="spamlimit"> Spamfilter Limit</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-secondary" type="submit">Änderung speichern</button>
                                    </form>
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
