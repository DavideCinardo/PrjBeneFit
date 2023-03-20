@extends('shared.header')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <label for="codice_tessera">Questo è il codice della tessera del giocatore
                    selezionato: <br><b>{{ $giocatore->codice_tessera }}</b>
                </label>
            </div>
            <div class="col-3">
                <label for="nome">Questo è il nome del giocatore: <br><b>{{ $giocatore->nome }}</b>
                </label>
            </div>
            <div class="col-3">
                <label for="costo">Questo è il suo costo attuale: <br><b>{{ $giocatore->costo }} Milioni</b>
                </label>
            </div>
            <div class="col-3">
                <label for="ruolo">Questo è il suo ruolo: <br><b>{{ $giocatore->ruolo }}</b>
                </label>
            </div>
        </div>
    


    <div class="container">
        <div class="row">
            <div class="col text-center">
                <p> <b>{{ $giocatore->nome }}</b> appartiene a:</p>
                @foreach ($giocatore->teams as $team)
                    <a class="fs-3" href="/dettagliosquadra/{{ $team->codice_squadra }}">{{ $team->nome }}</a> <br>
                @endforeach
            </div>
        </div>
    </div>


    <div class="text-center mt-5">
        <a class="btn btn-warning" href="{{ url('giocatori') }}">Torna alla lista dei giocatori</a>
    </div>

</div>
@endsection
