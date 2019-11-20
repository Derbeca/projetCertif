@include('layouts.header')
        <main>
            <section>
                <h3>AJOUTER UNE PHOTO</h3>
                <!-- CONVENTION LARAVEL POUR LE CREATE action="annonce/store" -->
                <!-- SI FORM SANS AJAX ALORS NE PAS OUBLIER method="POST" et enctype="multipart/form-data" --> 
                <form @submit.prevent="envoyerFormAjax" method="POST" action="annonce/store" enctype="multipart/form-data" class="formMembre">

                    <input type="text" name="titre" required placeholder="entrez votre titre">
                    <input type="file" name="photo" required placeholder="choisissez votre photo" class="inputUpload">
                    <input type="text" name="adresse" required placeholder="entrez votre adresse">
                    <button type="submit">PUBLIER PHOTO</button>
                    @csrf
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

                    <input type="text" v-model="annonceUpdate.titre" name="titre" required placeholder="entrez votre titre">
                    <input type="file" name="photo" placeholder="choisissez votre photo" class="inputUpload">
                    <img :src="annonceUpdate.photo">
                    <input type="text" v-model="annonceUpdate.adresse" name="adresse" required placeholder="entrez votre adresse">
                    <button type="submit">MODIFIER CETTE PHOTO (id=@{{ annonceUpdate.id }})</button>
                    <!-- ON UTILISE id POUR SELECTIONNER LA BONNE LIGNE SQL -->
                    <input type="hidden" name="id"  v-model="annonceUpdate.id">
                    @csrf
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

        @include('layouts.footer')