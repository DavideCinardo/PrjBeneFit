@extends('shared.header')

@section('content')
    <div class="container mt-3">
        <div class="text-center">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>


        <h2 class="text-center">Lista di tutti i giocatori</h2>
        <div class="d-flex justify-content-evenly" style="margin-top: 50px;">
            <h1>Lista di tutti i giocatori: </h1>
            <a href="/inseriscigiocatore"><i class="fa-solid fa-circle-plus"></i></a>
            <form method="get" action="{{ url('giocatori') }}" class="d-flex" role="search">
                @csrf
                <div class="d-flex">
                    <input class="form-control me-2" type="search" name="searchPlayer" placeholder="Ricerca"
                        aria-label="Search" value="{{ old('searchPlayer', $inputValue ?? '') }}">
                    <button class="btn btn-outline-dark" type="submit">Cerca</button>
                </div>
            </form>
        </div>

        <div class="container mt-3">
            @foreach ($giocatori as $giocatore)
                <div class="row justify-content-center border-bottom">
                    <label class="col-4">{{ $giocatore->nome }}</label>
                    <label class="col-1">
                        <a class="ms-4" href="/dettagliogiocatore/{{ $giocatore->codice_tessera }}"><i
                                class="fa-solid fa-circle-info"></i></a>
                    </label>
                    <label class="col-1">
                        <a class="ms-4" href="/modificagiocatore/{{ $giocatore->codice_tessera }}"><i
                                class="fa-solid fa-pen-to-square"></i></a>
                    </label>
                    <label class="col-1">
                        <a class="ms-4" href="/cancellagiocatore/{{ $giocatore->codice_tessera }}"
                            onclick="return confirm('Sei sicuro di voler cancellare {{ $giocatore->nome }} - {{ $giocatore->ruolo }} ?')"><i
                                class="fa-solid fa-trash"></i></a>
                    </label>
                </div>
            @endforeach
        </div>

        <h2 class="text-center mt-5">Numero di giocatori per ruolo</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Ruolo</th>
                    <th>Numero di giocatori</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($giocatori->groupBy('ruolo') as $ruolo => $giocatoriPerRuolo)
                    <tr>
                        <td>{{ $ruolo }}</td>
                        <td>{{ $giocatoriPerRuolo->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
