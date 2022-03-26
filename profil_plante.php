<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Profil Plante</title>
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
                    <?php
                        if(isset($_SESSION['id']) and empty($_GET['deco'])){
                            echo ("<a href=\"accueil.php?deco=1\">Déconnexion</a>");
                        }
                        else{
                            echo("<a href=\"connexion.php\">Connexion</a> <a href=\"inscription.php\">Inscription</a>");
                        }
                    ?>
                    
                    
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
            $requeteJointure = 'SELECT * FROM plantes INNER JOIN utilisateurs ON utilisateurs.Id_utilisateur=plantes.Id_utilisateur WHERE Id_plante="'.$_GET["id"].'"';
            
                                                
            $requeteJointure = $BDD->prepare($requeteJointure);
            $requeteJointure->execute();
            $plante = $requeteJointure->fetch();
            
        ?>   
            
            <h1 style="text-align:center"> <?php echo $plante['Nom_fr']; ?> </h1> <!-- récupéré dans bdd-->
            <img src  > <!--mettre photo de la bdd et voir avec js pour faire des flèches pour faire défiler les images s'il y en a plusieurs-->
            <br/>
            
            <div class="renseignement">
                <div id="titre">
                Nom latin : 
                </div>
                <output name="nomlat"><?php echo $plante['Nom_latin']; ?> </output> 
            </div>
            <div class="renseignement">
                <div id="titre">
                Type : 
                </div>
                <output name="nomlat"><?php echo $plante['Nom_latin']; ?> </output> 
            </div>
            <div class="renseignement">
                <div id="titre">
                Taille moyenne :
                </div>
                <output name="taille"><?php echo $plante['Taille']; ?> cm</output> 
            </div>
            <div class="renseignement">
                <div id="titre">
                Couleur principale :
                </div>
                <output name="taille"><?php echo $plante['Couleur']; ?> </output> 
            </div>
            <div class="renseignement">
                <div id="titre">
                Couleur des fleurs :
                </div>
                <output name="fleur"><?php echo $plante['Couleur_fleur']; ?></output> 
            </div>
            <div class="renseignement">
                <div id="titre">
                Couleur des fruits :
                </div>
                <output name="floraison"><?php echo $plante['Couleur_fruit']; ?></output> 
            </div>
            
            <div class="renseignement">
                <div id="titre">
                Description détaillée :
                </div>
                <output name="descrip"><?php echo $plante['Details']; ?></output> 
            </div>

            <div class="renseignement">
                <div id="titre">
                Régions :
                </div>
                <p id="description"><?php echo $plante['Régions']; ?></p> 
            </div>
            <div class="renseignement">
                <div id="titre">
                Personne qui l'a ajouté au site :
                </div>
                <output name="taille"><?php echo $plante['Pseudo']; ?></output> 
            </div>
            <div id=map>
                <iframe width="100%" height="100%" frameborder="0" src="Map.php"></iframe>
            </div>
            <button id="boutonmodif" type=button onclick="">
                Modifier
            </button>
            <button id="boutonmodif" type=button onclick="">
                Ajouter un signalement
            </button>
        </form>

        <footer>
        <div id="baspage"> Contact</div>
        </footer> 
    </body>
</html>
