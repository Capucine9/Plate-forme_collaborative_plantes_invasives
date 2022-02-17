<!DOCTYPE html>
<html>
    <head>
        <title>Répertoire botanique</title>
        <meta charset="utf-8">
        <link href="test.css" rel="stylesheet" type="text/css" media="all" />
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
                    <a href="">Les utilisateurs</a>
                    <a href="">Les derniers signalements</a>
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
                    
                    foreach ($donnees as $signalement){
                        
                ?>
                <a href="signalement.php?id=<?php echo $signalement['Id_signalement']?> " id="lien_plante">
                    <div class = "carre_plante">
                            <div class="Plante">
                                <img src="ailante.jpg" id="image_plante" > 
                                <output name=nom_lat id=planteinfos> Nom de la plante : <?php echo $signalement['Id_plante'];?></output></br>
                                <output name=nom_fr id=planteinfos>  Personne qui l'a signalée : <?php echo $signalement['Id_utilisateur'];?></output></br>
                                <output name=region id=planteinfos>  Ville : <?php echo $signalement['Ville'];?></output>  
                                <output name=gps id=planteinfos>  Coordonnées GPS : <?php echo $signalement['Coordonnees_GPS'];?></output>  
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