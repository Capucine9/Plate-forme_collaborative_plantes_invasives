
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


    
    <?php
    include("menu.php");
    ?>

    <h1 style="text-align:center"> Connexion </h1>
    <!--affichage réussite d'inscription-->
    <?php
     if($_GET["inscription"]=="true"){
        echo "<div class=inscription> Inscription réussie, veuillez vous connecter </div></br>";
      }
    ?>
    
    <?php 
      
      ini_set( 'display_errors', 'on' );
      error_reporting( E_ALL );
      $errors = array();
      if(isset($_POST['email']) and isset($_POST['mdp'])){
        try{
          $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
          $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $BDD->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
          die('Erreur :' . $e->getMessage());
        }

        $requete=$BDD->prepare('SELECT * FROM utilisateurs WHERE Email ="'.$_POST['email'].'"');
        $requete->execute();
        $utilisateur=$requete->fetch();

        if($utilisateur == null)
          $errors['email']="Email incorrecte";
        else{
          if(password_verify($_POST['mdp'], $utilisateur['Mdp'])){
              
              $_SESSION['id']=$utilisateur['Id_utilisateur'];
              $_SESSION['pseudo']=$utilisateur['Pseudo'];
              $_SESSION['rang']=$utilisateur['Rang'];

              header('Location: accueil.php');
              exit();
          }
          else{
            $errors['mdp']="Mot de passe incorrect";
          }
        }

      }

      if(!empty($errors)){
    ?>

    <div class ="erreur">
      <p> Le formulaire est incorrect : </p>
      <?php
        foreach($errors as $error){
          echo '<li>'.$error.'</li>';
        }
      ?>
      </br>
    </div>
    <?php } ?>


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


    </form>
    <footer>
        <div id="baspage"> Contact</div>
    </footer> 
  </body>
</html>
