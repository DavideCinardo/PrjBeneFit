@extends('shared.header')

@section('content')
    <div class="d-flex justify-content-evenly" style="margin-top: 50px;">
        <h1>Lista di tutte le squadre: </h1>
        <form method="get" action="{{ url('squadre') }}" role="search">
            @csrf
            <div class="d-flex">
                <input class="form-control me-2" type="search" name="searchTeam" placeholder="Ricerca" aria-label="Search"
                    value="{{ old('searchTeam', $inputValue ?? '') }}">
                <button class="btn btn-outline-dark" type="submit">Cerca</button>
            </div>
        </form>



    </div>

    <div class="m-5 text-center">
        <a href="/inseriscisquadra"><i class="fa-solid fa-circle-plus"></i></a>
    </div>

    <div class="container mt-3">
        <div class="row justify-content-center">
            <label class="col-1">Nome</label>
            <label class="col-1">Dettaglio</label>
            <label class="col-1">Modifica</label>
            <label class="col-1">Cancella</label>
        </div>
        <hr>
        @foreach ($squadre as $squadra)
            <div class="row justify-content-center border-bottom">
                <label class="col-2">{{ $squadra->nome }}</label>
                <label class="col-1">
                    <a class="ms-4" href="/dettagliosquadra/{{ $squadra->codice_squadra }}"><i
                            class="fa-solid fa-circle-info"></i></a>
                </label>
                <label class="col-1">
                    <a class="ms-4" href="/modificasquadra/{{ $squadra->codice_squadra }}"><i
                            class="fa-solid fa-pen-to-square"></i></a>
                </label>
                <label class="col-1">
                    <a class="ms-4" href="/cancellasquadra/{{ $squadra->codice_squadra }}"
                        onclick="return confirm('Sei sicuro di voler cancellare {{ $squadra->nome }} - {{ $squadra->citta }} ?')"><i
                            class="fa-solid fa-trash"></i></a>
                </label>

            </div>
        @endforeach

        <div class="text-center mt-5">
            Totale giocatori presenti: <b>{{ $totaleGiocatori }}</b>
        </div>
    </div>
@endsection
