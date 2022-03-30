<?php
    session_start();
?>
<html>
<head>
<link href="test.css" rel="stylesheet" type="text/css" media="all" />
</head>  


<body>

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
                        <?php
                            if(isset($_SESSION['id']) and empty($_GET['deco'])){
                                echo ("<a href=\"ajout_signalement.php\">Signaler une plante</a>");
                            }
                        ?>
                        
                        <?php 
                            if($_SESSION['rang']==3 and isset($_GET['deco'])){
                                echo("<a href=\"ajout_plante.php\">Ajouter une plante</a>");
                            }
                        ?>
                        <?php
                            if(isset($_SESSION['id']) and empty($_GET['deco'])){
                                echo ("<a href=\"\">Vos amis</a>");
                            }
                        ?>
                        
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

</body>
</html>
