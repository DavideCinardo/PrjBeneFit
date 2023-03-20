@extends('shared.header')

@section('content')
    <h2 class="text-center">{{ $titolo }}</h2>
    <div class="container mt-3">
        <form action="{{ url('squadra') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $squadra->codice_squadra }}" readonly> <br>
            <div class="row">
                <label for="nome" class="col-1 col-form-label">Inserisci la squadra: </label>
                <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror"
                    value="{{ old('nome') ?? $squadra->nome }}">
                <br>
                <label for="citta" class="col-1 col-form-label">Inserisci la città:</label>
                <input type="text" name="citta" class="form-control @error('citta') is-invalid @enderror"
                    value="{{ old('citta') ?? $squadra->citta }}">
                <div class="col-3">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
    </div>


    <div class="text-center">
        <h3 class="mt-5">{{ $titoloGiocatori }}</h3>
        @foreach ($squadra->players as $player)
            <label for="c_s">{{ $player->nome }}</label>
            <input style="padding: 5px" type="checkbox" name="c_s" checked>
        @endforeach
    </div>

    <div class="text-center">
        <h3 class="mt-4">{{ $titoloGiocatoriTotali }}</h3>
        @foreach ($giocatori as $giocatore)
            @php
                $isChecked = false;
                $pivot = DB::table('team_player')
                    ->where('id_team', $squadra->codice_squadra)
                    ->where('id_player', $giocatore->codice_tessera)
                    ->first();
                if ($pivot !== null) {
                    $isChecked = true;
                }
            @endphp
            <label>{{ $giocatore->nome }}</label>
            <input style="padding: 5px" type="checkbox" name="giocatori[]" value="{{ $giocatore->codice_tessera }}"
                @if ($isChecked) checked @endif> <br>
        @endforeach
    </div>

    <div class="text-center mt-5">
        <input class="btn btn-primary" type="submit" value="Salva">
        <a class="btn btn-danger" href="{{ url('squadre') }}">Annulla</a>
    </div>

    </form>


@endsection
