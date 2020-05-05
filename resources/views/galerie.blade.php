@include('layouts.header')
    <main>
        <section>
            <div class="listeAnnonce">
<?php
// ON VA AFFICHER DES ANNONCES AVEC PHP
// ON VA FAIRE UN READ SUR LA TABLE SQL annonces
// AVEC Laravel, ON PASSE PAR LA CLASSE Annonce
// trop basique 
// car on obtient la liste pat id croissant
// $tabAnnonce = \App\Annonce::all();
/*
// https://laravel.com/docs/4.2/queries#joins
// ON PEUT FAIRE UNE JOINTURE AVEC users
// ON FAIT UNE SEULE REQUETE 
// ET DANS LES RESULTATS LES COLONNES DE users 
// SONT COMME DES COLONNES DE annonces
// (NOTE: ON FAIT UN INNER JOIN CE QUI ENLEVE LES ANNONCES SANS USER)
$tabAnnonce = \App\Annonce
                    ::join('users', 'users.id', '=', 'annonces.user_id')
                    ->latest("annonces.updated_at")   // CONSTRUCTION DE LA REQUETE
                    ->get();                 // JE VEUX OBTENIR LES RESULTATS
*/
// METHODE LARAVEL : EAGER LOADING
// https://laravel.com/docs/4.2/eloquent#eager-loading
// LARAVEL FAIT 2 REQUETES (SANS JOINTURE)
// REQUETE1: LARAVEL RECUPERE LES ANNONCES ET LARAVEL MEMORISE LA LISTE DES user_id
// REQUETE2: LARAVEL RECUPERE LES USERS AVEC LA LISTE DES user_id
// IL FAUT AJOUTER LA RELATION ONE-TO-MANY DANS LA CLASSE Annonce
// CHOIX PAS OPTIMAL MAIS TRES EFFICACE (BON CONPROMIS)
// ORM => ON VA NAVIGUER ENTRE OBJETS
// DEPSUI $annonce
// ON PEUT PASSER SUR UN OBJET user QUI CONTIENT LES INFOS DE L'AUTEUR DE L'ANNONCE
// $annonce->user  
use App\User;
$tabAnnonce = \App\Annonce
                    ::where("categorie", "=", 'mur vide')
                    ->latest("updated_at")   // CONSTRUCTION DE LA REQUETE
                    ->get(); 
// debug
// print_r($tabAnnonce);
foreach($tabAnnonce as $annonce)
{
    echo
<<<CODEHTML
<article>
    <img src="{$annonce->photo}">
    <h4>{$annonce->titre}</h4>
    <p>{$annonce->adresse}</p>

</article>
CODEHTML;
}
?>
            </div>
        </section>
    </main>
    @include('layouts.footer')