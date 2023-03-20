<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    //Funzione searchInput giocatori
    public function Lista_Search(Request $request)
    {
        
        if (!$request->searchPlayer) {
            $inputValue = '';
            $giocatori = Player::orderBy('nome')->get();
            return view('giocatori', compact('giocatori'));
        } else {
            $inputValue = $request->searchPlayer;
            $giocatori = Player::where('nome', 'LIKE', '%' . $inputValue . '%')->orderBy('nome')->get();
            return view('giocatori', compact('inputValue', 'giocatori'));
        }
    }

    //Funzione count
    public function totalegiocatori()
    {
        $totGiocatori = Player::count();
        return $totGiocatori;
    }
    /**
     * Display a listing of the resource.
     */
    public function listagiocatori()
    {
        $giocatori = Player::orderBy('nome')->get();
        return view('giocatori', compact('giocatori'));
    }

    public function dettagliogiocatore($idgiocatore)
    {
        $giocatore = Player::where('codice_tessera', $idgiocatore)->first();
        return view('dettagliogiocatore', compact('giocatore'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function inseriscigiocatore()
    {
        $giocatore = new Player();
        $giocatore->codice_tessera = 0;
        $giocatore->nome = '';
        $giocatore->costo = '';
        $giocatore->ruolo = '';

        $ruoli = Player::all();

        $titolo = 'Inserisci un nuovo giocatore';

        return view('giocatore', compact('giocatore', 'ruoli', 'titolo'));
    }

    //EDIT
    public function modificagiocatore($idgiocatore)
    {
        $giocatore = Player::where('codice_tessera', $idgiocatore)->first();
        //dd($giocatore);

        $ruoli = Player::all();

        $titolo = 'Modifica i dati del giocatore: ' . $giocatore->nome;

        return view('giocatore', compact('giocatore', 'ruoli', 'titolo'));
    }

    //Salva un giocatore o aggiornane uno già esistente
    public function storeOrUpdategiocatore(Request $request)
    {
        $this->validate(
            $request,
            [
                'nome' => 'required',
                'costo' => 'required',
                'ruoloid' => 'required',
            ],
            [
                'nome.required' => 'Inserisci un nome!',
                'costo.required' => 'Inserisci un costo!',
                'ruoloid.required' => 'Inserisci un ruolo!',
            ],
        );

        if ($request->id > 0) {
            // modifica
            $giocatore = Player::where('codice_tessera', '=', $request->id)->first();
        } else {
            $this->validate(
                $request,
                [
                    'nome' => 'required|unique:players,nome',
                    'costo' => 'required',
                    'ruoloid' => 'required',
                ],
                [
                    'nome.required' => 'Inserisci un nome!',
                    'nome.unique' => 'Inserisci un nome non presente!',
                    'costo.required' => 'Inserisci un costo!',
                    'ruoloid.required' => 'Inserisci un ruolo!',
                ],
            );
            $giocatore = new Player();
        }

        $giocatore->nome = $request->nome;
        $giocatore->costo = $request->costo;
        $giocatore->ruolo = $request->ruoloid;
        $giocatore->save();

        return $this->listagiocatori();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function cancellagiocatore($idgiocatore)
    {
        try {
            Player::where('codice_tessera', '=', $idgiocatore)->delete();
            return $this->listagiocatori()->with('success', 'Giocatore eliminato con successo.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                return back()->with('error', 'Non puoi eliminare questo giocatore, perchè presente in una o più squadre.');
            }
        }
    }
}
