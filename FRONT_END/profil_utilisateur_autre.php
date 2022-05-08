<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6b6c1dbe0e.js" crossorigin="anonymous"></script>    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"   

        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">  

    <link rel="stylesheet" href="pageaccueil.css">
    <title>Profil de l'utilisateur</title>
</head>

<body> 
  <header >
    <div class="jumbotron   bg-image  text-Light    " >  
      <h1 style="color:white;text-align:center" >
        Plate-forme collaborative de lutte contre les plantes invasives
      </h1>    
    </div>
  </header>

<?php
    include("menu.php");
?>
    <main>
    <h2 class="card-title" style="text-align:center" > Profil de l'utilisateur  </h2>  
    <hr>

<?php 
  try{
    $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
  }
  catch(Exception $e){
    die('Erreur :' . $e->getMessage());
  }
  $requete = 'SELECT * FROM utilisateurs WHERE Id_utilisateur="'.$_GET["id"].'"';
  $requete = $BDD->prepare($requete);
  $requete->execute();
  /* on récupère le résultt de la requête sous forme d'un tableau */
  $utilisateur = $requete->fetch();

  if ($utilisateur['Rang'] == 1 )
    $rang="débutant";
    else if ( $utilisateur['Rang'] == 2 )
        $rang = "moyen";
        else
            $rang = "expert";

  if ($utilisateur['Entreprise'] == 0)
          $type = "particulier";
  else
          $type = "entreprise";      
?> 

<div class="container">
  <div class="row ">  
    <div class="col-sm">  
           
<div class="card mb-3">
<div class="card-body">

<div class="card-body text-center" >                
  <?php if($utilisateur['Photo']==NULL){?>
    <img src="img\profil.jpg  " width = "200" height="200" > 
  <?php }

  else{ ?>
  <img src="data:image/jpg;base64,<?php echo base64_encode($utilisateur['Photo']);?> "  width = 300 > 
  <?php }?>	

  </br>
</div>

<div class="row">
  <div class="col-sm-3">
    <p class="mb-0"> Pseudo :</p>
  </div>
  <div class="col-sm-9">
    <p class="text-muted mb-0"><?php echo $utilisateur['Pseudo']; ?> </p>
  </div>
 </div>
<hr>
 
<div class="row">
  <div class="col-sm-3">
    <p class="mb-0">Email :</p>
  </div>
  <div class="col-sm-9">
    <p class="text-muted mb-0"> <?php echo $utilisateur['Email']; ?>  </p>
  </div>
</div>
<hr>

<div class="row">
  <div class="col-sm-3">
    <p class="mb-0">Type: </p>
  </div>
  <div class="col-sm-9">
    <p class="text-muted mb-0">  <?php echo $type; ?>  </p>
  </div>
</div>

<?php if ($utilisateur['Entreprise']==1)
{?>
<hr>
<div class="row">
  <div class="col-sm-3">
    <p class="mb-0">URL de l'entreprise: </p>
  </div>
  <div class="col-sm-9">
    <p class="text-muted mb-0">  <?php echo $utilisateur['URL_entreprise']; ?> </p>
  </div>
</div>
<?php }?>
<hr>

<div class="row">
  <div class="col-sm-3">

    <p class="mb-0">Rang: </p>
  </div>
  <div class="col-sm-9">
    <p class="text-muted mb-0"> <?php echo $rang; ?>  </p>
  </div>
</div>
<hr>

<div class="row">
  <div class="col-sm-3">
    <p class="mb-0">Nb_bon_signalement: </p>
  </div>
  <div class="col-sm-9">
    <p class="text-muted mb-0"> <?php echo $utilisateur['Nb_bon_signalement']; ?>  </p>
  </div>
</div>
<hr>

</div>
</div>
</div>
</div>
</div> 
    </main>
</body>
</html>