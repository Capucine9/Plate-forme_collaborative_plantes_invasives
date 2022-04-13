
<!DOCTYPE html>
<html>
    <head>
        <title>Profil Utilisateur</title>
        <meta charset="utf-8">
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    </head>
    <body>
        <div id="header">Plate-forme collaborative de lutte contre les plantes invasives</div>
       
    <?php
    include("menu.php");
    ?>
        
<?php 
      
      ini_set( 'display_errors', 'on' );
      error_reporting( E_ALL );
      $errors = array();
        try{
          $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
          $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $BDD->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
          die('Erreur :' . $e->getMessage());
        }

        $requete=$BDD->prepare('SELECT * FROM utilisateurs WHERE Id_utilisateur ="'.$_SESSION['id'].'"');
        $requete->execute();
        $utilisateur=$requete->fetch();

        if($utilisateur['Rang']==1){
            $rang="débutant";
        }
        elseif($utilisateur['Rang']==2){
            $rang="intermédiaire";
        }
        else{
            $rang="professionnel";
        }
                
?>
        
        <form>
            <h1 style="text-align:center"> Mes informations </h1>
            <div class="image">
                <?php if($utilisateur['Photo']==NULL){?>
                    <img src="images\profil.jpg" width = 300 > 
                <?php }
                else{ ?>
                <img src="data:image/jpg;base64,<?php echo base64_encode($utilisateur['Photo']);?> " width = 300 > 
                <?php } ?>
            </div>
            <br/>
            
            <div class="renseignement">
                <div id="titre">
                Pseudo : 
                </div>
                <output name="pseudo"><?php echo($utilisateur['Pseudo']);?></output>
            </div>
            
            <div class="renseignement">
                <div id="titre">
                Adresse mail :
                </div>
                <output name="email"><?php echo($utilisateur['Email']);?></output> 
            </div>
            <div class="renseignement">
                <div id="titre">
                Rang :
                </div>
                <output name="nbSignal"><?php echo($utilisateur['Nb_bon_signalement']);?></output> 
            </div>
            <div class="renseignement">
                <div id="titre">
                Nombre de bons signalements :
                </div>
                <output name="nbSignal"><?php echo($rang);?></output> 
            </div>


            <button id="boutonmodif" type=button onclick="">
                Modifier
            </button>
        </form>

        <footer>
        <div id="baspage"> Contact</div>
        </footer> 
    </body>
</html>
