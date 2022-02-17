<!DOCTYPE html>
<html>
    <head>
        <title>Profil Utilisateur</title>
        <meta charset="utf-8">
        <link href="test.css" rel="stylesheet" type="text/css" media="all" />
    </head>
    <body>
        <div id="header">Plate-forme collaborative de lutte contre les plantes invasives</div>


        <!--menu déroulant-->
        <div class="deroulant">
            <button class="menu"> Menu </button>  
                <div class="partie" >
                    <a href="accueil.php">Accueil</a>
                    <a href="profil_utilisateur.php">Votre profil</a>
                    <a href="repertoire_botannique.php">Le répertoire botannique</a>
                    <a href="">Les utilisateurs</a>
                    <a href="">Les derniers signalements</a>
                    <a href="ajout_signalement.php">Signaler une plante</a>
                    <a href="ajout_plante.php">Ajouter une plante</a>
                    <a href="">Vos amis</a>
                    <a href="connexion.php">Connexion</a>
                    <a href="inscription.php">Inscription</a>
                </div>
        </div>

        
        <form>
            <h1 style="text-align:center"> <output name="pseudo">Claire</output>  </h1>
            <img src  > <!--mettre photo de la bdd-->
            <br/>
            
            <div class="renseignement">
                <div id="titre">
                Adresse mail :
                </div>
                <output name="email">test@test.com</output> <!--mettre bdd-->
            </div>
            <div class="renseignement">
                <div id="titre">
                Rang :
                </div>
                <output name="email">débutant</output> <!--mettre bdd-->
            </div>
            <div class="renseignement">
                <div id="titre">
                URL du l'entreprise :
                </div>
                <output name="email">test@test.com</output> <!--mettre bdd-->
            </div>
            <div class="renseignement">
                <div id="titre">
                Nombre de bons signalements :
                </div>
                <output name="email">1</output> <!--mettre bdd-->
            </div>



            <button id="boutonmodif" type=button onclick="">
                Envoyer une demande d'ami
            </button>
        </form>

        <footer>
        <div id="baspage"> Contact</div>
        </footer> 
    </body>
</html>