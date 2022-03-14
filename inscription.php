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

  

    <?php

      /*function debug($variable){
        echo '<pre>'.print_r($variable, true). '</pre>';
      }*/

      //vérification de si le formulaire est bien rempli
      if(isset($_POST['valider'])){
        if(!empty($_POST)){

          $errors = array();

          if(empty($_POST['pseudo']) || !preg_match('/^[A-Za-z0-9_]+$/', $_POST['pseudo'])){
            $errors['pseudo']="Pseudo non valide";
          }

          if(empty($_POST['email']) ){
            $errors['email']="Email non valide";
          }
          
          if(empty($_POST['mdp']) ){
            $errors['mdp']="Mot de passe non valide";
          }

          if($_POST['mdp'] != $_POST['mdpconf']){
            $errors['mdpconf']="Mots de passe différents";
          }

          //connexion bdd           
          try{
            $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
            $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $BDD->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
          }
          catch(Exception $e){
            echo 'Erreur :' . $e->getMessage();
          }

          #on vérifie si l'adresse mail est déjà dans la bdd  
          $requetemail = $BDD->prepare('SELECT * FROM utilisateurs WHERE Email ="'.$_POST['email'].'"');
          $requetemail->execute(array($email));
          $nb = $requetemail->rowCount();
          

          if($nb != 0)
          {
            $errors['email_existe']="L'email est déjà utilisée";
          }

          //debug($errors);
        }  

        if(empty($errors)){
          
          //récupération de toutes les valeurs
          $email = $_POST['email'];
          $pseudo = $_POST['pseudo'];
          $mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
          $mdpconf = $_POST['mdpconf'];
          $entreprise = $_POST['entreprise'];
          
          if($entreprise=='oui')
          {
            $entreprise=1;
            $url=$_POST['url'];
          }
          else
          {
            $entreprise=0;
            $url=NULL;
          }

          //insertion
          try{
            $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
            $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $BDD->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
          }
          catch(Exception $e){
            echo 'Erreur :' . $e->getMessage();
          }
          try{
            $req = $BDD->prepare("INSERT INTO utilisateurs (Pseudo, Email, Mdp, Entreprise, URL_entreprise)  VALUES (:pseudo, :email, :mdp, :ent, :url_ent) ");
            $exec = $req->execute(array(':pseudo'=>$pseudo,':email'=>$email,':mdp'=>$mdp,':ent'=>$entreprise, ':url_ent'=>$url));
          }
          catch(Exception $e){
              echo "erreur".$e->getMessage();
          }

          
          header('Location: connexion.php');
          exit();
        }
      }
          

    ?>

<h1 style="text-align:center"> Inscription </h1>

<?php
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
        <input type="password" id="renseignement" name="mdp" value="<?php if(isset($mdp)) { echo $mdpconf; } ?>" required/>
      </div>
      <div class="renseignement">
        <div id="titre">Confirmation du mot de passe : </div>
        <input type="password" id="renseignement" name="mdpconf" value="<?php if(isset($mdpconf)) { echo $mdpconf; } ?>" required/>
      </div>
      <div class="renseignement" id="togg1">
        <div id="titre">Entreprise : </div>
        <input type="radio" value="oui" name="entreprise"/><label for="oui">oui</label>
        <input type="radio" id="radiodroite" value="non" name="entreprise" checked/><label for="non">non</label>
      </div>
      <div class="renseignement"  id="resultbouton1">
        <div id="titre">URL de l'entreprise : </div>
        <input type="text" id="renseignement" name="url" value="<?php if(isset($url)) { echo $url; }?> "/>
      </div>


    </br>
    </br>
      <a href="accueil.php" id="bouttongauche"><input type="button" value="Annuler"></a>
      <button id="bouttondroite" type="submit" name="valider">Valider</button>
    </form>

    
    <footer>
        <div id="baspage"> Contact</div>
    </footer> 
    <script type="text/javascript" src="js/java.js"></script>
  </body>
</html>
