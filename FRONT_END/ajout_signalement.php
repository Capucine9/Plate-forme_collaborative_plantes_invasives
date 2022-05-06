<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta charset="utf-8" />
      <title>
          Ajout d'une signalement
      </title>
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
            /* Indispensable pour faire apparaître la carte*/
            #map{
                height : auto;
                width : auto; 
                margin-left: 100px;
                margin-right: 100px;
                margin-bottom: 40px;
            }
        </style>

  </head>

  <body class="my-login-page">

 <header >
                <div class="jumbotron   bg-image  text-Light    " >  
                    <h1 style="color:white;text-align:center" >
                        Plate-forme collaborative de lutte contre les plantes invasives
                    </h1>    
                    
                </div>
  </header>
<!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
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
          

          if(empty($_POST['ville']) || !preg_match('/^[A-Za-z ]+$/', $_POST['ville'])){
            $errors['region']="Ville non valide";
          }
          
          if(empty($_POST['lat']))
          {
            $errors['coordonnees']="Veuillez cliquer sur la carte pour avoir les coordonnées GPS";
          }
          
          
          if($_FILES['image']['error']==4){
            $errors['image']="Vous n'avez pas choisi d'images";
          }
          else{
            $img = $_FILES['image'];
          }

          

        }

        if(empty($errors)){
          
          //récupération de toutes les valeurs
          
          $nomfr = ucfirst(strtolower($_POST['nomfr']));
          $ville = ucfirst(strtolower($_POST['ville']));
          $description = $_POST['description'];
          $lat= strval($_POST['lat']);
          $long=strval($_POST['lon']);
          $gps = $lat."-".$long;
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

          $req = $BDD->query("SHOW TABLE STATUS FROM bdd LIKE 'signalements' ");
          $donnees = $req->fetch();
          $id = $donnees['Auto_increment'];

          try{
            $req = $BDD->prepare("INSERT INTO signalements (Id_utilisateur, Id_plante, Ville, Coordonnees_GPS, Date_signalement, Commentaire, Verifier )  VALUES (:id_utilisateur, :id_plante, :ville, :gps, :dat, :commentaire, :verifier) ");
            $exec = $req->execute(array(':id_utilisateur'=> $_SESSION['id'], ':id_plante'=> $id_plante, ':ville'=> $ville, ':gps'=> $gps,':dat'=>$date, ':commentaire'=>$description, ':verifier'=>$validation));
          }
          catch(Exception $e){
              echo "erreur".$e->getMessage();
          }


          try{
            $req = $BDD->prepare("INSERT INTO photosignalements (Id_signalement, Photo)  VALUES (:id, :fichier) ");
            $exec = $req->execute(array(':id'=>$id, ':fichier'=>file_get_contents($img['tmp_name'])));
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
<!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<main>

<h2 class="card-title" style="text-align:center" >  Signaler   </h2>  
<hr>
<?php
include("menu.php");
?>

<div class="container">
<div class="row col-md-">  
<div class="col">  
<!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->                      
<div class="brand">
	<img src="img/logo.jpg" alt="bootstrap 4 login page">
</div>
             
      

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


<!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->   
<form method="post" enctype="multipart/form-data">
 <!-- Nom Français -->  
 
<div class="form-group">
		<label for="email">Nom français : </label>
		<input id="nom_fr" type="text" class="form-control" name="nomfr" required>
		<div class="invalid-feedback">
        		Le nom français n'est pas valide
		</div>
</div>  

<!-- Decription -->   
  <div class="form-group">
      <label for="email">Description : </label>
      <input id="description" type="text" class="form-control" name="description" required>
      <div class="invalid-feedback">
                              
      </div>
  </div>  
  
  <div class="form-group" > 
  
  Date : 
   
      <input type="date" name="date" 
        value="<?php echo date('Y-m-d');?>"
        min="2020-01-01" max="<?php echo date('Y-m-d');?>" >  
        
</div>

<!-- Carte  -->   
<div>
  <?php
    include("map_ajout_signalement.php");
  ?>
</div>

<!-- Photo  -->
<div class="form-group">
    <label for="formFileMultiple" class="form-label" onclick="" >Ajouter photos</label>
    <input type="file" id="renseignement" name="image" />
</div>

<div class="form-group m-0">
    <button type="submit" class="btn btn-primary btn-block" name="valider" onclick="localhost:81/Projet%20M1/inscription.php">
      Valider
    </button>
     <a href="listeSignalement.php" class="btn btn-primary btn-block">
    Annuler
    </a>
   
    
</div> 


</form>


   <div class="footer">
    Copyright &copy; 2022 &mdash; Université de Limoges
  </div>

</div>
<!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
     </div>
     </div>
              
    </div>
     </div>
    </div>


    
</main>


  <script src="js/jquery-3.6.0.min.js"></script>  
  <script src="js/popper.min.js"></script>  
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
