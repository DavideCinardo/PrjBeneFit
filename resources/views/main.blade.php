@extends('shared.header')

@section('content')
    <div>
        <h1 class="text-center mt-5">Benvenuti nel gestionale delle tue squadre-giocatori!</h1>
        <hr>
    </div>
    <div class="divTots text-center d-flex justify-content-center align-items-center">
        <a href="/giocatori">
            <div class="mainDiv">
                <p class="mainP">Totale giocatori: <b>{{ $totaleGiocatori }}</b></p>
            </div>
        </a>
        <a href="/squadre">
            <div class="mainDiv">
                <p class="mainP">Totale squadre: <b>{{ $totaleSquadre }}</b></p>
            </div>
        </a>
    </div>
    <div class="container-fluid bgContainer">
        <div class="row justify-content-center">
            <div class="col-6">
                <div id="carouselExampleIndicators" class="carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner divImgBorder">
                        <div class="carousel-item active">
                            <img src="/media/AllenamentiCalcio.jpg" class="d-block w-100" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="/media/LegamentoCrociato.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="/media/sfondoCalcio.png" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
