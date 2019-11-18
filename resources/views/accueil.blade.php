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
    <div id="container">
        <!-- MENU DEPLIANT CACHÉ-->
        <nav class="w3-sidebar w3-animate-top w3-black"  style="display:none" id="mySidebar">
            <a href="javascript:void(0)" class="w3-button w3-xxlarge w3-padding" style="padding:6px 24px">
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
        <header class="w3-opacity">
            <span class="w3-button w3-xxlarge  w3-right"><i class="fa fa-bars" id="logoMenu"></i></span> 
            <div class="w3-clear"></div>
            <div id="entete">
                <a href="<?php echo url('/') ?>" id="logo"><img src="../public/assets/images/logo_martseille.png"></a>
            </div>
        </header>
        <main>
        </main>
        <footer>
            <a href="<?php echo url('/espace-membre') ?>" id="btn-plus"><img src="../public/assets/images/bouton_plus.png"></a>
    <!--         <nav>
                <ul>
                    <li><a href="<?php echo url('/espace-membre') ?>">membre</a></li>
                    <li><a href="<?php echo url('/espace-admin') ?>">admin</a></li>
                </ul>
            </nav>
            <p>tous droits réservés 2019</p> -->
        </footer>
    </div><!-- FIN DU CONTAINER POUR VUEJS -->
    </div>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="<?php echo url('/assets/js/main.js') ?>"></script>

</body>
</html>