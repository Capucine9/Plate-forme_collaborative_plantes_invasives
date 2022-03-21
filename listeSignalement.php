<!DOCTYPE html>
<html>
    <head>
        <title>Répertoire botanique</title>
        <meta charset="utf-8">
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    </head>
    <body>
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

        
        <form action="profil_plante.php" method="POST">
            <h1 style="text-align:center"> Liste des signalements </h1>
                 <!-- affichage ajout signalement réussi -->
                <?php
                    if($_GET["ajout"]=="true"){
                        echo "<div class=inscription> Ajout du signalement réussi </div></br>";
                    }
                ?>
            <br/>
            
            <input id="searchbar" type="text" placeholder="Rechercher une plante..." name="plante">
            <button type="submit" name="searchbar">Rechercher</button>
            
           Depuis :
           <select name="liste"> 
                <option>---</option> 
                <option>24h </option>
                <option>une semaine </option>
                <option>un mois  </option>
                <option>un an </option>
                <option>le début du site </option>
            </select>
            
            <div class= "carre">
                
                    
                <?php
                ini_set( 'display_errors', 'on' );
                error_reporting( E_ALL );
                    if(!empty($_POST)){
                        if(isset($_POST['searchbar'])){
                         
                            try{
                                $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
                                $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $BDD->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                            }
                            catch(Exception $e){
                                die('Erreur :' . $e->getMessage());
                            }
    
                            
                                $requeteJointure = $BDD->prepare('SELECT plantes.Nom_fr, utilisateurs.Pseudo, signalements.Ville, signalements.Coordonnees_GPS, signalements.Date_signalement, signalements.Id_signalement 
                                                                FROM signalements INNER JOIN plantes ON plantes.Id_plante=signalements.Id_plante
                                                                                INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=signalements.Id_utilisateur
                                                                                WHERE plantes.Nom_fr ="'.ucfirst(strtolower($_POST['plante'])).'" OR plantes.Nom_latin ="'.ucfirst(strtolower($_POST['plante'])).'"
                                                                                ORDER BY signalements.Date_signalement DESC');
                                
                                $requeteJointure->execute();
                                $donnees = $requeteJointure->fetchAll(); 
                            

                        }
                    }
                    else{
                        try{
                            $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
                            $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $BDD->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                        }
                        catch(Exception $e){
                            die('Erreur :' . $e->getMessage());
                        }


                            $requeteJointure = $BDD->prepare('SELECT plantes.Nom_fr, utilisateurs.Pseudo, signalements.Ville, signalements.Coordonnees_GPS, signalements.Date_signalement, signalements.Id_signalement 
                                                            FROM signalements INNER JOIN plantes ON plantes.Id_plante=signalements.Id_plante
                                                                            INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=signalements.Id_utilisateur
                                                                            ORDER BY signalements.Date_signalement DESC');
                            
                            $requeteJointure->execute();
                            $donnees = $requeteJointure->fetchAll(); 
                    }       
                    if (count($donnees)==0)   
                    {
                        echo "<p align=\"center\"> Aucun résultat disponible </p>";
                    } 
                    else{     
                        
                        if(isset($_POST['liste'])){
                            $date=$_POST['liste'];
                            $aujourdhui=date('Y-m-d');
                            $resultat=array();
                            if($date == "un jour"){
                               
                                $aujourdhui=strtotime($aujourdhui);
                                foreach ($donnees as $signalement){
                                    $dateSignal=strtotime($signalement['Date_signalement']);
                                    if((($aujourdhui - $dateSignal)/86400) <=1){
                                        $resultat[]=$signalement;
                                    }
                                }
                                
                            }
                            elseif($date == "une semaine"){

                            }
                            elseif($date == "un mois"){

                            }
                            elseif($date == "un an"){

                            }

                            unset($donnees);
                            $donnees=$resultat;
                        }
                    }
                        foreach ($donnees as $signalement){

                        
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
                
                ?>

            </div>

        </form>

        <footer>
        <div id="baspage"> Contact</div>
        </footer> 
    </body>
</html>
