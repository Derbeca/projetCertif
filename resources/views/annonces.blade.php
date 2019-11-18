<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Martseille</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo url('/assets/css/style.css') ?>">

</head>
<body>
<div id="app">
<!-- MENU DEPLIANT CACHÉ-->
    <nav class="w3-sidebar w3-animate-top w3-black"  style="display:none" id="mySidebar">
        <a href="javascript:void(0)" class="w3-button w3-xxlarge w3-padding " style="padding:6px 24px">
            <i class="fa fa-remove" id="logoFermer"></i>
        </a>
        <div class="w3-bar-block w3-center">
            <a href="<?php echo url('/') ?>" class="w3-button w3-hover-black"><img src="../public/assets/images/icon_home.png"><p>accueil</p></a>
            <a href="<?php echo url('/annonces') ?>" class="w3-button w3-hover-black"><img src="../public/assets/images/icon_galerie.png"><p>galerie</p></a>
            <a href="<?php echo url('/recherche') ?>" class="w3-button w3-hover-black"><img src="../public/assets/images/icon_recherche.png"><p>chercher</p></a>
            <a href="<?php echo url('/galerie') ?>" class="w3-button w3-hover-black"><img src="../public/assets/images/icon_carte.png"><p>carte</p></a>
            <!-- <a href="<?php echo url('/register') ?>" class="w3-button w3-hover-black">inscription</a> -->
<!--             <a href="<?php echo url('/espace-membre') ?>" class="w3-button w3-hover-black">espace membre</a> -->
            <a href="<?php echo url('/galerie') ?>" class="w3-button w3-hover-black"><img src="../public/assets/images/icon_murs.png"><p>chasse au murs</p></a>
            <a href="<?php echo url('/contact') ?>" class="w3-button w3-hover-black"><img src="../public/assets/images/icon_contact.png"><p>contact</p></a>
        </div>
    </nav>

    <!-- HEADER -->
    <header >
        <span class=" w3-xxlarge" id="justify">
            <a href="<?php echo url('/') ?>" id="logo">
                <img src="../public/assets/images/logo_martseille.png">
            </a>
            <div  id="login">
                <img src="../public/assets/images/icon_login.png">
                <ul id="menu">
                    <li><a href="<?php echo url('/register') ?>">Inscription</a></li>
                    <li><a href="<?php echo url('/login') ?>">Connexion</a></li>
                    <li><a href="<?php echo url('/espace-membre') ?>">Mon espace</a></li>
                </ul>
            </div>
            <i class="fa fa-bars w3-button" id="logoMenu"></i>
        </span> 
        <div class="w3-clear"></div>
    </header>
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
                    ::with('user')
                    ->latest("annonces.updated_at")   // CONSTRUCTION DE LA REQUETE
                    ->get();                 // JE VEUX OBTENIR LES RESULTATS
// debug
// print_r($tabAnnonce);
foreach($tabAnnonce as $annonce)
{
    // CHOIX PAS EFFICACE DU TOUT (CAR DANS UNE BOUCLE)
    // POUR CHAQUE ANNONCE, JE FAIS UNE REQUETE SUPPLEMENTAIRE 
    // POUR RECUPERER LES INFOS SUR User
    $auteur = App\User::find($annonce->user_id);
    // LES COLONNES SONT DES PROPRIETES 
    // DES OBJETS DE LA CLASSE Annonce
    // sécurité dans le cas où il n'y a pas de user
    $name = $auteur->name ?? "";
    $nameJointure = $annonce->name ?? "";
    $nameEager = $annonce->user ? $annonce->user->name : "";
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
    <footer>
        <a href="<?php echo url('/recherche') ?>" id="logoRecherche"><img src="../public/assets/images/icon_rechercheNoir.png"></a>
        <a href="<?php echo url('/espace-membre') ?>" id="btn-plus"><img src="../public/assets/images/bouton_plus.png"></a>
        <a href="<?php echo url('/espace-membre') ?>" id="logoCarte"><img src="../public/assets/images/icon_carteNoir.png"></a>
    </footer>
    </div><!-- FIN DU CONTAINER POUR VUEJS -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="<?php echo url('/assets/js/main.js') ?>"></script>
</body>
</html>