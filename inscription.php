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
                    <a href="repertoire_utilisateur.php">Les utilisateurs</a>
                    <a href="listeSignalement.php">Les derniers signalements</a>
                    <a href="ajout_signalement.php">Signaler une plante</a>
                    <a href="ajout_plante.php">Ajouter une plante</a>
                    <a href="">Vos amis</a>
                    <a href="connexion.php">Connexion</a>
                    <a href="inscription.php">Inscription</a>
                </div>
    </div>

   

    <h1 style="text-align:center"> Inscription </h1>
    <form method="post" action="">
      <div class="renseignement">
        <div id="titre">Adresse mail : </div>
        <input type="text" id="renseignement" name="email" value="<?php if(isset($email)) { echo $email; } ?>" required/>
      </div>
      <div class="renseignement">
        <div id="titre">Pseudo : </div>
        <input type="text" id="renseignement" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" required/>
      </div>
      <div class="renseignement">
        <div id="titre">Mot de passe : </div>
        <input type="password" id="renseignement" name="mdp" value="<?php if(isset($mdp)) { echo $mdp; } ?>" required/>
      </div>
      <div class="renseignement">
        <div id="titre">Confirmation du mot de passe : </div>
        <input type="password" id="renseignement" name="mdpconf" value="<?php if(isset($mdpconf)) { echo $mdpconf; } ?>" required/>
      </div>
      <div class="renseignement">
        <div id="titre">Entreprise : </div>
        <input type="radio" name="entreprise" value="oui"/><label for="oui">oui</label>
        <input type="radio" id="radiodroite" name="entreprise" value="non" checked/><label for="non">non</label>
      </div>
      <div class="renseignement">
        <div id="titre">URL de l'entreprise : </div>
        <input type="text" id="renseignement" name="url" value="<?php if(isset($url)) { echo $url; }?> "/>
      </div>


    </br>
    </br>
      <a href="accueil.php" id="bouttongauche"><input type="button" value="Annuler"></a>
      <a href="accueil.php" id="bouttondroite"><input type="submit" name="valider" value="Valider"></a>
    </form>

    <?php
     if(isset($_POST['valider'])){

        $email=$_POST['email'];
        $pseudo=$_POST['pseudo'];
        $mdp=$_POST['mdp'];
        $mdpconf=$_POST['mdpconf'];
        $entreprise=$_POST['entreprise'];

                    
        try{
          $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
        }
        catch(Exception $e){
          die('Erreur :' . $e->getMessage());
        }

        if($entreprise=='oui')
        {
          $entreprise=True;
          $url=$_POST['url'];
        }
        else
        {
          $entreprise=False;
          $url=NULL;
        }

        if($mdp==$mdpconf and isset($mdp))
        {
          #on vérifie si l'adresse mail est déjà dans la bdd

          $requetemail = $BDD->prepare('SELECT * FROM utilisateurs WHERE Email ="'.$email.'"');
          $requetemail->execute(array($email));
          $nb = $requetemail->rowCount();

          if($nb == 0)
          {
            $requete = $BDD->prepare('INSERT INTO utilisateurs ( Email, Mdp, Pseudo, Entreprise, URL_entreprise ) VALUES ("'.$email.'","'.$mdp.'","'.$pseudo.'","'.$entreprise.'","'.$url.'")');
            $requete = $requete -> execute(/*array($email, $mdp, $pseudo, $entreprise, $url)*/);
            if($requete){
              echo 'Données insérées';
            }
            else
            {
              echo "Échec de l'opération d'insertion";
            }
          }
          else
            echo "Adresse mail déjà utilisée";


        }
        
        else
        {
          echo "Les mots de passe sont différents";
        }

      }

    ?>
    <footer>
        <div id="baspage"> Contact</div>
    </footer> 
  </body>
</html>
