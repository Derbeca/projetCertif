<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Martseille</title>
    <link rel="stylesheet" href="<?php echo url('/assets/css/style.css') ?>">

</head>
<body>
<div id="app">
<!-- MENU DEPLIANT CACHÉ-->
    <nav id="mySidebar">
        <img src="../public/assets/images/icon_fermer.png" id="logoFermer">
        <div id="menuAccueil">
            <a href="<?php echo url('/') ?>"><img src="../public/assets/images/icon_home.png"><p>accueil</p></a>
            <a href="<?php echo url('/annonces') ?>"><img src="../public/assets/images/icon_galerie.png"><p>galerie</p></a>
            <a href="<?php echo url('/recherche') ?>"><img src="../public/assets/images/icon_recherche.png"><p>chercher</p></a>
            <a href="<?php echo url('/galerie') ?>"><img src="../public/assets/images/icon_carte.png"><p>carte</p></a>
            <a href="<?php echo url('/galerie') ?>"><img src="../public/assets/images/icon_murs.png"><p>chasse au murs</p></a>
            <a href="<?php echo url('/contact') ?>"><img src="../public/assets/images/icon_contact.png"><p>contact</p></a>
        </div>
    </nav>

    <!-- HEADER -->
    <header >
        <span id="justify">
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
            <img src="../public/assets/images/icon_hamburguer.png" id="logoMenu">
        </span> 
    </header>
        <main>
            <section>
                <h3>AJOUTER UNE PHOTO</h3>
                <!-- CONVENTION LARAVEL POUR LE CREATE action="annonce/store" -->
                <!-- SI FORM SANS AJAX ALORS NE PAS OUBLIER method="POST" et enctype="multipart/form-data" --> 
                <form @submit.prevent="envoyerFormAjax" method="POST" action="annonce/store" enctype="multipart/form-data" class="formMembre">
                @csrf
                    <input type="text" name="titre" required placeholder="entrez votre titre">
                    <input type="file" name="photo" required placeholder="choisissez votre photo" class="inputUpload">
                    <input type="text" name="adresse" required placeholder="entrez votre adresse">
                    <button type="submit">PUBLIER PHOTO</button>
                    <div class="confirmation">
                    @{{ confirmation }}
                    </div>
                    <!-- RACCOURCI BLADE POUR AJOUTER UN CHAMP HIDDEN -->

                </form>
            </section>
            <section class="lightbox" v-if="annonceUpdate">
                <button @click="annonceUpdate = null">FERMER</button>
                <h3>FORMULAIRE DE MODIFICATION D'UNE ANNONCE</h3>
                <!-- CONVENTION LARAVEL POUR LE CREATE action="annonce/store" -->
                <!-- https://fr.vuejs.org/v2/guide/forms.html -->
                <form @submit.prevent="envoyerFormAjax" method="POST" action="annonce/modifier" enctype="multipart/form-data" class="formMembre">
                @csrf
                    <input type="text" v-model="annonceUpdate.titre" name="titre" required placeholder="entrez votre titre">
                    <input type="file" name="photo" placeholder="choisissez votre photo" class="inputUpload">
                    <img :src="annonceUpdate.photo">
                    <input type="text" v-model="annonceUpdate.adresse" name="adresse" required placeholder="entrez votre adresse">
                    <button type="submit">MODIFIER CETTE PHOTO (id=@{{ annonceUpdate.id }})</button>
                    <!-- ON UTILISE id POUR SELECTIONNER LA BONNE LIGNE SQL -->
                    <input type="hidden" name="id"  v-model="annonceUpdate.id">
                    <div class="confirmation">
                    @{{ confirmation }}
                    </div>
                    <!-- RACCOURCI BLADE POUR AJOUTER UN CHAMP HIDDEN -->
                    
                </form>
            </section>
            <section>
                <div class="listeAnnonce">
                    <article v-for="annonce in annonces">
                        <img :src="annonce.photo">
                        <h4>@{{ annonce.titre }}</h4>
                        <button @click.prevent="modifierAnnonce(annonce)"><img src="../public/assets/images/icon_modifier.png"></button>
                        <!-- COOL: AVEC VUEJS JE PEUX PASSER annonce COMME SI C'ETAIT UNE VARIABLE JS-->
                        <button @click.prevent="supprimerAnnonce(annonce)">supprimer</button>
                    </article>
                </div>
            </section>
        </main>
        <footer>
        <!-- IL Y A UN CONFLOT ENTRE BLADE ET VUEJS -->
        <!-- IL FAUT AJOUTER @ POUR QUE BLADE NE S'ACTIVE PAS SUR LES DELIMITEURS POUR VUEJS -->
            @{{ message }}
        </footer>
    </div><!-- fin du container #app -->

    <!-- CHARGER LE CODE DE VUEJS -->
    <!-- https://fr.vuejs.org/v2/guide/index.html -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="<?php echo url('/assets/js/main-membre.js') ?>"></script>
    <script src="<?php echo url('/assets/js/main.js') ?>"></script>

</body>
</html>