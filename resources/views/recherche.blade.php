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
        <a href="javascript:void(0)" class="w3-button w3-xxlarge w3-padding  " style="padding:6px 24px">
            <i class="fa fa-remove"  id="logoFermer"></i>
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
                    <li><a href="<?php echo url('/register') ?>" class="monLien">Inscription</a></li>
                    <li><a href="<?php echo url('/login') ?>" class="monLien">Connexion</a></li>
                    <li><a href="<?php echo url('/espace-membre') ?>" class="monLien">Mon espace</a></li>
                </ul>
            </div>
            <i class="fa fa-bars w3-button" id="logoMenu"></i>
        </span> 
        <div class="w3-clear"></div>
    </header>
    <main>
        <section>
            <form @submit.prevent="rechercherAjax" action="">
                <input type="text" name="adresse" required placeholder="entrez un code postal">
                <input type="text" name="categorie" placeholder="entrez la categorie">
                <button type="submit">CHERCHER</button>
                <!-- PROTECTION DE LARAVEL CONTRE LES ATTAQUES CSRF -->
                <!-- Sécurité: Cross Site Request Forgery -->
                @csrf
            </form>
        </section>
        <section v-if="annonces.length > 0">
            <h3>RESULTATS DE RECHERCHE DES ANNONCES (@{{ annonces.length }})</h3>
            <div class="listeAnnonce">
                <article v-for="annonce in annonces">
                    <img :src="annonce.photo">
                    <h4>@{{ annonce.titre }}</h4>
                    <p>@{{ annonce.adresse }}</p>
                    <!-- <h5>@{{ annonce.id }}</h5> -->
                </article>
            </div>
        </section>

        <section v-if="annonces.length == 0" >
            <div class="listeAnnonce">
<?php
// ON VA AFFICHER DES ANNONCES AVEC PHP
// ON VA FAIRE UN READ SUR LA TABLE SQL annonces
// AVEC Laravel, ON PASSE PAR LA CLASSE Annonce
// trop basique 
// car on obtient la liste pat id croissant
// $tabAnnonce = \App\Annonce::all();
$tabAnnonce = \App\Annonce
                    ::latest("updated_at")   // CONSTRUCTION DE LA REQUETE
                    ->get();                 // JE VEUX OBTENIR LES RESULTATS
// debug
// print_r($tabAnnonce);
// $annonce EST UN OBJET DE LA CLASSE Annonce
// ET CONTIENT LES INFOS D'UNE LIGNE DE LA TABLE SQL annonces
foreach($tabAnnonce as $annonce)
{
    // LES COLONNES SONT DES PROPRIETES 
    // DES OBJETS DE LA CLASSE Annonce
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

    <script>
    // MAINTENANT JE PEUX UTILISER VUEJS
    /* var app = new Vue({
  el: '#app',
  methods: {
    rechercherAjax: function (event) {
        // debug
        // event.target CONTIENT LA BALISE form
        console.log(event.target);
        // ON VA RECUPERER LES INFOS DU FORMULAIRE
        var formData = new FormData(event.target);
        // ET ENSUITE ON VA LANCER UNE REQUETE AJAX AVEC fetch
        // POUR RECUPERER LA LISTE DES RESULTATS DE RECHERCHE
        // JE DOIS CREER UNE ROUTE AVEC CETTE URL /annonce/rechercher
        // POUR TRAITER LA REQUETE AJAX
        fetch('annonce/rechercher', {
            method: 'POST',
            body: formData  // TRANSMET LES INFOS DU FORMULAIRE DANS LA REQUETE AJAX
        })
        .then(function(response) {
            // CONVERTIT LA REPONSE DU SERVEUR EN OBJET JSON 
            return response.json(); 
        })
        .then(function(objetJSON) {
            // ON PEUT MANIPULER UN OBJET JS
            console.log(objetJSON);
            // AVEC VUEJS JE CENTRALISE LES INFOS DANS DES VARIABLES VUEJS
            if (objetJSON.annonces && app.annonces) {
                // JE GARDE LA LISTE DES RESULTATS DANS UNE VARIABLE VUEJS
                app.annonces = objetJSON.annonces;
            }
        });
    }
  },
  data: {
    annonces: [],       // MA VARIABLE VUEJS QUI GARDE EN MEMOIRE LA LISTE DES ANNONCES
    message: 'Hello Vue !'
  }
}) */
    </script>

</body>
</html>