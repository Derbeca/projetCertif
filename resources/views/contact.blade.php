@include('layouts.header')
<!-- <div id="app"> -->
    <main>
        <section>
            <h3>FORMULAIRE DE CONTACT</h3>
            <form @submit.prevent="envoyerFormAjax" method="POST" action="contact/store">
                <input type="email" name="email" required placeholder="entrez votre email">
                <input type="text" name="nom" required placeholder="entrez votre nom">
                <textarea name="message" placeholder="entrez votre message"></textarea>
                <button type="submit">ENVOYER MESSAGE</button>
                <div class="confirmation">
                @{{ confirmation }}
                </div>
                @csrf
        </section>
    </main>
</div>
<!-- FIN ESPACE VUE JS -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
// ON PEUT ENSUITE COMMENCER A UTILISER VUEJS
var app = new Vue({
  el: '#app',

  methods: {

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
    annonces: [],
    confirmation: 'ici on verra le message de confirmation',  
    message: 'Hello Vue !'
  }
});
    </script>
