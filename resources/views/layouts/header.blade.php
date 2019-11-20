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
<!-- MENU DEPLIANT CACHÉ-->
    <nav id="mySidebar">
        <img src="../public/assets/images/icon_fermer.png" id="logoFermer">
        <div id="menuAccueil">
            <a href="<?php echo url('/') ?>"><img src="../public/assets/images/icon_home.png"><p>accueil</p></a>
            <a href="<?php echo url('/annonces') ?>"><img src="../public/assets/images/icon_galerie.png"><p>galerie</p></a>
            <a href="<?php echo url('/recherche') ?>"><img src="../public/assets/images/icon_recherche.png"><p>chercher</p></a>
            <a href="<?php echo url('/galerie') ?>"><img src="../public/assets/images/icon_carte.png"><p>carte</p></a>
            <!-- <a href="<?php echo url('/register') ?>">inscription</a> -->
<!--             <a href="<?php echo url('/espace-membre') ?>">espace membre</a> -->
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
            <div id="login">
                <img src="../public/assets/images/icon_login.png">
                <ul id="menu">
                    <li><a href="<?php echo url('/register') ?>">Inscription</a></li>
                    <li><a href="<?php echo url('/login') ?>">Connexion</a></li>
                    <li><a href="<?php echo url('/espace-membre') ?>">Mon espace</a></li>
                </ul>
            </div>
            <img src="../public/assets/images/icon_hamburguer.png" id="logoMenu">
        </span> 
        <div></div>
    </header>