paramVue                = {};      // je crée un objet vide et ensuite je le remplis
paramVue.el             = '#app';
paramVue.data           = {
    annonceUpdate: null,  
    annonces: [],
    confirmation: '', 
    menuGenerale: false,
    menuLogin: false
};
paramVue.mounted = function () {
    // SIMULE UNE FAUSSE SUPPRESSION
    // BRICOLAGE POUR OBTENIR L'AFFICHAGE
    this.supprimerAnnonce({ id: -1});
};
/* paramVue.mounted = () => {
    // Open and close sidebar
/*     var sidebar = document.querySelector("#mySidebar");
    var boutonMenu = document.querySelector("#logoMenu, #logoMenuB");
    boutonMenu.addEventListener('click', (event) => {
      console.log('tu as clické');
      sidebar.style.display = "block";
    });
    var boutonFermer = document.querySelector("#logoFermer");
    boutonFermer.addEventListener('click', (event) => {
      console.log('tu as clické');
      sidebar.style.display = "none";
    }); */
    // function w3_close() {
    //   document.getElementById("mySidebar").style.display = "none";
    // }

    // Menu login
   
/*     var btnLogin = document.querySelector('#login img');
    var menu = document.querySelector('ul');

    btnLogin.addEventListener('click', (event) => {
        menu.classList.add('montrer');
    });
    menu.addEventListener('click', (event) => {
        menu.classList.remove('montrer');
    }); 

}, */
paramVue.methods = {
    modifierAnnonce: function(annonce) {
        // debug
        console.log(annonce);
        // JE MEMORISE L'ANNONCE A MODIFIER DANS UNE VARIABLE VUEJS
        this.annonceUpdate = annonce;
      },
      supprimerAnnonce: function (annonce) {
        // debug
        console.log(annonce);
        // JE PEUX RECUPERER id A SUPPRIMER
        var formData = new FormData();
        // JE SIMULE EN JS LES INFOS DU FORMULAIRE
        formData.append('id', annonce.id);
        // sécurité laravel
        // https://laravel.com/docs/5.8/csrf#csrf-x-csrf-token
        formData.append('_token', '{{ csrf_token() }}');
        fetch('annonce/supprimer', {
            method: 'POST',
            body: formData
        })
        .then(function(reponse) {
              // ON CONVERTIT LE MESSAGE DE REPONSE EN OBJET JSON
              return reponse.json();
          })
        .then(function(reponseObjetJSON) {
            if (reponseObjetJSON.confirmation)
            {
                // ON VA STOCKER LA CONFORMATION DANS UNE VARIABLE VUEJS
                app.confirmation = reponseObjetJSON.confirmation;
            }
            if (reponseObjetJSON.annonces)
            {
                // ON VA STOCKER LA CONFORMATION DANS UNE VARIABLE VUEJS
                app.annonces = reponseObjetJSON.annonces;
            }
        });
      },
      envoyerFormAjax: function (event) {
          // debug
          console.log(event.target);
          // JE VEUX RECUPERER LES INFORMATIONS REMPLIES PAR LE MEMBRE
          var formData = new FormData(event.target);
          // JE REPRENDS L'URL DANS LE HTML
          var urlAction = event.target.getAttribute('action');
          // ET ON ENVOIE LES INFOS VERS LA MEME URL
          fetch(urlAction, {
              method: 'POST',
              body: formData
          })
          .then(function(reponse) {
              // ON CONVERTIT LE MESSAGE DE REPONSE EN OBJET JSON
              return reponse.json();
          })
          .then(function(reponseObjetJSON) {
                if (reponseObjetJSON.confirmation)
                {
                    // ON VA STOCKER LA CONFORMATION DANS UNE VARIABLE VUEJS
                    app.confirmation = reponseObjetJSON.confirmation;
                }
                if (reponseObjetJSON.annonces)
                {
                    // ON VA STOCKER LA CONFORMATION DANS UNE VARIABLE VUEJS
                    app.annonces = reponseObjetJSON.annonces;
                }
          });
      },

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


