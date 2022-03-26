<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Profil Utilisateur</title>
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
            $requete = 'SELECT * FROM utilisateurs WHERE Id_utilisateur="'.$_GET["id"].'"';
            $requete = $BDD->prepare($requete);
            $requete->execute();
            /* on récupère le résultt de la requête sous forme d'un tableau */
            $utilisateur = $requete->fetch();

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

            <h1 style="text-align:center"> <output name="pseudo"><?php echo $utilisateur['Pseudo']; ?></output>  </h1>
            <img src  >
            <br/>
            
            <div class="renseignement">
                <div id="titre">
                Adresse mail :
                </div>
                <output name="email"><?php echo $utilisateur['Email']; ?></output> 
            </div>
            <div class="renseignement">
                <div id="titre">
                Rang :
                </div>
                <output name="rang"><?php echo $rang; ?></output> 
            </div>
            <div class="renseignement">
                <div id="titre">
                Catégorie :
                </div>
                <output name="categorie"><?php echo $type; ?></output> 
            </div>
            <?php
                if ($type=="entreprise")
                    echo'
                            <div class="renseignement">
                                <div id="titre">
                                URL du l\'entreprise :
                                </div>
                                <output name="URL">'.$utilisateur['URL_entreprise'].'</output>
                            </div>'?>
            <div class="renseignement">
                <div id="titre">
                    Nombre de bons signalements :
                </div>
                <output name="signalement"><?php echo $utilisateur['Nb_bon_signalement']; ?></output> 
            </div>



            <button id="boutonmodif" type=button onclick="">
                Envoyer une demande d'ami
            </button>
        </form>

        <footer>
        <div id="baspage"> Contact</div>
        </footer> 
    </body>
</html>
