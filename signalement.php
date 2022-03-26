<?php
  session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Signalement</title>
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
        <form>

        <?php
            
            try{
                $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
            }
            catch(Exception $e){
                die('Erreur :' . $e->getMessage());
            }
            $requeteJointure = $BDD->prepare('SELECT plantes.Nom_fr, utilisateurs.Pseudo, signalements.Ville, signalements.Coordonnees_GPS, signalements.Date_signalement 
                                                    FROM signalements INNER JOIN plantes ON plantes.Id_plante=signalements.Id_plante
                                                                      INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=signalements.Id_utilisateur
                                                                      WHERE Id_signalement="'.$_GET["id"].'"');
                    
            $requeteJointure->execute();
            $signalement = $requeteJointure->fetch(); 
            
        ?>    
            
            <h1 style="text-align:center"> Signalement </h1> <!-- récupéré dans bdd-->
            <img src  > <!--mettre photo de la bdd et voir avec js pour faire des flèches pour faire défiler les images s'il y en a plusieurs-->
            <br/>
            
            <div class="renseignement">
                <div id="titre">
                La plante :
                </div>
                <output name="plante"><?php echo $signalement['Nom_fr']; ?> </output> 
            </div>
            <div class="renseignement">
                <div id="titre">
                L'utilisateur qui a signalé :
                </div>
                <output name="utilisateur"><?php echo $signalement['Pseudo']; ?> </output> 
            </div>
            <div class="renseignement">
                <div id="titre">
                Date : 
                </div>
                <output name="date"><?php echo $signalement['Date_signalement']; ?></output> 
            </div>
            <div class="renseignement">
                <div id="titre">
                Ville :
                </div>
                <output name="floraison"><?php echo $signalement['Ville']; ?></output> 
            </div>
            <div id=map>
                <iframe width="100%" height="100%" frameborder="0" src="Map.php"></iframe>
            </div>

            <div class="renseignement">
                <div id="titre">
                Commentaire :
                </div>
                <output name="fleur"><?php echo $signalement['Commentaire']; ?></output> 
            </div>
            
            
            <!-- mettre une carte -->
            
            <button id="boutonmodif" type=button onclick="">
                Valider le signalement
            </button>
            <button id="boutonmodif" type=button onclick="">
                Supprimer le signalement
            </button>
        </form>

        <footer>
        <div id="baspage"> Contact</div>
        </footer> 
    </body>
</html>
