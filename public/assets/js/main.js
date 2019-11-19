paramVue                = {};      // je crée un objet vide et ensuite je le remplis
paramVue.el             = '#app';
paramVue.data           = {
  annonces: [],       // MA VARIABLE VUEJS QUI GARDE EN MEMOIRE LA LISTE DES ANNONCES
  message: 'Hello Vue !',
};
paramVue.mounted = () => {
    // Open and close sidebar
    var sidebar = document.querySelector("#mySidebar");
    var boutonMenu = document.querySelector("#logoMenu");
    boutonMenu.addEventListener('click', (event) => {
      console.log('tu as clické');
      sidebar.style.width = "100%";
      sidebar.style.display = "block";
    });
    var boutonFermer = document.querySelector("#logoFermer");
    boutonFermer.addEventListener('click', (event) => {
      console.log('tu as clické');
      sidebar.style.display = "none";
    });
    // function w3_close() {
    //   document.getElementById("mySidebar").style.display = "none";
    // }

    // Menu login
    function montrerMenuLogin() {
      var btnLogin = document.querySelector('#login');
      var menu = document.querySelector('ul');
      btnLogin.addEventListener('click', (event) => {
          menu.classList.add('montrer');
      });
    };
    montrerMenuLogin();

    // function cacherMenuLogin() {
    //   var menu = document.querySelector('ul');
    //   menu.addEventListener('click', (event) => {
    //     menu.classList.remove('montrer');
    //   });
    // };
    // cacherMenuLogin();
},
paramVue.methods = {
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
    },
  }
  var app = new Vue(paramVue);


