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
        <header id="headerAccueil">
            <img src="../public/assets/images/icon_hamburguer.png" id="logoMenu">
            <div id="entete">
                <a href="<?php echo url('/') ?>" id="logoAccueil"><img src="../public/assets/images/logo_martseille.png"></a>
            </div>
        </header>
        <main>
        </main>
        <footer id="footerAccueil">
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