<!DOCTYPE html>
<html>
    <head>
        <title>Profil Utilisateur</title>
        <meta charset="utf-8">
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
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
                    <a href="repertoire_utilisateur.php">Les utilisateurs</a>
                    <a href="listeSignalement.php">Les derniers signalements</a>
                    <a href="ajout_signalement.php">Signaler une plante</a>
                    <a href="ajout_plante.php">Ajouter une plante</a>
                    <a href="">Vos amis</a>
                    <a href="connexion.php">Connexion</a>
                    <a href="inscription.php">Inscription</a>
                </div>
        </div>

        
        <form>
            <h1 style="text-align:center"> Mes informations </h1>
            <img src  > <!--mettre photo de la bdd-->
            <br/>
            
            <div class="renseignement">
                <div id="titre">
                Pseudo : 
                </div>
                <output name="pseudo">Claire</output> <!--mettre bdd-->
            </div>
            <div class="renseignement">
                <div id="titre">
                Mot de passe :
                </div>
                <output name="mdp">test</output> <!--mettre bdd-->
            </div>
            <div class="renseignement">
                <div id="titre">
                Adresse mail :
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
                Modifier
            </button>
        </form>

        <footer>
        <div id="baspage"> Contact</div>
        </footer> 
    </body>
</html>