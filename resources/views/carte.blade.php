<html>
<head>
<title>Martseille</title>
<meta charset="utf-8">
<link rel="stylesheet" href="<?php echo url('/assets/css/style.css') ?>">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
  integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
  crossorigin=""></script>
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>



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
                <img src="../public/assets/images/logo_martseille.svg">
            </a>
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
        </span> 
    </header>
<div class="container">

<!--     <b>Coordinates</b>
    <form>
    <input type="text" name="lat" id="lat" size=12 value="">
    <input type="text" name="lon" id="lon" size=12 value="">
    </form>

    <div id="search">
        <input type="text" name="addr" value="" id="addr" size="58" />
        <button type="button" onclick="addr_search();">Search</button>
        <div id="results"></div>
    </div>
    </br> -->

    <div id="map"></div>
</div>
    <footer>
        <a href="<?php echo url('/recherche') ?>" id="logoRecherche"><img src="../public/assets/images/icon_rechercheNoir.png"></a>
        
        <a href="<?php echo url('/espace-membre') ?>" id="logoCarte"><img src="../public/assets/images/icon_carteNoir.png"></a>
    </footer>
    </div><!-- FIN DU CONTAINER POUR VUEJS -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="<?php echo url('/assets/js/main.js') ?>"></script>
    <?php
        use App\Annonce;
        
        $tabPosition = \App\Position
                            ::with('annonce')
                            ->latest("positions.updated_at")   // CONSTRUCTION DE LA REQUETE
                            ->get();                 // JE VEUX OBTENIR LES RESULTATS
        
        // debug
        // print_r($tabAnnonce)
    
    
    ?>

<script type="text/javascript">

var map = L.map('map').setView([43.29617430, 5.36995250], 13);

L.tileLayer( 'https://api.mapbox.com/styles/v1/mapbox/streets-v10/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZGVyYmVjYSIsImEiOiJjazl6c2pvZzcwMmhmM2l0NnkyODhpc3NzIn0.rueU4bSnS3Or5OsW8EtYCg', {
   maxZoom: 18,
   attribution: 'Map data &copy; <a href="http://openstreetmap.org/"> OpenStreetMap </a> contributors, ' +
    '<a href="http://creativecommons.org/"> CC-BY-SA </a>, ' +
    'Imagery � <a href="http://mapbox.com">Mapbox</a>',
   id: 'examples.map-i875mjb7'
  }).addTo(map);
  
  $( document ).ready(function() {
   addMarkeurs();     
  });
  
  function addMarkeurs() {
   for(var i=0; i<positions.length; i++) {

    var marker = L.marker( [positions[i]['lat'], positions[i]['long']]).addTo(map);
    marker.bindPopup('<img src="' +  positions[i].annonce.photo + '"/p>');
   }
  };

  var positions = @json($tabPosition);

  console.log(positions);





/* var myMarker = L.marker([startlat, startlon], {title: "Coordinates", alt: "Coordinates", draggable: true}).addTo(map).on('dragend', function() {
 var lat = myMarker.getLatLng().lat.toFixed(8);
 var lon = myMarker.getLatLng().lng.toFixed(8);
 var czoom = map.getZoom();
 if(czoom < 18) { nzoom = czoom + 2; }
 if(nzoom > 18) { nzoom = 18; }
 if(czoom != 18) { map.setView([lat,lon], nzoom); } else { map.setView([lat,lon]); }
 document.getElementById('lat').value = lat;
 document.getElementById('lon').value = lon;
 myMarker.bindPopup("Lat " + lat + "<br />Lon " + lon).openPopup();
});

function chooseAddr(lat1, lng1)
{
 myMarker.closePopup();
 map.setView([lat1, lng1],18);
 myMarker.setLatLng([lat1, lng1]);
 lat = lat1.toFixed(8);
 lon = lng1.toFixed(8);
 document.getElementById('lat').value = lat;
 document.getElementById('lon').value = lon;
 myMarker.bindPopup("Lat " + lat + "<br />Lon " + lon).openPopup();
}

function myFunction(arr)
{
 var out = "<br />";
 var i;

 if(arr.length > 0)
 {
  for(i = 0; i < arr.length; i++)
  {
   out += "<div class='address' title='Show Location and Coordinates' onclick='chooseAddr(" + arr[i].lat + ", " + arr[i].lon + ");return false;'>" + arr[i].display_name + "</div>";
  }
  document.getElementById('results').innerHTML = out;
 }
 else
 {
  document.getElementById('results').innerHTML = "Sorry, no results...";
 }

}

function addr_search()
{
 var inp = document.getElementById("addr");
 var xmlhttp = new XMLHttpRequest();
 var url = "http://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + inp.value;
 xmlhttp.onreadystatechange = function()
 {
   if (this.readyState == 4 && this.status == 200)
   {
    var myArr = JSON.parse(this.responseText);
    myFunction(myArr);
   }
 };
 xmlhttp.open("GET", url, true);
 xmlhttp.send();
} */

</script>
</body>
</html>