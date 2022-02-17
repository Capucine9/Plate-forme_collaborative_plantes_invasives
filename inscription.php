<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta charset="utf-8" />
      <title>
          Inscription
      </title>
      <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
  </head>

  <body>
    <script type="text/javascript" src="js/projet.js"></script>


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

    <h1 style="text-align:center"> Inscription </h1>
    <div class="renseignement">
      <div id="titre">Adresse mail : </div>
      <input type="text" id="renseignement"/>
    </div>
    <div class="renseignement">
      <div id="titre">Pseudo : </div>
      <input type="text" id="renseignement"/>
    </div>
    <div class="renseignement">
      <div id="titre">Mot de passe : </div>
      <input type="text" id="renseignement"/>
    </div>
    <div class="renseignement">
      <div id="titre">Confirmation du mot de passe : </div>
      <input type="text" id="renseignement"/>
    </div>
    <div class="renseignement">
      <div id="titre">Entreprise : </div>
      <input type="radio" value="oui"/><label for="oui">oui</label>
      <input type="radio" id="radiodroite" value="non"/><label for="non">non</label>
    </div>
    <div class="renseignement">
      <div id="titre">URL de l'entreprise : </div>
      <input type="text" id="renseignement"/>
    </div>


    <button id="bouttongauche" onclick="">Annuler</button>
    <button id="bouttondroite" onclick="">Valider</button>

    <footer>
        <div id="baspage"> Contact</div>
    </footer> 
  </body>
</html>
