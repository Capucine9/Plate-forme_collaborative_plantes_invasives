<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta charset="utf-8" />
      <title>
          Connexion
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

    <h1 style="text-align:center"> Connexion </h1>
    <!--affichage réussite d'inscription-->
    <?php
     if($_GET["inscription"]=="true"){
        echo "<div class=inscription> Inscription réussie, veuillez vous connecter </div></br>";
      }
    ?>
    <form method = "post">
    <div class="renseignement">
      <div id="titre">Adresse mail : </div>
      <input type="text" id="renseignement" name ="email"/>
    </div>
    <div class="renseignement">
      <div id="titre" >Mot de passe : </div>
      <input type="password" id="renseignement" name ="mdp"/>
    </div>


    <a href="accueil.php" id="bouttongauche"><input type="button" value="Annuler"></a>
    <button id="bouttondroite" type="submit" onclick="">Connexion</button>

    <?php 
      if(!empty($_POST['email']) && !empty($_POST['mdp']))
      {
        try{
          $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
        }
        catch(Exception $e){
          die('Erreur :' . $e->getMessage());
        }

        $requete = $BDD->prepare('SELECT * FROM utilisateurs WHERE Email = :email');
       
        $requete->execute(['Email' => $_POST['email']]);
        $utilisateur = $requete->fetch();
        echo $utilisateur['Rang'];
        if($utilisateur==null)
          $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
        elseif(password_verify($_POST['mdp'], $utilisateur['Mdp'])){
          $_SESSION['auth'] = $utilisateur;
          $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
          header('Location: account.php');
          exit();
        }
          else{
            $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
          }
      }
      
    ?>

    </form>
    <footer>
        <div id="baspage"> Contact</div>
    </footer> 
  </body>
</html>
