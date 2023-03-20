@extends('shared.header')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4"><label for="codice_squadra">Questo è il codice della squadra
                    selezionata: <b>{{ $squadra->codice_squadra }}</b> </label></div>
            <div class="col-4"><label for="nome">Questo è il nome della squadra: <b>{{ $squadra->nome }}</b></label>
            </div>
            <div class="col-4"><label for="citta">Questo è dove è ubicata: <b>{{ $squadra->citta }}</b></label></div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col text-center">
                <p class="mt-5">Questi sono i giocatori che giocano in questa squadra:</p>
                @foreach ($squadra->players as $player)
                    <a href="/dettagliogiocatore/{{ $player->codice_tessera }}">{{ $player->nome }}</a> - <i>Costo:
                    </i><b>{{ $player->costo }}</b> Milioni<br>
                @endforeach
                <p class="fs-5 mt-5">Valore della squadra: <b>{{ $totaleCosti }} Milioni</b></p>

            </div>
        </div>
    </div>


    <div class="text-center">
        <a class="btn btn-primary" href="{{ url('squadre') }}">Torna alla lista squadre</a>
    </div>
@endsection
