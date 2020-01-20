<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Martseille</title>

    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="<?php echo url('/assets/css/style.css') ?>">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" />

</head>
<body>
<div id="app">
<!-- MENU DEPLIANT CACHÉ-->
<transition name="fade">
    <nav id="mySidebar" v-show="menuGenerale">
        <div @click="menuGenerale = false">
            <img src="../public/assets/images/icon_fermer.png" class="logoFermer">
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
    <header >
        <span id="justify">
            <a href="<?php echo url('/') ?>" id="logo">
                <img src="../public/assets/images/logo_martseille.png">
            </a>
            <div id="login">
                <div  @click="menuLogin = !menuLogin">
                    <img src="../public/assets/images/icon_login.png" id="logoLogin">
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
                    <img src="../public/assets/images/icon_hamburguer.png" id="logoMenu">
                </div>
            </div>
        </span> 
    </header>