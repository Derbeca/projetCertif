@include('layouts.header')
<!-- <div id="app"> -->
        <main>
            <section>
                <h3>PUBLIER UNE PHOTO</h3>
    <!-- CONVENTION LARAVEL POUR LE CREATE action="annonce/store" -->
    <!-- SI FORM SANS AJAX ALORS NE PAS OUBLIER method="POST" et enctype="multipart/form-data" --> 
    <form @submit.prevent="envoyerFormAjax" method="POST" action="annonce/store" enctype="multipart/form-data">

        <input type="file" name="photo" id="inputPhoto" required placeholder="choisissez votre photo">
        <input type="text" name="titre" required placeholder="entrez votre titre">
        <select name="categorie" required placeholder="choisissez une categorie">
            <option>choisissez une categorie</option>
            <option value="graffiti">Graffiti</option>
            <option value="pochoir">Pochoir</option>
            <option value="sticker">Sticker</option>
            <option value="installation">Installation</option>
            <option value="mur vide">Mur vide</option>
            <option value="evenement">Evenement</option>
            <option value="autre">Autre</option>
        </select>
        <button type="submit">PUBLIER</button>
        <div class="confirmation">
        @{{ confirmation }}
        </div>
        <!-- RACCOURCI BLADE POUR AJOUTER UN CHAMP HIDDEN -->
        @csrf
    </form>
            </section>
            <section class="lightbox" v-if="annonceUpdate">
                <div @click="annonceUpdate = null"><img src="../public/assets/images/icon_fermer.png" class="logoFermer"></div>
                <h3>MODIFIER UNE PHOTO</h3>
    <!-- CONVENTION LARAVEL POUR LE CREATE action="annonce/store" -->
    <!-- https://fr.vuejs.org/v2/guide/forms.html -->
    <form @submit.prevent="envoyerFormAjax" method="POST" action="annonce/modifier" enctype="multipart/form-data">
        <input type="file" name="photo" placeholder="choisissez votre photo">
        <img :src="annonceUpdate.photo">
        <input type="text" v-model="annonceUpdate.titre" name="titre" required placeholder="entrez votre titre">
        <input type="text" v-model="annonceUpdate.adresse" name="adresse" required placeholder="entrez votre adresse">
        <select name="categorie" required placeholder="choisissez une categorie">
            <option>choisissez une categorie</option>
            <option value="graffiti">Graffiti</option>
            <option value="pochoir">Pochoir</option>
            <option value="sticker">Sticker</option>
            <option value="installation">Installation</option>
            <option value="mur vide">Mur vide</option>
            <option value="evenement">Evenement</option>
            <option value="autre">Autre</option>
        </select>
        <button type="submit">MODIFIER</button>
        <!-- ON UTILISE id POUR SELECTIONNER LA BONNE LIGNE SQL -->
        <input type="hidden" name="id"  v-model="annonceUpdate.id">
        <div class="confirmation">
        @{{ confirmation }}
        </div>
        <!-- RACCOURCI BLADE POUR AJOUTER UN CHAMP HIDDEN -->
        @csrf
    </form>
            </section>
            <section class="lightbox" v-if="annonceLocation">
                <div @click="annonceLocation = null"><img src="../public/assets/images/icon_fermer.png" class="logoFermer"></div>
                <h3>PLACER UNE PHOTO</h3>
    <!-- CONVENTION LARAVEL POUR LE CREATE action="annonce/store" -->
    <!-- https://fr.vuejs.org/v2/guide/forms.html -->
    <form @submit.prevent="envoyerFormAjax" method="POST" action="position/store">
        <p>Tu peux entrez une adresse</p>

        <p>ou géolocaliser ta position</p>
        <button @click="myFunction()">GÉOCALISER</button>

        
        <input type="text" name="lat" id="lat" v-model="lat">
        <input type="text" name="long" id="long" v-model="long">
        <button type="submit">PLACER</button>
        <!-- ON UTILISE id POUR SELECTIONNER LA BONNE LIGNE SQL -->
        <input type="hidden" name="id"  v-model="annonceLocation.id">
        <div class="confirmation">
        @{{ confirmation }}
        </div>
        <!-- RACCOURCI BLADE POUR AJOUTER UN CHAMP HIDDEN -->
        @csrf
    </form>
            </section>

        <!-- AFFICHER LA LISTE D'ANNONCES-->
            <section>
                <h3>LISTE DE MES ANNONCES</h3>
                <div class="listeAnnonce">
                    <article v-for="annonce in annonces">
                        <img :src="annonce.photo">
                        <div id="contenu">
                            <h4>@{{ annonce.titre }}</h4>
                            <p>@{{ annonce.categorie }}</p>
                            <p>@{{ annonce.adresse }}</p>
                        </div>
                        <div id="btns">
                            <button @click.prevent="modifierAnnonce(annonce)"><img src="../public/assets/images/icon_modifier.png" alt="bouton modifier" title="modifier"></button>
                            <!-- COOL: AVEC VUEJS JE PEUX PASSER annonce COMME SI C'ETAIT UNE VARIABLE JS-->
                            <button @click.prevent="supprimerAnnonce(annonce)"><img src="../public/assets/images/icon_supprimer.png" alt="bouton supprimer" title="supprimer"></button>
                            <button @click.prevent="placerAnnonce(annonce)"><img src="../public/assets/images/icon_placer.svg" alt="bouton placer" title="placer"></button>
                        </div>
                    </article>
                </div>
            </section>
        </main>

        <footer>
            <a href="<?php echo url('/recherche') ?>" id="logoRecherche"><img src="../public/assets/images/icon_rechercheNoir.png"></a>
            <a href="<?php echo url('/espace-membre') ?>" id="logoCarte"><img src="../public/assets/images/icon_carteNoir.png"></a>
        </footer>
        </div><!-- FIN DU CONTAINER POUR VUEJS -->
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

        <script>
// ON PEUT ENSUITE COMMENCER A UTILISER VUEJS
var app = new Vue({
  el: '#app',
  // https://fr.vuejs.org/v2/guide/instance.html#Hooks-de-cycle-de-vie-d%E2%80%99une-instance
  mounted: function () {
      // SIMULE UNE FAUSSE SUPPRESSION
      // BRICOLAGE POUR OBTENIR L'AFFICHAGE
      this.supprimerAnnonce({ id: -1});
  },
  methods: {
      modifierAnnonce: function(annonce) {
        // debug
        console.log(annonce);
        // JE MEMORISE L'ANNONCE A MODIFIER DANS UNE VARIABLE VUEJS
        this.annonceUpdate = annonce;
      },
      placerAnnonce: function(annonce) {
        // debug
        console.log(annonce);
        // JE MEMORISE L'ANNONCE A MODIFIER DANS UNE VARIABLE VUEJS
        this.annonceLocation = annonce;
      },

      myFunction: function () {		
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(this.showPosition);
        }else{
            this.erreur = "Geolocation is not supported."; 
	    }
      },
	  showPosition:function (position) {	
		this.lat = position.coords.latitude;
		this.long = position.coords.longitude;
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
      }
  },
  data: {
      // ICI JE RAJOUTE LES VARIABLES GEREES PAR VUEJS
    annonceUpdate: null, 
    annonceLocation: null,  
    annonces: [],
    confirmation: '',  
    message: 'Hello Vue !',
    menuGenerale: false,
    menuLogin: false,
    error: '',
	lat:'',
	lon:''
  }
});
    </script>
</body>
</html>
