<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $playerController = new PlayerController();
    $teamController = new TeamController();
    $totaleGiocatori = $playerController->totalegiocatori();
    $totaleSquadre = $teamController->totalesquadre();
    return view('main', compact('totaleGiocatori', 'totaleSquadre'));
});

//Rotte squadre
Route::get('/squadre', [App\Http\Controllers\TeamController::class, 'Lista_Search']);
Route::get('/inseriscisquadra', [App\Http\Controllers\TeamController::class, 'inseriscisquadra']);
Route::post('/squadra', [App\Http\Controllers\TeamController::class, 'storeOrUpdateSquadra']);
Route::get('/dettagliosquadra/{idsquadra}', [App\Http\Controllers\TeamController::class, 'dettagliosquadra']);
Route::get('/modificasquadra/{idsquadra}', [App\Http\Controllers\TeamController::class, 'modificasquadra']);
Route::get('/cancellasquadra/{idsquadra}', [App\Http\Controllers\TeamController::class, 'cancellasquadra']);

//Rotte giocatori
Route::get('/giocatori', [App\Http\Controllers\PlayerController::class, 'Lista_Search']);
Route::get('/inseriscigiocatore', [App\Http\Controllers\PlayerController::class, 'inseriscigiocatore']);
Route::post('/giocatore', [App\Http\Controllers\PlayerController::class, 'storeOrUpdategiocatore']);
Route::get('/dettagliogiocatore/{idgiocatore}', [App\Http\Controllers\PlayerController::class, 'dettagliogiocatore']);
Route::get('/modificagiocatore/{idgiocatore}', [App\Http\Controllers\PlayerController::class, 'modificagiocatore']);
Route::get('/cancellagiocatore/{idgiocatore}', [App\Http\Controllers\PlayerController::class, 'cancellagiocatore']);
