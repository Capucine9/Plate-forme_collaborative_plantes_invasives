<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6b6c1dbe0e.js" crossorigin="anonymous"></script>    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"   

        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">  

    <link rel="stylesheet" href="pageaccueil.css">
    <title>Accueil</title>
</head>

<body>
        

     
<header >
                <div class="jumbotron   bg-image  text-Light    " >  
                    <h1 style="color:white;text-align:center" >
                        Plate-forme collaborative de lutte contre les plantes invasives
                    </h1>    
                    
                </div>
</header>




    <main>
    <h2 class="card-title" style="text-align:center" > Profil plante    </h2>  
    <hr>
<?php
    include("menu.php");
?>

<form>
<?php
 
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
            $requeteJointure = 'SELECT * FROM plantes INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=plantes.Id_utilisateur
                                                    INNER JOIN photoplantes ON plantes.Id_plante = photoplantes.Id_plante WHERE plantes.Id_plante="'.$_GET["id"].'"';
                        
                                                
            $requeteJointure = $BDD->prepare($requeteJointure);
            $requeteJointure->execute();
            $plante = $requeteJointure->fetch();
            
        ?>       






<div class="container">
 <div class="row ">  
  <div class="col-sm">  
           
  <div class="card mb-3">
 <div class="card-body"> 
                  
 


<div class="row">
              <div class="col-sm-3">
                <p class="mb-0"> Nom latin :</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><output name="nomlat"><?php echo $plante['Nom_latin']; ?> </output> </p>
              </div>
 </div>
            <hr>


 <div class="row">
              <div class="col-sm-3">
                <p class="mb-0"> Type </p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"> <output name="nomlat"><?php echo $plante['Nom_latin']; ?> </output></p>
              </div>
</div>
            <hr>
<div class="row">
              <div class="col-sm-3">

                <p class="mb-0">Taille moyenne</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><output name="taille"><?php echo $plante['Taille']; ?> cm</output> </p>
             </div>
</div>
            <hr>

        



<div class="row">
<div class="col-sm-3">
                <p class="mb-0"> Couleur principale</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"> <output name="taille"><?php echo $plante['Couleur']; ?> </output> </p>
              </div>
 </div>
            <hr>

  <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Couleur des fleurs</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><output name="floraison"><?php echo $plante['Couleur_fruit']; ?></output></p>
              </div>
            
  </div>


  

  
  <hr>  
  
  <div class="row">
              <div class="col-sm-3">

                <p class="mb-0"> Régions</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"> <output id="description"><?php echo $plante['Régions']; ?></output> </p>
              </div>
    </div>
  


<hr>  

  <div class="row">
              <div class="col-sm-3">
                <p class="mb-0"> Description détaillée</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"> <output name="descrip"><?php echo $plante['Details']; ?></output> </p>
              </div>
            
  </div>



</div>
</div>


                     
<div class="card mb-4">
            <div class="card-body text-center">
            <h1 style="text-align:center"> <?php echo $plante['Nom_fr']; ?> </h1> <!-- récupéré dans bdd-->
            <div class="image">
                <img src="data:image/jpg;base64,<?php echo base64_encode($plante['Photo']);?> " width = 300  > <!--mettre photo de la bdd et voir avec js pour faire des flèches pour faire défiler les images s'il y en a plusieurs-->
            </div> 
              
             



              
              <div class="d-flex justify-content-center mb-2">

                <button type="button"id="boutonmodif" onclick="" class="btn btn-primary"> Modifier</button>
                <hr>
                <button type="button" id="boutonmodif"  onclick="" class="btn btn-outline-primary ms-1"> Ajouter un signalement</button>   

             
            
               
            </button>
              </div>
            </div>







</div>
</div>
</div>


        
    </main>
</body>

</html>








          
       

                
             