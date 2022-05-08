<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <meta charset="utf-8" />
      <title>Signalements</title>
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

<main>

<h2 class="card-title" style="text-align:center" >  Signalement  </h2>  
<hr>
<?php
include("menu.php");
?>  

<?php
  $exec =false ;
  ini_set( 'display_errors', 'on' );
  error_reporting( E_ALL );
  try{
      $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
      $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $BDD->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  }
  catch(Exception $e){
      die('Erreur :' . $e->getMessage());
  }
  $requeteJointure = $BDD->prepare('SELECT plantes.Nom_fr, utilisateurs.Pseudo, signalements.Ville, signalements.Coordonnees_GPS, signalements.Date_signalement, signalements.Commentaire, photosignalements.Photo
                                          FROM signalements INNER JOIN plantes ON plantes.Id_plante=signalements.Id_plante
                                                            INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=signalements.Id_utilisateur
                                                            INNER JOIN photosignalements ON photosignalements.Id_signalement = signalements.Id_signalement 
                                                            WHERE signalements.Id_signalement="'.$_GET["id"].'"');
          
  $requeteJointure->execute();
  $signalement = $requeteJointure->fetch(); 

  $pos = strpos( $signalement['Coordonnees_GPS'], "-");
  $lat = doubleval(substr ($signalement['Coordonnees_GPS'], 0, $pos));
  $long = doubleval(substr ($signalement['Coordonnees_GPS'], $pos+1, strlen($signalement['Coordonnees_GPS'])));
  
  if(isset($_POST['modif'])){
      try{
          $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
          $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $BDD->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      }
      catch(Exception $e){
          die('Erreur :' . $e->getMessage());
      }

      $requeteModif = $BDD->prepare('UPDATE signalements SET Verifier=:verif WHERE Id_signalement="'.$_GET["id"].'"');
      $exec=$requeteModif->execute(array(':verif'=> 1));
      
        $score=$signalement['Nb_bon_signalement']+1;
      if ($score==5){
          $requeteModifScore = $BDD->prepare('UPDATE utilisateurs SET Nb_bon_signalement=:score, Rang=:rang WHERE Id_utilisateur="'.$signalement['Id_utilisateur'].'"');
          $exec=$requeteModifScore->execute(array(':score'=> $score, ':rang'=> 2));
      }
      else{
          $requeteModifScore = $BDD->prepare('UPDATE utilisateurs SET Nb_bon_signalement=:score WHERE Id_utilisateur="'.$signalement['Id_utilisateur'].'"');
          $exec=$requeteModifScore->execute(array(':score'=> $score));
      }

      $score2=$_SESSION['score']+1;
      if ($score2==10){
          $requeteModifScore = $BDD->prepare('UPDATE utilisateurs SET Nb_bon_signalement=:score, Rang=:rang WHERE Id_utilisateur="'.$_SESSION['id'].'"');
          $exec=$requeteModifScore->execute(array(':score'=> $score2, ':rang'=> 3));
      }
      else{
          $requeteModifScore = $BDD->prepare('UPDATE utilisateurs SET Nb_bon_signalement=:score WHERE Id_utilisateur="'.$_SESSION['id'].'"');
          $exec=$requeteModifScore->execute(array(':score'=> $score2));
      }
  }

  if(isset($_POST['supprimer'])){

      try{
          $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
          $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $BDD->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      }
      catch(Exception $e){
          die('Erreur :' . $e->getMessage());
      }

      $requeteSupprime = $BDD->prepare('DELETE FROM signalements WHERE Id_signalement="'.$_GET["id"].'"');
      $exec=$requeteSupprime->execute();
      
      $score2=$_SESSION['score']+1;
      if ($score2==10){
          $requeteModifScore = $BDD->prepare('UPDATE utilisateurs SET Nb_bon_signalement=:score, Rang=:rang WHERE Id_utilisateur="'.$_SESSION['id'].'"');
          $exec=$requeteModifScore->execute(array(':score'=> $score2, ':rang'=> 3));
      }
      else{
          $requeteModifScore = $BDD->prepare('UPDATE utilisateurs SET Nb_bon_signalement=:score WHERE Id_utilisateur="'.$_SESSION['id'].'"');
          $exec=$requeteModifScore->execute(array(':score'=> $score2));
      }
  }

  if($exec){
      header('Location: listeSignalement.php?');
      exit();
  } 
?>   

<form method="post" action="" enctype="multipart/form-data">
<div class="card-body text-center">
  <div class="image">
    <?php if($signalement['Photo']==NULL){?>
      <img src="img\iconeplante.jpg  " width = "300" height="300" > 
    <?php }
  else{ ?>
    <img src="data:image/jpg;base64,<?php echo base64_encode($signalement['Photo']);?> " width = 300  > <!--mettre photo de la bdd et voir avec js pour faire des flèches pour faire défiler les images s'il y en a plusieurs-->
  <?php }?>	
  </div> 
</div>

<<div class="container">
<div class="row ">  
<div class="col-sm">   
                     
<div class="card mb-3">
<div class="card-body"> 
 
<div class="row">
  <div class="col-sm-3">
    <p class="mb-0">La plante :</p>
  </div>
  <div class="col-sm-9">
    <p class="text-muted mb-0"> <output name="plante"><?php echo $signalement['Nom_fr']; ?> </output>  </p>
  </div>
</div>
<hr>

<div class="row">
  <div class="col-sm-3">
    <p class="mb-0">L'utilisateur qui a signalé :</p>
  </div>
  <div class="col-sm-9">
    <p class="text-muted mb-0"> <output name="utilisateur"><?php echo $signalement['Pseudo']; ?> </output>   </p>
  </div>
</div>
<hr>
    
<div class="row">
  <div class="col-sm-3">
    <p class="mb-0">Date :</p>
  </div>
  <div class="col-sm-9">
    <p class="text-muted mb-0"> <output name="date"><?php echo $signalement['Date_signalement']; ?></output>   </p>
  </div>
</div>
<hr>

<div class="row">
  <div class="col-sm-3">
    <p class="mb-0">Ville :</p>
  </div>
  <div class="col-sm-9">
    <p class="text-muted mb-0"> <output name="floraison"><?php echo $signalement['Ville']; ?></output>   </p>
  </div>
</div>
<hr>

<div class="row">
  <div class="col-sm-3">
    <p class="mb-0">Commentaire :</p>
  </div>
  <div class="col-sm-9">
    <p class="text-muted mb-0"> <output name="fleur"><?php echo $signalement['Commentaire']; ?></output>    </p>
  </div>
</div>
</div>
</div>

<!-- Carte  -->   
<div id=Map>
  <?php
      include 'map_signalement.php';
  ?>
</div>

<div class="card mb-3">
 <div class="card-body"> 

<?php    
  if(!empty($_SESSION['rang']) && ($_SESSION['rang']==2 or $_SESSION['rang']==3)){
      echo(" <div class=\"form-group m-0\"> <button  type=\"submit\" name=\"modif\" class=\"btn btn-primary btn-block\">
      Valider le signalement
  </button>
  <button  type=\"submit\" name=\"supprimer\" class=\"btn btn-primary btn-block\">
      Supprimer le signalement
  </button> </div>");
  } 
?>   

</div>
</div>
</form>

</div>
</div>
</div>
</div>
</div>
</div>

</form>
</main>

  <script src="js/jquery-3.6.0.min.js"></script>  
  <script src="js/popper.min.js"></script>  
  <script src="js/bootstrap.min.js"></script>
</body>
</html>