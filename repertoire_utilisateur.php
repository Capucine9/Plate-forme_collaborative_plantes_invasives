<?php
  session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Répertoire utilisateurs</title>
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
                        <?php
                        if(isset($_SESSION['id']) and empty($_GET['deco'])){
                            echo ("<a href=\"profil_utilisateur.php\">Votre profil</a>");
                        }
                        ?>
                        <a href="repertoire_botannique.php">Le répertoire botannique</a>
                        <a href="repertoire_utilisateur.php">Les utilisateurs</a>
                        <a href="listeSignalement.php">Les derniers signalements</a>
                        <a href="ajout_signalement.php">Signaler une plante</a>
                        <?php 
                        if($_SESSION['rang']==3){
                            echo("<a href=\"ajout_plante.php\">Ajouter une plante</a>");
                        }
                        ?>
                        <a href="">Vos amis</a>
                        <a href="connexion.php">Connexion</a>
                        <a href="inscription.php">Inscription</a>
                    </div>
    </div>

    <?php
   if($_GET['deco']==1){
        session_destroy();
        echo ("<p align=\"center\"> Vous avez été déconnecté </p>");
    }

  ?>

        
        <form action="profil_plante.php" method="POST">
            <h1 style="text-align:center"> Répertoire des utilisateurs </h1>
            
            <br/>
            <input id="searchbar" onkeyup="recherche_utilisateur()" type="text" placeholder="Rechercher un utilisateur...">
            
            <div class= "carre">
                
                    
                <?php
                    
                    try{
                        $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
                    }
                    catch(Exception $e){
                        die('Erreur :' . $e->getMessage());
                    }

                    $requete = $BDD->prepare('SELECT * FROM utilisateurs ORDER BY Rang, Pseudo');
                    $requete->execute();
                    /* on récupère le résultt de la requête sous forme d'un tableau */
                    $donnees = $requete->fetchAll();
                    
                    foreach ($donnees as $utilisateur){
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
                <a href="profil_utilisateur_autre.php?id=<?php echo $utilisateur['Id_utilisateur']?> " id="lien_plante">
                    <div class = "carre_plante">
                            <div class="Plante">
                                <img src="ailante.jpg" id="image_plante" > 
                                
                                <output name=pseudo id=planteinfos> Pseudo : <?php echo $utilisateur['Pseudo'];?></output></br>
                                <output name=email id=planteinfos>  Email : <?php echo $utilisateur['Email'];?></output></br>
                                <output name=rang id=planteinfos>  Rang : <?php echo $rang;?></output></br>    
                                <output name=rang id=planteinfos>  Catégorie : <?php echo $type;?></output></br> 
                                <?php
                                    if($type==1)   
                                        echo "<output name=rang id=planteinfos>  URL de l'entreprise :".$utilisateur['URL_entreprise']."</output>" ;
                                
                                ?>

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
