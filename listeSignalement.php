
<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta charset="utf-8" />
      <title>
          Ajout signalement
      </title>
      <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
  </head>

  <body>
    <div id="header">Plate-forme collaborative de lutte contre les plantes invasives</div>

    
    <?php
    include("menu.php");
    ?>



    <?php
      if($_SESSION['rang']==1){
        $validation = 0;
      }
      else{
        $validation = 1;
      }
      if(isset($_POST['valider'])){
        
        if(!empty($_POST)){

          $errors = array();

          if(empty($_POST['nomfr']) || !preg_match('/^[A-Za-z ]+$/', $_POST['nomfr'])){
            $errors['nomfr']="Le nom de la plante n'est pas valide";
          }
         else{
            //connexion bdd           
            try{
              $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
              $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $BDD->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }
            catch(Exception $e){
              echo 'Erreur :' . $e->getMessage();
            }

           #on vérifie si la plante est dans la bdd  
            $requetenom = $BDD->prepare('SELECT * FROM plantes WHERE Nom_fr =:nomfr');
            $requetenom->execute(['nomfr'=>ucfirst(strtolower($_POST['nomfr']))]);
            $plante = $requetenom->fetch();

            if($plante == "")
            {
              $errors['plante']="La plante n'est pas dans la base de données";
            }

            else{
              $id_plante = $plante['Id_plante'];
            }
          }

          if(empty($_POST['ville']) || !preg_match('/^[A-Za-z ]+$/', $_POST['ville'])){
            $errors['region']="Ville non valide";
          }
          
          /*if(empty($_POST['lat']))
          {
            $errors['coordonnees']="Veuillez cliquer sur la carte pour avoir les coordonnées GPS";
          }
          */
          

        }

        if(empty($errors)){
          
          //récupération de toutes les valeurs
          
          $nomfr = ucfirst(strtolower($_POST['nomfr']));
          $ville = ucfirst(strtolower($_POST['ville']));
          $description = $_POST['description'];
          $gps = $_POST['lat']."-". $_POST['lon'];
          $date = $_POST['date'];

         

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
            $req = $BDD->prepare("INSERT INTO signalements (Id_utilisateur, Id_plante, Ville, /*Coordonnees_GPS,*/ Date_signalement, Commentaire, Verifier )  VALUES (:id_utilisateur, :id_plante, :ville, /*:gps,*/ :dat, :commentaire, :verifier) ");
            $exec = $req->execute(array(':id_utilisateur'=> $_SESSION['id'], ':id_plante'=> $id_plante, ':ville'=> $ville, /*':gps'=> $gps,*/':dat'=>$date, ':commentaire'=>$description, ':verifier'=>$validation));
          }
          catch(Exception $e){
              echo "erreur".$e->getMessage();
          }
          if($exec){
            header('Location: listeSignalement.php?ajout=true');
            exit();
          }
          else{
            echo "<p> erreur </p>";
          }

        }
      }
    ?>
    <h1 style="text-align:center"> Signaler </h1>

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
      <div id="titre">Nom français : </div>
      <input type="text" id="renseignement" name="nomfr" required/>
    </div>


    <div class="renseignement">
      <div id="titre">Ville : </div>
      <input type="text" id="renseignement" name="ville" required/>
    </div>
    
    <div class="renseignement">
      <div id="titre"> Date : </div>
      <input type="date" name="date"
        value="<?php echo date('Y-m-d');?>"
        min="2020-01-01" max="<?php echo date('Y-m-d');?>" >

    </div>

    <div class="renseignement">
      <div id="titre">Description supplémentaire: </div>
      <input type="text" id="renseignement" name="description"/>
    </div>

    <div class="renseignement">
        <button id="bouttoncentre" onclick="">Ajouter photos</button>
    </div>

    <div id=Map>
      <!--<iframe width="100%" height="100%" frameborder="0" src="Map.php"></iframe>-->
      <?php
        include 'Map.php';
      ?>
    </div>

    <button id="bouttongauche" onclick="localhost:81/Projet%20M1/inscription.php">Annuler</button>
    <button id="bouttondroite" type="submit" name="valider">Valider</button>

    <footer>
        <div id="baspage"> Contact</div>
     </footer> 

     
    <script type="text/javascript" src="js/java.js"></script>
  </form>
  </body>
</html>