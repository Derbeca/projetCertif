<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // CREATE
        // JE DOIS FAIRE LE TRAITEMENT DU FORMULAIRE
        // ET RENVOYER DU JSON
        // EN PHP, SI JE PASSE PAR UN TABLEAU ASSOCIATIF
        // JE PEUX TRANSFORMER LE TABLEAU ASSOCIATIF EN JSON
        $tabAssoJson = [];
        // JE REMPLIS LE TABLEAU ASSOCIATIF 
        // AVEC LES INFOS A RENVOYER AU NAVIGATEUR
        $tabAssoJson["infoNavigateur"] = date("Y-m-d H:i:s");
        // SI JE VEUX TRAITER LE FORMULAIRE
        // ON VEUT VERIFIER SI L'EMAIL A LA FORME D'UN EMAIL
        // ET ON VEUT QUE L'EMAIL SOIT UNIQUE
        // https://laravel.com/docs/5.7/validation#manually-creating-validators
        // https://laravel.com/docs/5.7/validation#available-validation-rules
        // LES CLES SONT LES ATTRIBUTS name DANS LE HTML
        // <input name="email">
        // <input name="nom">
        // => ICI ON FAIT LES CONTROLES DE SECURITE
        // => CONTROLLER DANS MVC
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email|max:160',
            'nom'       => 'required|max:160',
            'message'   => 'required',
        ]);
        if ($validator->fails()) 
        {
            // IL Y A DES ERREURS
            $tabAssoJson["erreur"] = "IL Y A DES ERREURS";
            $tabAssoJson["confirmation"] = "IL Y A DES ERREURS";
        }
        else
        {
            // C'EST OK
            // JE DOIS RECUPERER LES INFOS ENVOYEES PAR LE NAVIGATEUR
            // nom
            // email
            $nom = $request->input("nom");
            $email = $request->input("email");
            $message = $request->input("message");
            
            $tabAssoColonneValeur = [
                "nom"     => $nom,
                "email"   => $email,
                "message" => $message,
            ];
            // DEBUG
            $tabAssoJson["debugForm"] = $tabAssoColonneValeur;
            // JE VEUX INSERER UNE LIGNE DANS LA TABLE SQL newsletters
            // IL FAUT AVOIR AJOUTE UNE PROPRIETE
            // DANS LA CLASSE Newsletter.php
            // LA METHODE create VIENT DE LA CLASSE PARENTE Model
            Contact::create($tabAssoColonneValeur);
            $tabAssoJson["confirmation"] = "MERCI DE VOTRE MESSAGE";
        }
        // ON PEUT RENVOYER LE TABLEAU ASSOCIATIF
        // ET LARAVEL VA LE TRANSFORMER EN JSON => COOL
        return $tabAssoJson;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
