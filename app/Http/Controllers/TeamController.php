<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    //Funzione searchInput squadra
    public function Lista_Search(Request $request)
    {
        // Mi stampo tutti i giocatori presenti nel blade squadre
        $playerController = new PlayerController();
        $totaleGiocatori = $playerController->totalegiocatori();


        if (!$request->searchTeam) {
            $inputValue = '';
            $squadre = Team::orderBy('nome')->get();
            return view('squadre', compact('squadre', 'totaleGiocatori'));
        } else {
            $inputValue = $request->searchTeam;
            $squadre = Team::where('nome', 'LIKE', '%' . $inputValue . '%')
                ->orderBy('nome')
                ->get();
            return view('squadre', compact('inputValue', 'squadre', 'totaleGiocatori'));
        }
    }

    //Funzione count
    public function totalesquadre()
    {
        $totSquadre = Team::count();
        return $totSquadre;
    }

    //dettaglio della squadra
    public function dettagliosquadra($idsquadra)
    {
        $squadra = Team::where('codice_squadra', $idsquadra)->first();

        $totaleCosti = $squadra->players->sum('costo');
        return view('dettagliosquadra', compact('squadra', 'totaleCosti'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function inseriscisquadra()
    {
        $squadra = new Team();
        $squadra->codice_squadra = 0;
        $squadra->nome = '';
        $squadra->citta = '';

        $titolo = 'Inserisci una nuova squadra';
        $giocatori = Player::all();

        $titoloSquadra = 'Modifica i dati della squadra: ' . $squadra->nome;
        $titoloGiocatori = 'I giocatori che appartengono alla squadra ' . $squadra->nome . ' sono: ';

        $titoloGiocatoriTotali = 'Questi sono i giocatori totali: ';

        return view('squadra', compact('squadra', 'titolo', 'titoloSquadra', 'titoloGiocatori', 'titoloGiocatoriTotali', 'giocatori'));
    }

    //EDIT
    public function modificasquadra($idsquadra)
    {
        $playerController = new PlayerController();
        $totaleGiocatori = $playerController->totalegiocatori();

        $squadra = Team::where('codice_squadra', $idsquadra)->first();
        $giocatori = Player::all();

        $titolo = 'Modifica i dati della squadra: ' . $squadra->nome;
        $titoloGiocatori = 'I giocatori che appartengono alla squadra ' . $squadra->nome . ' sono: ';

        $titoloGiocatoriTotali = 'Questi sono i giocatori totali: ';

        return view('squadra', compact('squadra', 'titolo', 'titoloGiocatori', 'titoloGiocatoriTotali', 'giocatori', 'totaleGiocatori'));
    }

    //Salva una squadra o aggiornane una già esistente
    public function storeOrUpdateSquadra(Request $request)
    {
        $this->validate(
            $request,
            [
                'nome' => 'required',
                'citta' => 'required',
            ],
            [
                'nome.required' => 'Nome richiesto',
                'citta.required' => 'Citta richiesta',
            ],
        );

        if ($request->id > 0) {
            // modifica
            $squadra = Team::where('codice_squadra', '=', $request->id)->first();
        } else {
            $this->validate(
                $request,
                [
                    'nome' => 'required',
                    'citta' => 'required',
                ],
                [
                    'nome.required' => 'Nome richiesto',
                    'citta.required' => 'citta richiesta',
                ],
            );
            $squadra = new Team();
        }

        $squadra->nome = $request->nome;
        $squadra->citta = $request->citta;
        $squadra->save();

        // salva i giocatori selezionati nella tabella pivot
        $giocatori_selezionati = $request->input('giocatori', []);
        $squadra->players()->sync($giocatori_selezionati);

        return $this->listasquadre();
    }

    /**
     * Display a listing of the resource.
     */
    public function listasquadre()
    {
        $playerController = new PlayerController();
        $totaleGiocatori = $playerController->totalegiocatori();

        $squadre = Team::orderBy('nome')->get();
        return view('squadre', compact('squadre', 'totaleGiocatori'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function cancellasquadra($idsquadra)
    {
        Team::where('codice_squadra', '=', $idsquadra)->delete();

        return $this->listasquadre();
    }
}
