<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6b6c1dbe0e.js" crossorigin="anonymous"></script>    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"   

        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">  

    <link rel="stylesheet" href="pageaccueil.css">
    <title>Liste des signalements </title>
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
    <hr>    

<h2 class="card-title" style="text-align:center" >     Liste des signalements      </h2>
<?php
    include("menu.php");
?> 
<?php
                if($_GET["ajout"]=="true"){
                    echo "<div class=inscription> Ajout du signalement réussi </div></br>";
                }
            ?>
            <br/>
            

 <div class="container">
 <div class="row ">  
 <div class="col-sm">    
            
        <form action="" method="POST">   
     <div class="card mb-3">
     <div class="card-body">   

     <div class="input-group">
    <input type="search" class="form-control rounded" id="searchbar" name="plante" placeholder="Rechercher un signalement..." aria-label="Search" aria-describedby="search-addon" />
     <button type="submit" class="btn btn-outline-primary" name="searchbar">Rechercher</button>
    </div>
          
    </div> 
    </div> 

      <div class="card mb-3">                    
      <div class="card-body">    
         <div class="row">
<!-- Depuis -->             
<div class="col">  
                    
         <label for=" Depuis" class="control-label">  Depuis :</label>    

         <select class="form-control"  name="liste" onchange="this.form.submit()"> 
                <option value="tout" <?php if($_POST['liste']=="tout"){echo "selected";}?>> le début du site</option> 
                <option value="jour" <?php if($_POST['liste']=="jour"){echo "selected";}?>>un jour </option>
                <option value="semaine" <?php if($_POST['liste']=="semaine"){echo "selected";}?>>une semaine </option>
                <option value="mois" <?php if($_POST['liste']=="mois"){echo "selected";}?>>un mois  </option>
                <option value="an" <?php if($_POST['liste']=="an"){echo "selected";}?>>un an </option>
            </select>             
                             
</div>
                   
<!-- Trier par  -->                   
 <div class="col">
                   
                       
        <label for="Trier par " class="control-label"> Trier par :</label>  
        <select class="form-control"  name="tri" onchange="this.form.submit()"> 
                <option value="dateRec" <?php if($_POST['tri']=="dateRec"){echo "selected";}?>> Date du plus récent </option>
                <option value="dateAnc" <?php if($_POST['tri']=="dateAnc"){echo "selected";}?>> Date du plus ancien </option>
                <option value="plante" <?php if($_POST['tri']=="plante"){echo "selected";}?>> Ordre alphabétique plante</option> 
            </select>        
 </div>  
                  
                    
                    
<hr>
                                       
</div>
</div>      






<div class="card mb-3">
     <div class="card-body">
        
            
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

                    

                        if(isset($_POST['plante']) and $_POST['plante']!="" )
                        {
                            if(isset($_POST['tri']) and ($_POST['tri']=="" or $_POST['tri']=="dateRec")){
                                $requeteJointure = $BDD->prepare('SELECT plantes.Nom_fr, plantes.Nom_latin, utilisateurs.Pseudo, signalements.Ville, signalements.Coordonnees_GPS, signalements.Date_signalement, signalements.Id_signalement, signalements.Verifier, photosignalements.Photo   
                                                                    FROM signalements INNER JOIN plantes ON plantes.Id_plante=signalements.Id_plante
                                                                    INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=signalements.Id_utilisateur
                                                                    INNER JOIN photosignalements ON photosignalements.Id_signalement = signalements.Id_signalement
                                                                    WHERE signalements.Verifier=0
                                                                    ORDER BY signalements.Date_signalement DESC');
                                                
                                $requeteJointure->execute();
                                $donnees = $requeteJointure->fetchAll();
                            }
                            
                            else{
                                if($_POST['tri']=="dateAnc"){
                                    $requeteJointure = $BDD->prepare('SELECT plantes.Nom_fr, plantes.Nom_latin, utilisateurs.Pseudo, signalements.Ville, signalements.Coordonnees_GPS, signalements.Date_signalement, signalements.Id_signalement, signalements.Verifier, photosignalements.Photo    
                                                                        FROM signalements INNER JOIN plantes ON plantes.Id_plante=signalements.Id_plante
                                                                        INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=signalements.Id_utilisateur
                                                                        INNER JOIN photosignalements ON photosignalements.Id_signalement = signalements.Id_signalement
                                                                        WHERE signalements.Verifier=0
                                                                        ORDER BY signalements.Date_signalement ASC');
                                        
                                    $requeteJointure->execute();
                                    $donnees = $requeteJointure->fetchAll();
                                }

                                else{
                                    $requeteJointure = $BDD->prepare('SELECT plantes.Nom_fr, plantes.Nom_latin, utilisateurs.Pseudo, signalements.Ville, signalements.Coordonnees_GPS, signalements.Date_signalement, signalements.Id_signalement, signalements.Verifier, photosignalements.Photo    
                                                                        FROM signalements INNER JOIN plantes ON plantes.Id_plante=signalements.Id_plante
                                                                        INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=signalements.Id_utilisateur
                                                                        INNER JOIN photosignalements ON photosignalements.Id_signalement = signalements.Id_signalement
                                                                        WHERE signalements.Verifier=0
                                                                        ORDER BY plantes.Nom_fr ');
                
                                    $requeteJointure->execute();
                                    $donnees = $requeteJointure->fetchAll();
                                }
                            }

                            foreach ($donnees as $plante){
                                if(strstr (strtolower($plante['Nom_fr']), strtolower($_POST['plante'])) or strstr (strtolower($plante['Nom_latin']), strtolower($_POST['plante']))){
                                    $result[]=$plante;
                                }
                            }
                            $donnees=$result;
                        }
                        
                        else{

                            if(isset($_POST['tri']) and ($_POST['tri']=="" or $_POST['tri']=="dateRec")){
                                $requeteJointure = $BDD->prepare('SELECT plantes.Nom_fr, utilisateurs.Pseudo, signalements.Ville, signalements.Coordonnees_GPS, signalements.Date_signalement, signalements.Id_signalement, signalements.Verifier, photosignalements.Photo    
                                                                    FROM signalements INNER JOIN plantes ON plantes.Id_plante=signalements.Id_plante
                                                                    INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=signalements.Id_utilisateur
                                                                    INNER JOIN photosignalements ON photosignalements.Id_signalement = signalements.Id_signalement
                                                                    WHERE signalements.Verifier=0
                                                                    ORDER BY signalements.Date_signalement DESC');
                                                
                                $requeteJointure->execute();
                                $donnees = $requeteJointure->fetchAll();
                            }
                            
                            else{
                                if(isset($_POST['tri']) and $_POST['tri']=="dateAnc"){
                                    $requeteJointure = $BDD->prepare('SELECT plantes.Nom_fr, utilisateurs.Pseudo, signalements.Ville, signalements.Coordonnees_GPS, signalements.Date_signalement, signalements.Id_signalement, signalements.Verifier, photosignalements.Photo    
                                                                        FROM signalements INNER JOIN plantes ON plantes.Id_plante=signalements.Id_plante
                                                                        INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=signalements.Id_utilisateur
                                                                        INNER JOIN photosignalements ON photosignalements.Id_signalement = signalements.Id_signalement
                                                                        WHERE signalements.Verifier=0
                                                                        ORDER BY signalements.Date_signalement ASC');
                                        
                                    $requeteJointure->execute();
                                    $donnees = $requeteJointure->fetchAll();
                                }

                                else{
                                    $requeteJointure = $BDD->prepare('SELECT plantes.Nom_fr, utilisateurs.Pseudo, signalements.Ville, signalements.Coordonnees_GPS, signalements.Date_signalement, signalements.Id_signalement, signalements.Verifier, photosignalements.Photo    
                                                                        FROM signalements INNER JOIN plantes ON plantes.Id_plante=signalements.Id_plante
                                                                        INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=signalements.Id_utilisateur
                                                                        INNER JOIN photosignalements ON photosignalements.Id_signalement = signalements.Id_signalement
                                                                        WHERE signalements.Verifier=0
                                                                        ORDER BY plantes.Nom_fr ');
                
                                    $requeteJointure->execute();
                                    $donnees = $requeteJointure->fetchAll();
                                }
                            }


                        }

                        if(isset($_POST['liste'])){
                        
                            $rechercheDate= TRUE;
                            $date=$_POST['liste'];
                            $aujourdhui=strtotime(date('Y-m-d'));
                            $resultat=array();
                            
                            if($date == "jour"){
                                
                               foreach ($donnees as $signalement){
                                    $dateSignal=strtotime($signalement['Date_signalement']);
                                    if((($aujourdhui - $dateSignal)/86400) <=1){ 
                                            $resultat[]=$signalement;
                                        }
                                }
                                
                                    
                            }
                            elseif($date == "semaine"){

                                foreach ($donnees as $signalement){
                                    $dateSignal=strtotime($signalement['Date_signalement']);
                                    if((($aujourdhui - $dateSignal)/86400) <=7){ 
                                            $resultat[]=$signalement;
                                        }
                                }
                            }
                            elseif($date == "mois"){

                                foreach ($donnees as $signalement){
                                    $dateSignal=strtotime($signalement['Date_signalement']);
                                    if((($aujourdhui - $dateSignal)/86400) <=31){ 
                                            $resultat[]=$signalement;
                                        }
                                }

                            }
                            elseif($date == "an"){

                                foreach ($donnees as $signalement){
                                    $dateSignal=strtotime($signalement['Date_signalement']);
                                    if((($aujourdhui - $dateSignal)/86400) <=365){ 
                                            $resultat[]=$signalement;
                                        }
                                }
                            }
                            else
                            {
                                $resultat=$donnees;
                            }

                        }
                        else{
                           
                            $rechercheDate=FALSE;
                        
                            try{
                                $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
                                $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $BDD->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                            }
                            catch(Exception $e){
                                die('Erreur :' . $e->getMessage());
                            }


                                $requeteJointure = $BDD->prepare('SELECT plantes.Nom_fr, utilisateurs.Pseudo, signalements.Ville, signalements.Coordonnees_GPS, signalements.Date_signalement, signalements.Id_signalement, signalements.Verifier, photosignalements.Photo  
                                                                FROM signalements INNER JOIN plantes ON plantes.Id_plante=signalements.Id_plante
                                                                                INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=signalements.Id_utilisateur
                                                                                INNER JOIN photosignalements ON photosignalements.Id_signalement = signalements.Id_signalement
                                                                                WHERE signalements.Verifier=0
                                                                                ORDER BY signalements.Date_signalement DESC');
                                
                                $requeteJointure->execute();
                                $donnees = $requeteJointure->fetchAll(); 
                       }
                    
                
                    if($rechercheDate==FALSE){

                        $tableau =  $donnees;
                    }
                    else{

                        $tableau = $resultat;
                    }

                    if (count($tableau)==0)   
                    {
                        echo "<p align=\"center\"> Aucun résultat disponible </p>";
                    } 
                    else{

                        foreach ($tableau as $signalement){

                        
                ?>
                
                <a href="signalement.php?id=<?php echo $signalement['Id_signalement']?> " id="lien_plante">
                    

                <div class="card-body"> 
                <div class="col">

        <img src=" data:image/jpg;base64,<?php echo base64_encode($signalement['Photo']);?> " id="image_plante" > 
                        </div>

                        <div class="col">

                                <output name=nom_plante id=planteinfos> Nom de la plante : <?php echo $signalement['Nom_fr'];?></output></br>
                                <output name=pseudo id=planteinfos>  Personne qui l'a signalée : <?php echo $signalement['Pseudo'];?></output></br>
                                <output name=ville id=planteinfos>  Ville : <?php echo $signalement['Ville'];?></output> </br> 
                                <output name=gps id=planteinfos>  Coordonnées GPS : <?php echo $signalement['Coordonnees_GPS'];?></output></br>  
                                <output name=date id=planteinfos>  Date : <?php echo $signalement['Date_signalement'];?></output>  
                         </div>





                        </div>


                <hr>
                </a>
                <?php
                        }
                    }

                
                
                
                
                ?>








               
                          
 </form>

</div>
</div>   


              
</main>  
</div>
</div>
 </div>

</body>

</html>
