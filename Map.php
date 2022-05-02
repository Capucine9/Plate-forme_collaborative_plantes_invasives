<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
        <style type="text/css">
            /* Map */
            #map{
                height : 600px;
                width : 600px; 
                margin-left: auto;
                margin-right: auto;
            }
        </style>
        <title>Map</title>
    </head>
    <body>
        <div id="map">
	    </div>

    <!-- Recherche d'une ville et affichage de la latitude et la longitude de la position -->
    <div>
        <label for="input_ville">Ville : </label>
        <input type="text" id="input_ville">
    </div>
    <div>
        <label for="lat">Latitude</label>
        <input type="text" name="lat" id="lat" readonly>
    </div>
    <div>
        <label for="lon">Longitude</label>
        <input type="text" name="lon" id="lon" readonly>
    </div>


    <div>
        <button onclick="search();" name="search">search</button>
        <p id="output"></p>
    </div>


    <!-- Fichiers Javascript ////////////////////////////////////////////// -->
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
	<script type="text/javascript">
            // On initialise la latitude et la longitude de Paris (centre de la carte)
            var lat = 48.852969;
            var lon = 2.349903;
            var macarte = null;
            var marqueur = null;
            let ville = "";

            // Permet de stocker les variables latitude et longitude retournées
            var latitudes;
            var longitudes;

            //// Initialisation de la carte
            function initMap() {
                macarte = L.map('map').setView([lat, lon], 9);
                // Récupération des cartes sur openstreetmap.fr par Leaflet
                L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                    // Lien vers la source des données
                    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                    minZoom: 1,
                    maxZoom: 20
                }).addTo(macarte);
            }

            //// Géolocalisation de l'utilisateur
            function geoloc(){ 
                var geoSuccess = function(position) { // Si l'utilisateur accepte la géolocalisation
                    startPos = position;
                    userlat = startPos.coords.latitude;
                    userlon = startPos.coords.longitude;
                    // Ajout d'un marqueur
                    var marqueur = L.marker([userlat, userlon]).addTo(macarte);
                    ville = [userlat, userlon];

                    // Centralisation de la carte sur la position
                    macarte.panTo(ville);

                    // Affichage des coordonnées dans le formulaire
                    document.querySelector("#lat").value=userlat;
                    latitudes = userlat;
                    document.querySelector("#lon").value=userlon;
                    longitudes = userlon;
                };
                var geoFail = function(){ // Si l'utilisateur refuse la géolocalisation
                    window.alert("Vous avez refusé la géolocalisation.");
                };
                // Demande d'accord 
                navigator.geolocation.getCurrentPosition(geoSuccess,geoFail);
            }

            let champVille = document.getElementById('input_ville');
            champVille.addEventListener("change", function(){
            })

            //// Recherche d'une ville
            // Appel Ajax vers une url et retour d'une promesse
            function ajaxGet(url){
                return new Promise(function(resolve, reject){
                    let xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function(){
                        if(xmlhttp.readyState == 4){
                            if(xmlhttp.status == 200){
                                // Résolution de la promesse et envoie de la réponse
                                resolve(xmlhttp.responseText);
                            }else{
                                // Si erreur
                                reject(xmlhttp);
                            }
                        }
                    }

                    // En cas d'erreur
                    xmlhttp.onerror = function(error){
                        reject(error);
                    }

                    // Ouverture et envoie de la requête
                    xmlhttp.open('GET', url, true);
                    xmlhttp.send(null);
                })
            }

            champVille.addEventListener("change", function(){
                // Envoie de la requête ajax vers nominatim
                ajaxGet(`https://nominatim.openstreetmap.org/search?q=${this.value}&format=json&addressdetails=1&limit=1&polygon_svg=1`).then(reponse => {
                    // Conversion en objet Javascript
                    let data = JSON.parse(reponse);
                    ville = [data[0].lat, data[0].lon];

                    // Centralisation de la carte sur la ville
                    macarte.panTo(ville);
                })
            })


            //// Placer un marqueur "au clic"
            function mapClickListen(e) {
                // Récupèration des coordonnées du clic et ajout d'un marqueur
                pos = e.latlng;
                addMarker(pos);

                // Affichage des coordonnées dans le formulaire
                document.querySelector("#lat").value=pos.lat;
                latitudes = pos.lat;
                document.querySelector("#lon").value=pos.lng;
                longitudes = pos.lng;
            }

            ////Gérer le déplacement du marqueur
            function addMarker(pos){
                // Suppression du marqueur s'il existe déjà
                if (marqueur != undefined) {
                    macarte.removeLayer(marqueur);
                }

                // Création d'un marqueur déplaçable aux coordonnées "pos"
                marqueur = L.marker(
                    pos, {
                        draggable: true
                    }
                )

                // Mise à jour des coordonnées
                marqueur.on('dragend', function(e) {
                    pos = e.target.getLatLng();
                    document.querySelector("#lat").value=pos.lat;
                    latitudes = pos.lat;
                    document.querySelector("#lon").value=pos.lng;
                    longitudes = pos.lng;
                });
                marqueur.addTo(macarte);
            }


            window.onload = function(){
		        // Fonction d'initialisation
		        initMap(); 
                geoloc();
                macarte.on('click', mapClickListen);
            };

            
            //Récupération d'une ville à partir de coordonnées
            var rue;
            window.cb = function cb(json) {
                // La route et la ville ont été trouvées par GoogleStreetMap
                if (json.address.road != undefined && json.address.city != undefined) {
    	            document.getElementById('output').innerHTML = json.address.road + ' à ' + json.address.city;
                }
                // La route n'a pas été trouvée par GoogleStreetMap
                else if (json.address.road == undefined && json.address.city != undefined){
                    document.getElementById('output').innerHTML = json.address.city;
                }
                // La ville n'a pas été trouvée par GoogleStreetMap
                else {
                    rue = json.address.road;
                  
                    /*// Recherche des coordonnees sur le cercle autour des coordonnées (latitude, longitude données par l'utilisateur)
                    var n = 1;  // nombre de points equidistants sur le cercle
                    for (r=0; r<1/100; r+=1/1000){ // rayon du cercle
                        n += 1;
                        //console.log("-" + json.address.city )
                        var i = 0;
                        while (json.address.city == undefined && i<2*Math.PI){

                            latitudes += r * Math.cos(i);
                            longitudes += r * Math.sin(i);
            
                            search();

                            i+=Math.PI/n;

                        }
                        if ( json.address.city != undefined) {break}
                    }
                    document.getElementById('output').innerHTML = rue + json.address.city;*/
                    document.getElementById('output').innerHTML = rue + ", la ville n'a pas été trouvé par OpenStreetMap.";
                }
            }
            
            // Récupération de la route et de la ville par GoogleStreetMap à l'aide de la latitude et de la longitude
            window.search = function search() {
                var recherche = document.createElement('script');       
                recherche.src = 'http://nominatim.openstreetmap.org/reverse?json_callback=cb&format=json&lat='+latitudes+'&lon='+longitudes+'&zoom=27&addressdetails=1';
                document.getElementsByTagName('head')[0].appendChild(recherche);
            };

        </script>
    </body>
</html>

<!--
    bonnes latitudes et longitudes -> latitudes / longitudes
    et rue et ville dans le 'output'-->