<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta charset="utf-8" />
  <title>
      Ajout d'une plante
  </title>
  <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />  
  <link rel="stylesheet" type="text/css" href="css/my-login.css"> 
  <link href ="css/bootstrap.css" rel="stylesheet" type="text/css"/>    

  <script src="https://kit.fontawesome.com/6b6c1dbe0e.js" crossorigin="anonymous"></script>    
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"   
  integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">  
  <link rel="stylesheet" href="pageaccueil.css">
</head>
<body class="my-login-page">
  <header >
    <div class="jumbotron   bg-image  text-Light    " >  
        <h1 style="color:white;text-align:center" >
            Plate-forme collaborative de lutte contre les plantes invasives
        </h1>    
        
    </div>
    <?php
      include("menu.php");
    ?>
  </header>

<!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<main>

<h2 class="card-title" style="text-align:center" >     Ajouter une plante     </h2>  
<hr>

<?php
  ini_set( 'display_errors', 'on' );
  error_reporting( E_ALL );
    if(isset($_POST['valider'])){
      if(!empty($_POST)){

        $errors = array();

        if(empty($_POST['nomfr']) || !preg_match('/^[A-Za-z\'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]+$/', $_POST['nomfr'])){
          $errors['nomfr']="Nom français non valide";
        }

        if(empty($_POST['nomlat']) || !preg_match('/^[A-Za-z\'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]+$/', $_POST['nomlat'])){
          $errors['nomlat']="Nom latin non valide";
        }

        if(empty($_POST['region']) || !preg_match('/^[A-Za-z\'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ  ]+$/', $_POST['region'])){
          $errors['region']="Région non valide";
        }

        if(empty($_POST['taille']) || !preg_match('/^[0-9, ]+$/', $_POST['taille'])){
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
        
        if($_FILES['image']['error']==4){
          $errors['image']="Vous n'avez pas choisi d'images";
        }
        else{
          $img = $_FILES['image'];
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

        $req = $BDD->query("SHOW TABLE STATUS FROM bdd LIKE 'plantes' ");
        $donnees = $req->fetch();
        $id = $donnees['Auto_increment'];

        try{
          $req = $BDD->prepare("INSERT INTO plantes (Id_utilisateur, Nom_latin, Nom_fr, Taille, Couleur, Fleur, Fruit, Couleur_fleur, Couleur_fruit, Régions, Details, Famille, Période_floraison, Période_fructification )  VALUES (:utilisateur, :nomlat, :nomfr, :taille, :couleur, :fleur, :fruit, :couleur_fleur, :couleur_fruit, :region, :details, :famille, :periode_floraison, :periode_fructification) ");
          $exec = $req->execute(array(':utilisateur'=>$_SESSION['id'], ':nomlat'=> $nomlat, ':nomfr'=> $nomfr, ':taille'=> $taille, ':couleur'=> $couleur, ':fleur'=> $fleur, ':fruit'=> $fruit, ':couleur_fleur'=> $couleurfleur, ':couleur_fruit'=> $couleurfruit, ':region'=>$region, ':details'=> $description, ':famille'=> $famille, ':periode_floraison'=> $periodefleur, ':periode_fructification'=> $periodefruit));
        }
        catch(Exception $e){
            echo "erreur".$e->getMessage();
        }
        try{
          $req = $BDD->prepare("INSERT INTO photoplantes (Id_plante, Photo)  VALUES (:id, :fichier) ");
          $exec = $req->execute(array(':id'=>$id, ':fichier'=>file_get_contents($img['tmp_name'])));
        }
        catch(Exception $e){
            echo "erreur".$e->getMessage();
        }

        header('Location: repertoire_botanique.php?ajout=true');
        exit();
      }
    }
?>  

<div class="container">
<div class="row ">  
<div class="col">                 
<div class="brand">
	<img src="img/logo.jpg" alt="bootstrap 4 login page">
</div>
             
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

<form method="post" action="" enctype="multipart/form-data">

<!-- Nom Français -->  
<div class="form-group">
  <label for="email">Nom français : </label>
  <input id="nom_fr" type="text" class="form-control" name="nomfr" required>
  <div class="invalid-feedback">
    Le nom français n'est pas valide
  </div>
</div>

<!-- Nom Latin -->    
<div class="form-group">
  <label for="email">Nom Latin : </label>
  <input id="nom_lt" type="text" class="form-control" name="nomlat" required>
  <div class="invalid-feedback">
    Le nom latin n'est pas valide
  </div>  
</div>
    

<!--Famille botanique--> 
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Famille botanique </label>
  </div>
  <select class="custom-select" id="inputGroupSelect01" name="famille" >
    <option selected value="arbre">Arbre</option>
    <option value="arbuste">Arbuste</option>
    <option value="plante">Plante</option>
  </select>
</div>

<!-- Régions principales -->  
<div class="form-group">
  <label for="email">Régions principales : </label>
  <input id="reg_p" type="text" class="form-control" name="region" required>
  <div class="invalid-feedback">
    Votre région  n'est pas valide
  </div>
</div>

<!-- Couleur -->
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Couleur </label>
  </div>
  <select class="custom-select" id="inputGroupSelect01" name="couleur">
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

<!-- Taille en cm-->
<div class="form-group">
  <label for="email">Taille (en cm) : </label>
  <input id="taille" type="text" class="form-control" name="taille" required>
  <div class="invalid-feedback">
  </div>
</div>

<!-- Possède des fleurs  -->    
<div class="form-group">
  <span class="label label-default">Possède des fleurs ?  </span>
  <div class="form-check">      
    <div class="form-check form-check-inline resultbouton1"> 
      <input class="form-check-input" type="radio" name="fleur" id="exampleRadios1" value="oui" checked>
      <label class="form-check-label" for="exampleRadios1"> oui </label>
    </div>
  <div class="form-check form-check-inline resultbouton2">
    <input class="form-check-input" type="radio" name="fleur" id="exampleRadios2" value="non">
    <label class="form-check-label" for="exampleRadios2"> non</label> 
  </div>
</div>
<br/>

<!-- Couleur Fleur -->
<div class="input-group mb-3 fleur">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Couleur </label>
  </div>
  <select class="custom-select" id="inputGroupSelect01" name="couleurfleur">
    <option value="rouge" selected>Rouge </option>
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
 
<!--Période de floraison -->    
<div class="input-group mb-3 fleur">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Période de floraison </label>
  </div>
  <select class="custom-select" id="inputGroupSelect01" name="periodefleur">
    <option value="printemps" selected>Printemps </option>
    <option value="ete">Eté </option>
    <option value="automne">Automne </option>
    <option value="hiver">Hiver </option>
  </select>
</div>

<!-- Posséde de fruit -->
<div class="form-group"> 
  <span class="label label-default">Possède des fruits ? </span>  
    <div class="form-check">
      <div class="form-check form-check-inline resultbouton3"> 
        <input class="form-check-input" type="radio" name="fruit" id="exampleRadios1" value="oui" checked>
        <label class="form-check-label" for="exampleRadios1"> oui </label>
      </div>
      <div class="form-check form-check-inline resultbouton4">
        <input class="form-check-input" type="radio" name="fruit" id="exampleRadios2" value="non">
        <label class="form-check-label" for="exampleRadios2"> non</label>
      </div>
</div>
<br/>

<!-- Couleur fruit -->
<div class="input-group mb-3 fruit">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Couleur fruit </label>
  </div>
  <select class="custom-select" id="inputGroupSelect01" name="couleurfruit">
    <option value="rouge" selected>Rouge </option>
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
   
<!-- Période de fructification -->
<div class="input-group mb-3 fruit">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Période de fructification </label>
  </div>
  <select class="custom-select" id="inputGroupSelect01" name="periodefruit">
    <option value="printemps" selected>Printemps </option>
    <option value="ete">Eté </option>
    <option value="automne">Automne </option>
    <option value="hiver">Hiver </option>
  </select>
</div>

<!-- Decription -->   
<div class="form-group">
  <label for="email">Description : </label>
  <input id="description" type="text" class="form-control" name="description" required>
  <div class="invalid-feedback">                  
  </div>
</div>

<!-- Ajout une photo -->    
<div class="form-group">
  <label for="formFileMultiple" class="form-label">Ajouter photo : </label>
  <input type="file" id="renseignement" name="image" />
</div>


<div class="form-group m-0">
  <button type="submit" class="btn btn-primary btn-block" name="valider">
    Valider
  </button>
  <a href="repertoire_botanique.php" class="btn btn-primary btn-block">
    Annuler
  </a>
</div> 

</form>
<div class="footer">
  Copyright &copy; 2022 &mdash; Université de Limoges
</div>
</div>

<!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
    </div>
    </div>
    </div>
    </div>
    </div>

</main>

  <script type="text/javascript" src="js/java.js"></script>
  <script src="js/jquery-3.6.0.min.js"></script>  
  <script src="js/popper.min.js"></script>  
  <script src="js/bootstrap.min.js"></script>

</body>
</html>