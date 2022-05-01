<!DOCTYPE html>
<html>
    <head>
        <title>Liste signalement</title>
        <meta charset="utf-8">
        <link href="test.css" rel="stylesheet" type="text/css" media="all" />
    </head>
    <body>
        <div id="header">Plate-forme collaborative de lutte contre les plantes invasives</div>


        <!--menu déroulant-->
        <?php include(menu.php); ?>
        
        <form action="" method="POST">
            <h1 style="text-align:center"> Liste des signalements </h1>
            
            <!-- affichage ajout signalement réussi -->
            <?php
                if($_GET["ajout"]=="true"){
                    echo "<div class=inscription> Ajout du signalement réussi </div></br>";
                }
            ?>
            <br/>
            
            <input id="searchbar" type="text" placeholder="Rechercher une plante..." name="plante" value=<?php echo "\"".$_POST['plante']. "\""; ?>>
            <button type="submit" name="searchbar">Rechercher</button>

           Depuis :
           <select name="liste" onchange="this.form.submit()"> 
                <option value="tout" <?php if($_POST['liste']=="tout"){echo "selected";}?>> le début du site</option> 
                <option value="jour" <?php if($_POST['liste']=="jour"){echo "selected";}?>>un jour </option>
                <option value="semaine" <?php if($_POST['liste']=="semaine"){echo "selected";}?>>une semaine </option>
                <option value="mois" <?php if($_POST['liste']=="mois"){echo "selected";}?>>un mois  </option>
                <option value="an" <?php if($_POST['liste']=="an"){echo "selected";}?>>un an </option>
            </select>

            Trier par :
            <select name="tri" onchange="this.form.submit()"> 
                <option value="dateRec" <?php if($_POST['tri']=="dateRec"){echo "selected";}?>> Date du plus récent </option>
                <option value="dateAnc" <?php if($_POST['tri']=="dateAnc"){echo "selected";}?>> Date du plus ancien </option>
                <option value="plante" <?php if($_POST['tri']=="plante"){echo "selected";}?>> Ordre alphabétique plante</option> 
            </select>

            
            
            <div class= "carre">  
                    
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
                                $requeteJointure = $BDD->prepare('SELECT plantes.Nom_fr, utilisateurs.Pseudo, signalements.Ville, signalements.Coordonnees_GPS, signalements.Date_signalement, signalements.Id_signalement, signalements.Verifier 
                                                                    FROM signalements INNER JOIN plantes ON plantes.Id_plante=signalements.Id_plante
                                                                    INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=signalements.Id_utilisateur
                                                                    WHERE (plantes.Nom_fr ="'.ucfirst(strtolower($_POST['plante'])).'" OR plantes.Nom_latin ="'.ucfirst(strtolower($_POST['plante'])).'") AND signalements.Verifier=0
                                                                    ORDER BY signalements.Date_signalement DESC');
                                                
                                $requeteJointure->execute();
                                $donnees = $requeteJointure->fetchAll();
                            }
                            
                            else{
                                if($_POST['tri']=="dateAnc"){
                                    $requeteJointure = $BDD->prepare('SELECT plantes.Nom_fr, utilisateurs.Pseudo, signalements.Ville, signalements.Coordonnees_GPS, signalements.Date_signalement, signalements.Id_signalement, signalements.Verifier  
                                                                        FROM signalements INNER JOIN plantes ON plantes.Id_plante=signalements.Id_plante
                                                                        INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=signalements.Id_utilisateur
                                                                        WHERE (plantes.Nom_fr ="'.ucfirst(strtolower($_POST['plante'])).'" OR plantes.Nom_latin ="'.ucfirst(strtolower($_POST['plante'])).'") AND signalements.Verifier=0
                                                                        ORDER BY signalements.Date_signalement ASC');
                                        
                                    $requeteJointure->execute();
                                    $donnees = $requeteJointure->fetchAll();
                                }

                                else{
                                    $requeteJointure = $BDD->prepare('SELECT plantes.Nom_fr, utilisateurs.Pseudo, signalements.Ville, signalements.Coordonnees_GPS, signalements.Date_signalement, signalements.Id_signalement, signalements.Verifier  
                                                                        FROM signalements INNER JOIN plantes ON plantes.Id_plante=signalements.Id_plante
                                                                        INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=signalements.Id_utilisateur
                                                                        WHERE (plantes.Nom_fr ="'.ucfirst(strtolower($_POST['plante'])).'" OR plantes.Nom_latin ="'.ucfirst(strtolower($_POST['plante'])).'") AND signalements.Verifier=0
                                                                        ORDER BY plantes.Nom_fr ');
                
                                    $requeteJointure->execute();
                                    $donnees = $requeteJointure->fetchAll();
                                }
                            }
                        }
                        
                        else{

                            if(isset($_POST['tri']) and ($_POST['tri']=="" or $_POST['tri']=="dateRec")){
                                $requeteJointure = $BDD->prepare('SELECT plantes.Nom_fr, utilisateurs.Pseudo, signalements.Ville, signalements.Coordonnees_GPS, signalements.Date_signalement, signalements.Id_signalement, signalements.Verifier  
                                                                    FROM signalements INNER JOIN plantes ON plantes.Id_plante=signalements.Id_plante
                                                                    INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=signalements.Id_utilisateur
                                                                    WHERE signalements.Verifier=0
                                                                    ORDER BY signalements.Date_signalement DESC');
                                                
                                $requeteJointure->execute();
                                $donnees = $requeteJointure->fetchAll();
                            }
                            
                            else{
                                if(isset($_POST['tri']) and $_POST['tri']=="dateAnc"){
                                    $requeteJointure = $BDD->prepare('SELECT plantes.Nom_fr, utilisateurs.Pseudo, signalements.Ville, signalements.Coordonnees_GPS, signalements.Date_signalement, signalements.Id_signalement, signalements.Verifier  
                                                                        FROM signalements INNER JOIN plantes ON plantes.Id_plante=signalements.Id_plante
                                                                        INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=signalements.Id_utilisateur
                                                                        WHERE signalements.Verifier=0
                                                                        ORDER BY signalements.Date_signalement ASC');
                                        
                                    $requeteJointure->execute();
                                    $donnees = $requeteJointure->fetchAll();
                                }

                                else{
                                    $requeteJointure = $BDD->prepare('SELECT plantes.Nom_fr, utilisateurs.Pseudo, signalements.Ville, signalements.Coordonnees_GPS, signalements.Date_signalement, signalements.Id_signalement, signalements.Verifier  
                                                                        FROM signalements INNER JOIN plantes ON plantes.Id_plante=signalements.Id_plante
                                                                        INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=signalements.Id_utilisateur
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


                                $requeteJointure = $BDD->prepare('SELECT plantes.Nom_fr, utilisateurs.Pseudo, signalements.Ville, signalements.Coordonnees_GPS, signalements.Date_signalement, signalements.Id_signalement, signalements.Verifier  
                                                                FROM signalements INNER JOIN plantes ON plantes.Id_plante=signalements.Id_plante
                                                                                INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=signalements.Id_utilisateur
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
                    <div class = "carre_plante">
                            <div class="Plante">
                                <img src="ailante.jpg" id="image_plante" > 
                                <output name=nom_plante id=planteinfos> Nom de la plante : <?php echo $signalement['Nom_fr'];?></output></br>
                                <output name=pseudo id=planteinfos>  Personne qui l'a signalée : <?php echo $signalement['Pseudo'];?></output></br>
                                <output name=ville id=planteinfos>  Ville : <?php echo $signalement['Ville'];?></output> </br> 
                                <output name=gps id=planteinfos>  Coordonnées GPS : <?php echo $signalement['Coordonnees_GPS'];?></output></br>  
                                <output name=date id=planteinfos>  Date : <?php echo $signalement['Date_signalement'];?></output>  
                            </div>
                    </div>
                </a>
                <?php
                        }
                    }

                
                
                
                
                ?>

            </div>

        </form>

        <footer>
        <div id="baspage"> Contact</div>
        </footer> 
    </body>
</html>
