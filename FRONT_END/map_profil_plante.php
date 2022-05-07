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
        <!-- Permet l'affichage de la carte -->
        <div id="map"></div>

        <!-- Fichiers Javascript ////////////////////////////////////////////// -->
        <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
        <script type="text/javascript">
            // On initialise la latitude et la longitude du signalement (centre de la carte)
            var latcentre = 46.8347;
            var loncentre = 1.70529;
            var macarte = null;
            var marqueur = null;

            //// Initialisation de la carte
            function initMap() {
                macarte = L.map('map').setView([latcentre, loncentre], 6);
                // Récupération des cartes sur openstreetmap.fr par Leaflet
                L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                    // Lien vers la source des données
                    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                    minZoom: 1,
                    maxZoom: 20
                }).addTo(macarte);

                if(count($plante)!=1){
                    //foreach($plante as $coordonnees ){
                    $coordonnees.forEach($plante){
                        $pos = strpos( $coordonnees['Coordonnees_GPS'], "-");
                        $lat = doubleval(substr ($coordonnees['Coordonnees_GPS'], 0, $pos));
                        $long = doubleval(substr ($coordonnees['Coordonnees_GPS'], $pos+1, strlen($coordonnees['Coordonnees_GPS'])));

                        var marqueur = L.marker([$lat, $lon]).addTo(macarte);
                    }
                }
                // Centralisation de la carte au centre de la France
                macarte.panTo([latcentre, loncentre]);
            }
            window.onload = function(){
		        // Fonction d'initialisation
		        initMap(); 
                macarte.on('click', mapClickListen);
            };

        </script>
    </body>
</html>
