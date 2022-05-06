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




<?php
 
            //ini_set( 'display_errors', 'on' );
            //error_reporting( E_ALL );
            try{
                $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
                $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $BDD->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }
            catch(Exception $e){
                die('Erreur :' . $e->getMessage());
            }
            //$requeteJointure = 'SELECT * FROM plantes INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=plantes.Id_utilisateur
                                                   // INNER JOIN photoplantes ON plantes.Id_plante = photoplantes.Id_plante WHERE plantes.Id_plante="'.$_GET["id"].'"';
            
            $requeteJointure = 'SELECT * FROM plantes INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=plantes.Id_utilisateur
                                                      INNER JOIN photoplantes ON plantes.Id_plante = photoplantes.Id_plante 
                                                      INNER JOIN signalements ON signalements.Id_plante = plantes.Id_plante
                                                      WHERE plantes.Id_plante="'.$_GET["id"].'"';
                                                
            $requeteJointure = $BDD->prepare($requeteJointure);
            $requeteJointure->execute();
            $plante = $requeteJointure->fetchAll();

            foreach($plante as $coordonnees ){
              $pos = strpos( $signalement['Coordonnees_GPS'], "-");
              $lat = doubleval(substr ($signalement['Coordonnees_GPS'], 0, $pos));
              $long = doubleval(substr ($signalement['Coordonnees_GPS'], $pos+1, strlen($signalement['Coordonnees_GPS'])));

              //afficher marqueur
            }
            
        ?>       





<main>
    <?php
    include("menu.php");
    ?>
    <h2 class="card-title" style="text-align:center" > <?php echo $plante[0]['Nom_fr']; ?>   </h2>  
    <hr>

    
          <div class="card-body text-center">
            <div class="image">
              <?php if($plante[0]['Photo']==NULL){?>
                <img src="img\iconeplante.jpg  " width = 300 > 
              <?php }
							else{ ?>
                <img src="data:image/jpg;base64,<?php echo base64_encode($plante[0]['Photo']);?> " width = 300  > <!--mettre photo de la bdd et voir avec js pour faire des flèches pour faire défiler les images s'il y en a plusieurs-->
              <?php }?>	
            </div> 
              
             



              
            
          </div>

<form>

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
                <p class="text-muted mb-0"><output name="nomlat"><?php echo $plante[0]['Nom_latin']; ?> </output> </p>
              </div>
 </div>
            <hr>


 <div class="row">
              <div class="col-sm-3">
                <p class="mb-0"> Type </p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"> <output name="nomlat"><?php echo $plante[0]['Famille']; ?> </output></p>
              </div>
</div>
            <hr>
<div class="row">
              <div class="col-sm-3">

                <p class="mb-0">Taille moyenne</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><output name="taille"><?php echo $plante[0]['Taille']; ?> cm</output> </p>
             </div>
</div>
            <hr>

        



<div class="row">
<div class="col-sm-3">
                <p class="mb-0"> Couleur principale</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"> <output name="taille"><?php echo $plante[0]['Couleur']; ?> </output> </p>
              </div>
 </div>
 <hr>

  <?php if($plante[0]['Fleur']==1){?>
  <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Couleur des fleurs</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><output name="floraison"><?php echo $plante[0]['Couleur_fleur']; ?></output></p>
              </div>
            
  </div>
  <hr>
  <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Période de floraison</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><output name="floraison"><?php echo $plante[0]['Période_floraison']; ?></output></p>
              </div>
            
  </div>
  <hr>
  <?php }?>

  <?php if($plante[0]['Fruit']==1){?>
  <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Couleur des fruits</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><output name="floraison"><?php echo $plante[0]['Couleur_fruit']; ?></output></p>
              </div>
            
  </div>
  <hr>
  <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Période de fructification</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><output name="floraison"><?php echo $plante[0]['Période_fructification']; ?></output></p>
              </div>
            
  </div>
  
  <?php }?>

  
  <hr>  
  
  <div class="row">
              <div class="col-sm-3">

                <p class="mb-0"> Régions</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"> <output id="description"><?php echo $plante[0]['Régions']; ?></output> </p>
              </div>
    </div>
  


<hr>  

  <div class="row">
              <div class="col-sm-3">
                <p class="mb-0"> Description détaillée</p>
              </div>
              <div class="col-sm-9">

                <p class="text-muted mb-0" align="justify"> <output name="descrip"><?php echo $plante[0]['Details']; ?></output> </p>
              </div>
            
  </div>

  



</div>
</div>


                     

</div>
</div>


        
    </main>
</body>

</html>








          
       

                
             
