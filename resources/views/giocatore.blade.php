@extends('shared.header')

@section('content')
    <h2 class="text-center">{{ $titolo }}</h2>
    <div class="m-5 text-center">
        <h2>O inseriscine uno nuovo:</h2><a href="/inseriscigiocatore"><i class="fa-solid fa-circle-plus"></i></a>
    </div>
    <div class="container mt-3">
        <form action="{{ url('giocatore') }}" method="POST">
            @csrf
            <input style="display:none" type="text" name="id" value="{{ $giocatore->codice_tessera }}" readonly> <br>
            <div class="row">
                <label for="nome" class="col-1 col-form-label">Giocatore: </label>
                <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror"
                    value="{{ old('nome') ?? $giocatore->nome }}">
                <br>
                <label for="citta" class="col-1 col-form-label">Costo:</label>
                <input type="number" name="costo" class="form-control @error('costo') is-invalid @enderror"
                    value="{{ old('costo') ?? $giocatore->costo }}">
                <label for="ruolo" class="col-1 col-form-label">Ruolo:</label>
                <div class="col-3">
                    <select name="ruoloid" class="form-control">
                        <option value="0" selected>Selezionare...</option>
                        <option value="Attaccante" {{ $giocatore->ruolo == 'Attaccante' ? 'selected' : '' }}>Attaccante
                        </option>
                        <option value="Centrocampista" {{ $giocatore->ruolo == 'Centrocampista' ? 'selected' : '' }}>
                            Centrocampista</option>
                        <option value="Difensore" {{ $giocatore->ruolo == 'Difensore' ? 'selected' : '' }}>Difensore
                        </option>
                        <option value="Portiere" {{ $giocatore->ruolo == 'Portiere' ? 'selected' : '' }}>Portiere</option>
                    </select>
                </div>
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
        <input class="mt-3" type="submit" value="Salva">
        <a class="btn btn-danger" href="{{ url('giocatori') }}">Annulla</a>
    </div>
    </form>
    </div>


@endsection
