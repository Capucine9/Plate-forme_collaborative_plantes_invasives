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
            <h1 style="text-align:center"> Répertoire botanique </h1>
            <!-- affichage ajout plante réussie -->
            <?php
                if($_GET["ajout"]=="true"){
                    echo "<div class=inscription> Ajout de la plante réussie </div></br>";
                }
            ?>
            <br/>
            <input id="searchbar" onkeyup="recherche_plante()" type="text" placeholder="Rechercher une plante...">

            Type de plante :
            <select name="liste"> 
                <option>---</option> 
                <option>Arbre </option>
                <option>Arbuste </option>
                <option>Plante </option>
                <option>Algue </option>
            </select>

            Couleur fleur : 
            <select name="listefleur">
            <option>---</option>  
            <option> Jaune </option> 
            <option> Blanc </option> 
            <option> Rose </option> 
            <option> Violet </option> 
            <option> Orange </option> 
            <option> Rouge </option> 
            <option> Vert </option> 
            <option> Bleu </option> 
            <option> Marron </option> 
            <option> Noir </option> 
            <option> Gris </option> 
            </select>

            Couleur fruit : 
            <select name="listefruit"> 
            <option>---</option> 
            <option> Jaune </option> 
            <option> Blanc </option> 
            <option> Rose </option> 
            <option> Violet </option> 
            <option> Orange </option> 
            <option> Rouge </option> 
            <option> Vert </option> 
            <option> Bleu </option> 
            <option> Marron </option> 
            <option> Noir </option> 
            <option> Gris </option> 
            </select>

            Période de floraison : 
            <select name="listefruit">
            <option>---</option>  
            <option> Printemps </option> 
            <option> Été </option> 
            <option> Automne </option> 
            <option> Hiver </option> 
            </select>

            Période de fructification : 
            <select name="listefruit"> 
            <option>---</option> 
            <option> Printemps </option> 
            <option> Été </option> 
            <option> Automne </option> 
            <option> Hiver </option> 
            </select>


            <button id=tri> Trier </button>
            
            <div class= "carre">
                
                    
                <?php
                    
                    try{
                        $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
                    }
                    catch(Exception $e){
                        die('Erreur :' . $e->getMessage());
                    }

                    $requete = $BDD->prepare('SELECT * FROM plantes ORDER BY Nom_fr');
                    $requete->execute();
                    /* on récupère le résultt de la requête sous forme d'un tableau */
                    $donnees = $requete->fetchAll();
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
                                <img src="ailante.jpg" id="image_plante" > 
                                <output name=nom_lat id=planteinfos> Nom français : <?php echo $plante['Nom_fr'];?></output></br>
                                <output name=nom_fr id=planteinfos>  Nom latin : <?php echo $plante['Nom_latin'];?></output></br>
                                <output name=region id=planteinfos>  Régions : <?php echo $plante['Régions'];?></output>    
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
