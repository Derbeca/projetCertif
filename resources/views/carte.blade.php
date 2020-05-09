<html>
<head>
<title>Leaflet Address Lookup and Coordinates</title>
<meta charset="utf-8">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
  integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
  crossorigin=""></script>
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>


<style type="text/css">
html, body { width:100%;padding:0;margin:0; }
.container { width:95%;max-width:980px;padding:1% 2%;margin:0 auto }
#lat, #lon { text-align:right }
#map { width:100%;height:80%;padding:0;margin:0; }
.address { cursor:pointer }
.address:hover { color:#AA0000;text-decoration:underline }
</style>
</head>
<body>
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

<script type="text/javascript">


// Marseille
/* var startlat = 43.29617430;
var startlon = 5.36995250; */





/* document.getElementById('lat').value = startlat;
document.getElementById('lon').value = startlon; */

var map = L.map('map').setView([43.29617430, 5.36995250], 13);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'your.mapbox.access.token'
}).addTo(map);
  
  $( document ).ready(function() {
   addMarkeurs();     
  });
  
  function addMarkeurs() {
   for(var i=0; i<positions.length; i++) {
    var marker = L.marker( [positions[i]['lat'], positions[i]['long']]).addTo(map);
    marker.bindPopup( "<b>" + positions[i]['id']+"</b><br>Details:" + positions[i]['annonce_id']);
   }
  }
  
  function stringToGeoPoints( geo ) {
   var linesPin = geo.split(",");

   var linesLat = new Array();
   var linesLng = new Array();

   for(i=0; i < linesPin.length; i++) {
    if(i % 2) {
     linesLat.push(linesPin[i]);
    }else{
     linesLng.push(linesPin[i]);
    }
   }

   var latLngLine = new Array();

   for(i=0; i<linesLng.length;i++) {
    latLngLine.push( L.latLng( linesLat[i], linesLng[i]));
   }
   
   return latLngLine;
  }
  
  
  
  var positions = @json($positions);
  positions = JSON.parse(positions);
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