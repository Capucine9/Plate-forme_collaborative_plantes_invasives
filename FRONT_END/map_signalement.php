<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />  
        <link rel="stylesheet" type="text/css" href="css/my-login.css"> 
        <link href ="css/bootstrap.css" rel="stylesheet" type="text/css"/>    
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" 
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
        <script src="https://kit.fontawesome.com/6b6c1dbe0e.js" crossorigin="anonymous"></script>    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"   
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">  
        <link rel="stylesheet" href="pageaccueil.css">
        <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" 
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
        <style type="text/css">
            /* Map */
            #map{
                height : 600px;
                width : 600px; 
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </head>
    <body>
        <!-- Recherche d'une ville et affichage de la latitude et la longitude de la position -->
        <div>
            <label for="input_ville">Rechercher une ville sur la carte : </label>
            <input type="text" id="input_ville" name="ville" class="form-control">
        </div>
        <div>
            <!-- Récupération des latitudes et longitudes dans des input pour vérifier que le champ est bien rempli--> 
            <input type="hidden" name="lat" id="lat" readonly>
            <input type="hidden" name="lon" id="lon" readonly>

            <!-- Bouton de recherche de ville à partir des coordonnées 
            <button type="invisible" onclick="search();" name="search">search</button>
            <p id="output"></p>-->
        </div>
        <br/>
        
        <!-- Permet l'affichage de la carte -->
        <div id="map"></div>


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
                // Création d'un marqueur non déplaçable aux coordonnées "pos"
                marqueur = L.marker(
                    pos, {
                        draggable: false
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

        </script>
    </body>
</html>
