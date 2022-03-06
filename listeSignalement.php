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
            
            <br/>
            <input id="searchbar" onkeyup="recherche_plante()" type="text" placeholder="Rechercher une plante...">

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
                    
                    try{
                        $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
                    }
                    catch(Exception $e){
                        die('Erreur :' . $e->getMessage());
                    }

                    $requete = $BDD->prepare('SELECT * FROM signalements ORDER BY Date_signalement');
                    $requete->execute();
                    /* on récupère le résultt de la requête sous forme d'un tableau */
                    $donnees = $requete->fetchAll();
                    $requete->closeCursor();
                    foreach ($donnees as $signalement){

                        $requeteUtilisateur = $BDD->prepare('SELECT * FROM utilisateurs WHERE Id_utilisateur ="'.$signalement['Id_utilisateur'].'"');
                        $requeteUtilisateur->execute();
                        /* on récupère le résultt de la requête sous forme d'un tableau */
                        $utilisateur = $requete->fetch();
                        $requeteUtilisateur->closeCursor();
                        echo $utilisateur['Id_utilisateur'];


                        $requetePlante = $BDD->prepare('SELECT * FROM plantes WHERE Id_plante ="'. $signalement['Id_plante'].'"');
                        $requetePlante->execute();
                        /* on récupère le résultt de la requête sous forme d'un tableau */
                        $plante = $requete->fetch();
                        $requetePlante->closeCursor();
                        
                ?>
                <a href="signalement.php?id=<?php echo $signalement['Id_signalement']?> " id="lien_plante">
                    <div class = "carre_plante">
                            <div class="Plante">
                                <img src="ailante.jpg" id="image_plante" > 
                                <output name=nom_plante id=planteinfos> Nom de la plante : <?php echo $plante['Nom_fr'];?></output></br>
                                <output name=pseudo id=planteinfos>  Personne qui l'a signalée : <?php echo $utilisateur['Pseudo'];?></output></br>
                                <output name=ville id=planteinfos>  Ville : <?php echo $signalement['Ville'];?></output> </br> 
                                <output name=gps id=planteinfos>  Coordonnées GPS : <?php echo $signalement['Coordonnees_GPS'];?></output></br>  
                                <output name=date id=planteinfos>  Date : <?php echo $signalement['Date'];?></output>  
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