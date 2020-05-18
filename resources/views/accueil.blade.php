<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Martseille</title>
    <link rel="stylesheet" href="<?php echo url('/assets/css/style.css') ?>">

</head>
<body>
    <div id="app">
    <div id="container">
        <!-- MENU DEPLIANT CACHÉ-->
        <transition name="fade">
        <nav id="mySidebar" v-show="menuGenerale">
        <div @click="menuGenerale = false">
            <img src="../public/assets/images/icon_fermer.png" id="logoFermer">
        </div>
        <div id="menuAccueil">
            <a href="<?php echo url('/') ?>"><img src="../public/assets/images/icon_home.png"><p>accueil</p></a>
            <a href="<?php echo url('/annonces') ?>"><img src="../public/assets/images/icon_galerie.png"><p>galerie</p></a>
            <a href="<?php echo url('/recherche') ?>"><img src="../public/assets/images/icon_recherche.png"><p>chercher</p></a>
            <a href="<?php echo url('/carte') ?>"><img src="../public/assets/images/icon_carte.png"><p>carte</p></a>
            <!-- <a href="<?php echo url('/register') ?>">inscription</a> -->
<!--             <a href="<?php echo url('/espace-membre') ?>">espace membre</a> -->
            <a href="<?php echo url('/galerie') ?>"><img src="../public/assets/images/icon_murs.png"><p>chasse au murs</p></a>
            <a href="<?php echo url('/contact') ?>"><img src="../public/assets/images/icon_contact.png"><p>contact</p></a>
        </div>
        </nav>
        </transition>

        <!-- HEADER -->
        <header id="headerAccueil">
        <div id="login">
                <div  @click="menuLogin = !menuLogin">
                    <img src="../public/assets/images/icon_login.svg" id="logoLogin">
                </div>
                <transition name="fade">
                <ul id="menu" v-show="menuLogin">
                    <li><a href="<?php echo url('/register') ?>">Inscription</a></li>
                    <li><a href="<?php echo url('/login') ?>">Connexion</a></li>
                    <li>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Déconnexion') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li><a href="<?php echo url('/espace-membre') ?>">Mon espace</a></li>
                </ul>
                </transition>
                <div @click="menuGenerale = !menuGenerale">
                    <img src="../public/assets/images/icon_burguer.svg" id="logoMenu">
                </div>
            </div>
            <div id="entete">
                <a href="<?php echo url('/') ?>" id="logoAccueil"><img src="../public/assets/images/logo_martseille.svg"></a>
            </div>
        </header>
        </div>
        <main>
            <div id="monTexte">
                <p>
                «Marseille est une place du graffiti reconnue mondialement. Les street-artistes ont fait la renommée de quartiers tels que le Cours Julien ou le Panier. Aujourd’hui, les pouvoirs publics y voient un facteur d’attractivité tout en luttant contre le graff vandale.» 
                </p>
                <p id="source">(Made in Marseille, 22/02/19)</p>
            </div>
        </main>

        <footer id="footerAccueil">
    <!--         <nav>
                <ul>
                    <li><a href="<?php echo url('/espace-membre') ?>">membre</a></li>
                    <li><a href="<?php echo url('/espace-admin') ?>">admin</a></li>
                </ul>
            </nav>
            <p>tous droits réservés 2019</p> -->
        </footer>
    </div><!-- FIN DU CONTAINER POUR VUEJS -->

        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="<?php echo url('/assets/js/main.js') ?>"></script>

</body>
</html>