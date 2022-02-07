<!DOCTYPE html>
<html>
    <head>
        <title>Profil Plante</title>
        <meta charset="utf-8">
        <link href="test.css" rel="stylesheet" type="text/css" media="all" />
    </head>
    <body>
        <div id="header">Plate-forme collaborative de lutte contre les plantes invasives</div>


        <!--menu déroulant-->
        <div class="deroulant">
            <button id="menu" onclick="deroule()"> Menu </button>   <!--voir pour fonction onclick en js-->
            <div id="partie" class="partie" >
                <a href="">Accueil</a>
                <a href="profil_utilisateur.php">Votre profil</a>
                <a href="">Les plantes</a>
                <a href="">Les utilisateurs</a>
                <a href="">Les derniers signalements</a>
                <a href="">Signaler une plante</a>
                <a href="">Ajouter une plante</a>
                <a href="">Vos amis</a>
            </div>
        </div>
        <script>
            function deroule(){
                document.getElementById("partie").classList.toggle("show");
            }

        </script>
        
            
            


        <form>
            <h1 style="text-align:center"> Nom de la plante </h1> <!-- récupéré dans bdd-->
            <img src  > <!--mettre photo de la bdd et voir avec js pour faire des flèches pour faire défiler les images s'il y en a plusieurs-->
            <br/>
            
            <div class="renseignement">
                <div id="titre">
                Nom latin : 
                </div>
                <output name="nomlat">test</output> <!--mettre bdd-->
            </div>
            <div class="renseignement">
                <div id="titre">
                Nom français :
                </div>
                <output name="nomfr">test</output> <!--mettre bdd-->
            </div>
            <div class="renseignement">
                <div id="titre">
                Taille moyenne :
                </div>
                <output name="taille">5 cm</output> <!--mettre bdd-->
            </div>
            <div class="renseignement">
                <div id="titre">
                Couleur principale :
                </div>
                <output name="taille">vert</output> <!--mettre bdd-->
            </div>
            <div class="renseignement">
                <div id="titre">
                Informations sur les fleurs :
                </div>
                <output name="fleur">oui</output> <!--mettre bdd-->
            </div>
            <div class="renseignement">
                <div id="titre">
                Informations sur les fruits :
                </div>
                <output name="floraison">rouges</output> <!--mettre bdd-->
            </div>
            
            <div class="renseignement">
                <div id="titre">
                Description détaillée :
                </div>
                <output name="descrip">plante</output> <!--mettre bdd-->
            </div>
            <div class="renseignement">
                <div id="titre">
                Personne qui l'a ajouté au site :
                </div>
                <output name="taille">Claire</output> <!--mettre bdd-->
            </div>
            <!-- mettre une carte -->
            <button id="boutonmodif" type=button onclick="">
                Modifier
            </button>
            <button id="boutonmodif" type=button onclick="">
                Ajouter un signalement
            </button>
        </form>
    </body>
</html>