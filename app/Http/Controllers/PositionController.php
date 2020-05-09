<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;
use Validator;
use DB;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
/*         $position=DB::table('positions')
        ->join('positions', 'positions.annonce_id', '=', 'annonces.id')
        ->select('positions.lat', 'positions.long', 'annonces.photo')
        ->get();

        dd($position); */

        $positions = Position::all();

        $positions = json_encode($positions, JSON_PRETTY_PRINT);
        return view('carte', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                // ICI ON DOIT TRAITER LE FORMULAIRE DE CREATE
        // ...
        // ON VA RENVOYER DU FORMAT JSON
        // EN PHP, ON VA UTILISER UN TABLEAU ASSOCIATIF

        $tabAssoJson = [];
        $tabAssoJson["test"] = date("Y-m-d H:i:s");


            $validator = Validator::make($request->all(), [
                'lat'       => 'required',
                'long'      => 'required',
                'annonce_id'=> 'unique:positions',
            ]);
            if ($validator->fails()) 
            {
                // CAS OU IL Y A DES ERREURS
                $tabAssoJson["erreur"] = "IL Y A DES ERREURS";
                $tabAssoJson["confirmation"] = "IL Y A DES ERREURS";
            }
            else
            {
                $lat = $request->input("lat");
                $long = $request->input("long");
                $annonce_id = $request->input("id");
                
                $tabAssoColonneValeur = [
                    "lat"   => $lat,
                    "long" => $long,
                    "annonce_id" => $annonce_id,
                ];

                $id = $request->input("id");
                // DEBUG
                $tabAssoJson["debugForm"] = $tabAssoColonneValeur;
                // JE VEUX INSERER UNE LIGNE DANS LA TABLE SQL newsletters
                // IL FAUT AVOIR AJOUTE UNE PROPRIETE
                // DANS LA CLASSE Newsletter.php
                // LA METHODE create VIENT DE LA CLASSE PARENTE Model
                Position::create($tabAssoColonneValeur);
                $tabAssoJson["confirmation"] = "LA PHOTO A ÉTÉ POSITIONNÉE";
            }
            // ON PEUT RENVOYER LE TABLEAU ASSOCIATIF
            // ET LARAVEL VA LE TRANSFORMER EN JSON => COOL
            return $tabAssoJson;

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        //
    }
}
