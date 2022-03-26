<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta charset="utf-8" />
      <title>
          Ajout d'une plante
      </title>
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

    <?php
      if(isset($_POST['valider'])){
        if(!empty($_POST)){

          $errors = array();

          if(empty($_POST['nomfr']) || !preg_match('/^[A-Za-z ]+$/', $_POST['nomfr'])){
            $errors['nomfr']="Nom français non valide";
          }

          if(empty($_POST['nomlat']) || !preg_match('/^[A-Za-z ]+$/', $_POST['nomlat'])){
            $errors['nomlat']="Nom latin non valide";
          }

          if(empty($_POST['region']) || !preg_match('/^[A-Za-z ]+$/', $_POST['region'])){
            $errors['region']="Région non valide";
          }

          if(empty($_POST['taille']) || !preg_match('/^[0-9 ]+$/', $_POST['taille'])){
            $errors['taille']="Taille non valide";
          }

          if($_POST['famille']==NULL){
            $errors['famille']="Famille botanique non remplie";
          }

          if(empty($_POST['couleur'])){
            $errors['couleur']="Couleur non remplie";
          }

          if($_POST['fleur'] =='oui'){

            if(empty($_POST['couleurfleur'])){
              $errors['couleurfleur']="Couleur des fleurs non remplie";
            }
            if(empty($_POST['periodefleur'])){
              $errors['periodefleur']="Période de floraison non remplie";
            }

          }

          if($_POST['fruit'] =='oui'){

            if(empty($_POST['couleurfruit'])){
              $errors['couleurfruit']="Couleur des fruits non remplie";
            }
            if(empty($_POST['periodefruit'])){
              $errors['periodefruit']="Période de fructification non remplie";
            }

          }

          if(empty($_POST['famille'])){
            $errors['famille']="Famille botanique non remplie";
          }
          
           //connexion bdd           
          try{
            $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
            $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $BDD->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
          }
          catch(Exception $e){
            echo 'Erreur :' . $e->getMessage();
          }

          #on vérifie si l'adresse mail est déjà dans la bdd  
          $requetenom = $BDD->prepare('SELECT * FROM plantes WHERE Nom_fr ="'.ucfirst($_POST['nomfr']).'" OR Nom_latin ="'.ucfirst($_POST['nomlat']).'"');
          $requetenom->execute();
          $nb = $requetenom->rowCount();
        
          if($nb != 0)
          {
            $errors['nomexiste']="La plante est déjà dans la base de données";
          }

        }

        if(empty($errors)){
          
          //récupération de toutes les valeurs
          $nomfr = ucfirst($_POST['nomfr']);
          $nomlat = ucfirst($_POST['nomlat']);
          $famille = $_POST['famille'];
          $region = $_POST['region'];
          $taille = floatval($_POST['taille']);
          $description = $_POST['description'];

          $couleur=$_POST['couleur'];
          
          
         if($_POST['fleur'] =='oui')
          {
            $fleur = 1;
            $periodefleur = $_POST['periodefleur'];
            $couleurfleur = $_POST['couleurfleur'];
            
          }
          else
          {
            $fleur = 0;
            $couleurfleur = NULL;
            $periodefleur = NULL;
          }

          if($_POST['fruit'] =='oui')
          {
            $fruit = 1;
            $couleurfruit = $_POST['couleurfruit'];
            $periodefruit = $_POST['periodefruit'];;
          }
          else
          {
            $fruit = 0;
            $couleurfruit = NULL;
            $periodefruit = NULL;
          }

          //insertion
         try{
            $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
            $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $BDD->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
          }
          catch(Exception $e){
            echo 'Erreur :' . $e->getMessage();
          }
          try{
            $req = $BDD->prepare("INSERT INTO plantes (Id_utilisateur, Nom_latin, Nom_fr, Taille, Couleur, Fleur, Fruit, Couleur_fleur, Couleur_fruit, Régions, Details, Famille, Période_floraison, Période_fructification )  VALUES (:utilisateur, :nomlat, :nomfr, :taille, :couleur, :fleur, :fruit, :couleur_fleur, :couleur_fruit, :region, :details, :famille, :periode_floraison, :periode_fructification) ");
            $exec = $req->execute(array(':utilisateur'=>$_SESSION['id'], ':nomlat'=> $nomlat, ':nomfr'=> $nomfr, ':taille'=> $taille, ':couleur'=> $couleur, ':fleur'=> $fleur, ':fruit'=> $fruit, ':couleur_fleur'=> $couleurfleur, ':couleur_fruit'=> $couleurfruit, ':region'=>$region, ':details'=> $description, ':famille'=> $famille, ':periode_floraison'=> $periodefleur, ':periode_fructification'=> $periodefruit));
          }
          catch(Exception $e){
              echo "erreur".$e->getMessage();
          }

          header('Location: repertoire_botannique.php?ajout=true');
          exit();
        }
      }
    ?>



    <h1 style="text-align:center"> Ajouter une plante </h1>

    <?php
      if(!empty($errors)){
    ?>

    <div class ="erreur">
      <p> Le formulaire est incorrect : </p>
      <?php
        foreach($errors as $error){
          echo '<li>'.$error.'</li>';
        }
      ?>
      </br>
    </div>

    <?php } ?>
  <form method="post" action="">
    <div class="renseignement">
      <div id="titre">Nom français : </div>
      <input type="text" id="renseignement" name="nomfr" required/>
    </div>
    <div class="renseignement">
      <div id="titre">Nom latin : </div>
      <input type="text" id="renseignement" name="nomlat" required/>
    </div>


    <div class="renseignement">
      <div id="titre">Famille botanique : </div>
      <select id="type" name="famille">
        <option value="arbre" >Arbre </option>
        <option value="arbuste">Arbuste </option>
        <option value="plante">Plante </option>
      </select>
    </div>


    <div class="renseignement">
      <div id="titre">Régions principales : </div>
      <input type="text" id="renseignement" name="region" required/>
    </div>

    <div class="renseignement">
      <div id="titre">Couleur : </div>
      <select id="couleur" name="couleur">
        <option value="rouge">Rouge </option>
        <option value="orange">Orange </option>
        <option value="jaune">Jaune </option>
        <option value="blanc">Blanc </option>
        <option value="rose">Rose </option>
        <option value="violet">Violet </option>
        <option value="bleu">Bleu </option>
        <option value="vert" selected>Vert </option>
        <option value="marron">Marron </option>
        <option value="gris">Gris </option>
        <option value="noir">Noir </option>
      </select>
    </div>

    <div class="renseignement">
      <div id="titre">Taille (en cm) : </div>
      <input type="text" id="renseignement" name="taille" required/> 
    </div>

    <div class="renseignement">
      <div id="titre">Possède des fleurs : </div>
      <input type="radio" name="fleur" value="oui"/><label for="oui">oui</label>
      <input type="radio" id="radiodroite" name="fleur" value="non" checked/><label for="non">non</label>
    </div>
    <div class="renseignement" class="oui msg"> 
      <div id="titre">Couleur fleur : </div>
      <select id="couleurfleur" name="couleurfleur">
        <option value="rouge" >Rouge </option>
        <option value="orange">Orange </option>
        <option value="jaune">Jaune </option>
        <option value="blanc">Blanc </option>
        <option value="rose">Rose </option>
        <option value="violet">Violet </option>
        <option value="bleu">Bleu </option>
        <option value="vert">Vert </option>
        <option value="marron">Marron </option>
        <option value="gris">Gris </option>
        <option value="noir">Noir </option>
      </select>
    </div>
    <div class="renseignement" id="resultbouton2">
      <div id="titre">Période de floraison : </div>
      <select id="periodefleur" name="periodefleur">
        <option value="printemps" >Printemps </option>
        <option value="ete">Eté </option>
        <option value="automne">Automne </option>
        <option value="hiver">Hiver </option>
      </select>
    </div>


    <div class="renseignement" id="togg2">
      <div id="titre">Possède des fruits : </div>
      <input type="radio" name="fruit" value="oui"/><label for="oui">oui</label>
      <input type="radio" id="radiodroite" name="fruit" value="non" checked/><label for="non">non</label>
    </div>
    <div class="renseignement" id="resultbouton3">
      <div id="titre">Couleur fruit : </div>
      <select id="couleurfruit" name="couleurfruit">
        <option value="rouge" >Rouge </option>
        <option value="orange">Orange </option>
        <option value="jaune">Jaune </option>
        <option value="blanc">Blanc </option>
        <option value="rose">Rose </option>
        <option value="violet">Violet </option>
        <option value="bleu">Bleu </option>
        <option value="vert">Vert </option>
        <option value="marron">Marron </option>
        <option value="gris">Gris </option>
        <option value="noir">Noir </option>
      </select>
    </div>
    <!--<div class="renseignement">
      <div id="titre">Type de fruit : </div>
      <select id="typefruit">
        <option value="simple" selected>Simple </option>
        <option value="multiple">Multiple </option>
        <option value="complexe">Complexe </option>
        <option value="compose">Composé </option>
      </select>
      <select id="fruitsimple">
        <option value="sec" selected>Sec </option>
        <option value="charnu">Charnu </option>
      </select>
      <select id="fruitsec">
        <option value="indehiscent" selected>Indéhiscent </option>
        <option value="dehiscent">Déhiscent </option>
      </select>
    </div>-->
    <div class="renseignement" id="resultbouton4">
      <div id="titre">Période de fructification : </div>
      <select id="periodefruit" name="periodefruit">
        <option value="printemps" >Printemps </option>
        <option value="ete">Eté </option>
        <option value="automne">Automne </option>
        <option value="hiver">Hiver </option>
      </select>
    </div>

    <!--<div class="renseignement">
      <div id="titre">Mode de reproduction : </div>
      <input type="text" id="renseignement"/>
    </div>-->

    <div class="renseignement">
      <div id="titre">Description : </div>
      <input type="text" id="renseignement" name="description"/>
    </div>

    <div class="renseignement">
        <button id="bouttoncentre" onclick="">Ajouter photos</button>
    </div>


    <a href="accueil.php" id="bouttongauche"><input type="button" value="Annuler"></a>
    <button id="bouttondroite" type="submit" name="valider">Valider</button>
  </form>

    <footer>
        <div id="baspage"> Contact</div>
    </footer> 
    <script type="text/javascript" src="js/java.js"></script>


  </body>
</html>

<!--taille(en cm ?), couleur plante -->
