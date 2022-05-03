<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta charset="utf-8" />
      <title>
      Répertoire botanique
      </title>
      <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />  
      <link rel="stylesheet" type="text/css" href="css/my-login.css"> 
      <link href ="css/bootstrap.css" rel="stylesheet" type="text/css"/>    

      <script src="https://kit.fontawesome.com/6b6c1dbe0e.js" crossorigin="anonymous"></script>    
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"   
integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">  
<link rel="stylesheet" href="pageaccueil.css">
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

<main>

<h2 class="card-title" style="text-align:center" >  Répertoire botanique   </h2>  
<hr>
<?php
include("menu.php");
?>

<div class="container">
 <div class="row ">  
  <div class="col-sm">  
  
   
  
<form action="profil_plante.php" method="POST">
            
            <!-- affichage ajout plante réussi -->
            <?php
                if($_GET["ajout"]=="true"){
                    echo "<div class=inscription> Ajout de la plante réussi </div></br>";
                }
            ?>
            <br/>    

<div class="card mb-3">
                       
    <div class="card-body">
    
                
             <div class="input-group">
    <input type="search" class="form-control rounded" id="searchbar" name="plante" placeholder="Rechercher une plante..." aria-label="Search" aria-describedby="search-addon" />
     <button type="submit" class="btn btn-outline-primary" name="searchbar">Rechercher</button>
    </div>
        
     </div> 
 </div> 
         
        
            
    <div class="card mb-3">
                       
    <div class="card-body">    
    
        
    
<div class="row">
 <!-- Type de plante -->  
<div class="col">  
 
  <label for="Type de plante" class="control-label"> Type de plante:</label>    

    <select class="form-control"  onchange="this.form.submit()" name="type">
          <option value="vide" <?php if($_POST['type']=="vide"){echo "selected";}?>>Tous</option> 
          <option value="Arbre" <?php if($_POST['type']=="Arbre"){echo "selected";}?>>Arbre </option>
          <option value="Arbuste" <?php if($_POST['type']=="Arbuste"){echo "selected";}?>>Arbuste </option>
          <option value="Plante" <?php if($_POST['type']=="Plante"){echo "selected";}?>>Plante </option>
          <option value="Algue" <?php if($_POST['type']=="Algue"){echo "selected";}?>>Algue </option>

    </select>              
          
</div>

<!-- Couleur Plante -->
 <div class="col">

    
        <label for="Couleur plante" class="control-label">Couleur plante :</label>
      
        <select class="form-control" name="couleurPlante" onchange="this.form.submit()"> 
                <option value="vide" <?php if($_POST['couleurPlante']=="vide"){echo "selected";}?>>Toutes</option>  
                <option value="Jaune" <?php if($_POST['couleurPlante']=="Jaune"){echo "selected";}?>> Jaune </option> 
                <option value="Blanc" <?php if($_POST['couleurPlante']=="Blanc"){echo "selected";}?>> Blanc </option> 
                <option value="Rose" <?php if($_POST['couleurPlante']=="Rose"){echo "selected";}?>> Rose </option> 
                <option value="Violet" <?php if($_POST['couleurPlante']=="Violet"){echo "selected";}?>> Violet </option> 
                <option value="Orange" <?php if($_POST['couleurPlante']=="Orange"){echo "selected";}?>> Orange </option> 
                <option value="Rouge" <?php if($_POST['couleurPlante']=="Rouge"){echo "selected";}?>> Rouge </option> 
                <option value="Vert" <?php if($_POST['couleurPlante']=="Vert"){echo "selected";}?>> Vert </option> 
                <option value="Bleu" <?php if($_POST['couleurPlante']=="Bleu"){echo "selected";}?>> Bleu </option> 
                <option value="Marron" <?php if($_POST['couleurPlante']=="Marron"){echo "selected";}?>> Marron </option> 
                <option value="Noir" <?php if($_POST['couleurPlante']=="Noir"){echo "selected";}?>> Noir </option> 
                <option valeu="Gris" <?php if($_POST['couleurPlante']=="Gris"){echo "selected";}?>> Gris </option> 
            </select>          
 </div>  
<!-- couleur fleur -->
 <div class="col">

    
        <label for="Couleur fleur" class="control-label"> Couleur fleur:</label>
      
        <select class="form-control" name="couleurFleur" onchange="this.form.submit()">
                <option value="vide" <?php if($_POST['couleurFleur']=="vide"){echo "selected";}?>>Toutes</option>
                <option value="absence" <?php if($_POST['couleurFleur']=="absence"){echo "selected";}?>>Pas de fleur</option>    
                <option value="Jaune" <?php if($_POST['couleurFleur']=="Jaune"){echo "selected";}?>> Jaune </option> 
                <option value="Blanc" <?php if($_POST['couleurFleur']=="Blanc"){echo "selected";}?>> Blanc </option> 
                <option value="Rose" <?php if($_POST['couleurFeur']=="Rose"){echo "selected";}?>> Rose </option> 
                <option value="Violet" <?php if($_POST['couleurFleur']=="Violet"){echo "selected";}?>> Violet </option> 
                <option value="Orange" <?php if($_POST['couleurFleur']=="Orange"){echo "selected";}?>> Orange </option> 
                <option value="Rouge" <?php if($_POST['couleurFleur']=="Rouge"){echo "selected";}?>> Rouge </option> 
                <option value="Vert" <?php if($_POST['couleurFleur']=="Vert"){echo "selected";}?>> Vert </option> 
                <option value="Bleu" <?php if($_POST['couleurFleur']=="Bleu"){echo "selected";}?>> Bleu </option> 
                <option value="Marron" <?php if($_POST['couleurFleur']=="Marron"){echo "selected";}?>> Marron </option> 
                <option value="Noir" <?php if($_POST['couleurFleur']=="Noir"){echo "selected";}?>> Noir </option> 
                <option valeu="Gris" <?php if($_POST['couleurFLeur']=="Gris"){echo "selected";}?>> Gris </option> 
             </select>         
 </div>  


 </div>  
 
 
 
      <hr>
   

 <div class="row"> 


 <div class="col">
          <label for="Couleur fruit" class="control-label"> Couleur fruit :   </label>
      
          
            <select class="form-control" name="couleurFruit" onchange="this.form.submit()"> 
                <option value="vide" <?php if($_POST['couleurFruit']=="vide"){echo "selected";}?>>Toutes</option> 
                <option value="absence" <?php if($_POST['couleurFruit']=="absence"){echo "selected";}?>>Pas de fruit</option> 
                <option value="Jaune" <?php if($_POST['couleurFruit']=="Jaune"){echo "selected";}?>> Jaune </option> 
                <option value="Blanc" <?php if($_POST['couleurFruit']=="Blanc"){echo "selected";}?>> Blanc </option> 
                <option value="Rose" <?php if($_POST['couleurFruit']=="Rose"){echo "selected";}?>> Rose </option> 
                <option value="Violet" <?php if($_POST['couleurFruit']=="Violet"){echo "selected";}?>> Violet </option> 
                <option value="Orange" <?php if($_POST['couleurFruit']=="Orange"){echo "selected";}?>> Orange </option> 
                <option value="Rouge" <?php if($_POST['couleurFruit']=="Rouge"){echo "selected";}?>> Rouge </option> 
                <option value="Vert" <?php if($_POST['couleurFruit']=="Vert"){echo "selected";}?>> Vert </option> 
                <option value="Bleu" <?php if($_POST['couleurFruit']=="Bleu"){echo "selected";}?>> Bleu </option> 
                <option value="Marron" <?php if($_POST['couleurFruit']=="Marron"){echo "selected";}?>> Marron </option> 
                <option value="Noir" <?php if($_POST['couleurFruit']=="Noir"){echo "selected";}?>> Noir </option> 
                <option valeu="Gris" <?php if($_POST['couleurFruit']=="Gris"){echo "selected";}?>> Gris </option> 
            </select>






 </div>

     
 
    <div class="col">
          <label for="Période de floraison " class="control-label"> Période de floraison : </label>
      
          <select class="form-control" name="periodeFleur" onchange="this.form.submit()">
                <option value="vide"<?php if($_POST['periodeFleur']=="vide"){echo "selected";}?>>---</option>  
                <option value="Printemps" <?php if($_POST['periodeFleur']=="Printemps"){echo "selected";}?>> Printemps </option> 
                <option value="Ete" <?php if($_POST['periodeFleur']=="Ete"){echo "selected";}?>> Été </option> 
                <option value="Automne" <?php if($_POST['periodeFleur']=="Automne"){echo "selected";}?>> Automne </option> 
                <option value="Hiver" <?php if($_POST['periodeFleur']=="Hiver"){echo "selected";}?>> Hiver </option> 
            </select> 






 </div>   

 <div class="col">
          <label for="Période de fructification  " class="control-label"> Période de fructification :  </label>
      
          <select class="form-control" name="periodeFruit" onchange="this.form.submit()"> 
                <option value="vide" <?php if($_POST['periodeFruit']=="vide"){echo "selected";}?>>---</option> 
                <option value="Printemps" <?php if($_POST['periodeFruit']=="Printemps"){echo "selected";}?>> Printemps </option> 
                <option value="Ete" <?php if($_POST['periodeFruit']=="Ete"){echo "selected";}?>> Été </option> 
                <option value="Automne" <?php if($_POST['periodeFruit']=="Automne"){echo "selected";}?>> Automne </option> 
                <option value="Hiver" <?php if($_POST['periodeFruit']=="Hiver"){echo "selected";}?>> Hiver </option> 
            </select>






 </div>  







 </div>
           








</div>
</div>      
 <!------------------->         
                                    
 <div class="card mb-3">
  <div class="card-body">           
     

                
                    
                <?php
                    
                    try{
                        $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
                    }
                    catch(Exception $e){
                        die('Erreur :' . $e->getMessage());
                    }

                    if(isset($_POST['plante']) and $_POST['plante']!="" )
                    {
                        $requete = $BDD->prepare('SELECT * FROM plantes INNER JOIN photoplantes ON plantes.Id_plante = photoplantes.Id_plante  WHERE Nom_fr ="'.ucfirst(strtolower($_POST['plante'])).'" OR Nom_latin ="'.ucfirst(strtolower($_POST['plante'])).'" ORDER BY Nom_fr');
                        $requete->execute();
                        /* on récupère le résultt de la requête sous forme d'un tableau */
                        $donnees = $requete->fetchAll();

                        $_POST['type']="vide";
                        $_POST['couleurPlante']="vide";
                        $_POST['couleurFleur']="vide";
                        $_POST['couleurFruit']="vide";
                        $_POST['periodeFleur']="vide";
                        $_POST['periodeFruit']="vide";


                    }

                    else{

                        $requete = $BDD->prepare('SELECT * FROM plantes ORDER BY Nom_fr');
                        $requete->execute();
                        /* on récupère le résultt de la requête sous forme d'un tableau */
                        $donnees = $requete->fetchAll();

                    }

                    if(isset($_POST['type']) and $_POST['type']!="vide" ){
                        
                        foreach ($donnees as $plante){
                            if($plante['Famille']==$_POST['type'] ){ 
                                    $resultat[]=$plante;
                            }
                        }
                        $donnees=$resultat;
                        
                    }
                    else{
                        $resultat=$donnees;
                    }

                    //tri type plante
                   if(isset($_POST['type']) and $_POST['type']!="vide" ){
                        
                        foreach ($donnees as $plante){
                            if($plante['Famille']==$_POST['type'] ){ 
                                    $resultatType[]=$plante;
                            }
                        }
                        $donnees=$resultatType;   
                    }
                   
                    //tri couleur plante
                    if(isset($_POST['couleurPlante']) and $_POST['couleurPlante']!="vide" ){
                        foreach ($donnees as $plante){

                            if($plante['Couleur']==$_POST['couleurPlante'] ){ 
                                    $resultatCouleur[]=$plante;
                            }
                        }
                        $donnees=$resultatCouleur;   
                    }
                    
                    //tri couleur fruit
                    if(isset($_POST['couleurFleur'])){
                        if($_POST['couleurFleur']!="vide" and $_POST['couleurFleur']!="absence" ){
                            foreach ($donnees as $plante){

                                if($plante['Couleur_fleur']==$_POST['couleurFleur'] ){ 
                                        $resultatCouleurFleur[]=$plante;
                                }
                            }
                            $donnees=$resultatCouleurFleur; 
                        } 
                        elseif($_POST['couleurFleur']=="absence"){
                            foreach ($donnees as $plante){

                                if($plante['Fleur']==0 ){ 
                                    $resultatCouleurFleur[]=$plante;
                                }
                            }
                            $donnees=$resultatCouleurFleur; 
                        }
                        
                    }
                    
                    

                    //tri couleur fruit
                    if(isset($_POST['couleurFruit'])){ 
                        if($_POST['couleurFruit']!="vide" and $_POST['couleurFruit']!="absence" ){
                            foreach ($donnees as $plante){

                                if($plante['Couleur_fruit']==$_POST['couleurFruit'] ){ 
                                        $resultatCouleurFruit[]=$plante;
                                }
                            }
                            $donnees=$resultatCouleurFruit;
                        } 
                        elseif($_POST['couleurFruit']=="absence"){
                            foreach ($donnees as $plante){

                                if($plante['Fruit']==0 ){ 
                                    $resultatCouleurFruit[]=$plante;
                                }
                            }
                            $donnees=$resultatCouleurFruit; 
                        }   
                    }
                    
                    //tri période fleur
                    if(isset($_POST['periodeFleur']) and $_POST['periodeFleur']!="vide" ){
                        foreach ($donnees as $plante){

                            if($plante['Période_floraison']==$_POST['periodeFleur'] ){ 
                                    $resultatPeriodeFleur[]=$plante;
                            }
                        }
                        $donnees=$resultatPeriodeFleur;   
                    }

                    //tri période fruit
                    if(isset($_POST['periodeFruit']) and $_POST['periodeFruit']!="vide" ){
                        foreach ($donnees as $plante){

                            if($plante['Période_fructification']==$_POST['periodeFruit'] ){ 
                                    $resultatPeriodeFruit[]=$plante;
                            }
                        }
                        $donnees=$resultatPeriodeFruit;   
                    }


                    
                    if (count($donnees)==0)   
                    {
                        echo "<p align=\"center\"> Aucun résultat disponible </p>";
                    } 
                    else{
                        $lettre_courante = null;
                        foreach ($donnees as $plante){
                            
                            if(($lettre_courante=='D' && $plante['Nom_fr'][0]!='D' && $plante['Nom_fr'][0]!='F') || ( $lettre_courante=='C' && $plante['Nom_fr'][0]!='D' && $plante['Nom_fr'][0]!='C') )
                            {
                                $premiere_lettre='E';
                            }
                            else
                            {
                                $premiere_lettre=$plante['Nom_fr'][0];
                            }

                            if( $lettre_courante != $premiere_lettre ) {
                                $lettre_courante=$plante['Nom_fr'][0];  
                                echo'<div class = "lettre">';
                                echo $premiere_lettre.".";  
                                echo'</div>';
                            }
                ?>
                <a href="profil_plante.php?id=<?php echo $plante['Id_plante']?> " id="lien_plante">
                    <div class = "carre_plante">
                            <div class="Plante">
                                <img src=" data:image/jpg;base64,<?php echo base64_encode($plante['Photo']);?> " id="image_plante" >
                                <output name=nom_lat id=planteinfos> Nom français : <?php echo $plante['Nom_fr'];?></output></br>
                                <output name=nom_fr id=planteinfos>  Nom latin : <?php echo $plante['Nom_latin'];?></output></br>
                                <output name=region id=planteinfos>  Régions : <?php echo $plante['Régions'];?></output>    
                            </div>
                    </div>
                </a>
                <?php
                    }
                }
                ?>

          
          
        
            

         
            
        
       
       
            

           
            
  </div>
  </div>  
 
<!------------------->              
                                
  
</form>

         
    <div class="footer">
    Copyright &copy; 2022 &mdash; Université de Limoges
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
