<!DOCTYPE html>
<html lang="fr">

  <head>
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta charset="utf-8" />
  <title> Inscription</title>
  <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />  
	<link rel="stylesheet" type="text/css" href="css/my-login.css"> 
  <link href ="css/bootstrap.css" rel="stylesheet" type="text/css"/>
  </head>
  <body class="my-login-page">  
  




<!-- Code PHP -->

  <?php

/*function debug($variable){
  echo '<pre>'.print_r($variable, true). '</pre>';
}*/

//vérification de si le formulaire est bien rempli
if(isset($_POST['valider'])){
  if(!empty($_POST)){

	$errors = array();

	if(empty($_POST['pseudo']) || !preg_match('/^[A-Za-z0-9_]+$/', $_POST['pseudo'])){
	  $errors['pseudo']="Pseudo non valide";
	}

	if(empty($_POST['email']) ){
	  $errors['email']="Email non valide";
	}
	
	if(empty($_POST['mdp']) ){
	  $errors['mdp']="Mot de passe non valide";
	}

	if($_POST['mdp'] != $_POST['mdpconf']){
	  $errors['mdpconf']="Mots de passe différents";
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
	$requetemail = $BDD->prepare('SELECT * FROM utilisateurs WHERE Email ="'.$_POST['email'].'"');
	$requetemail->execute(array($email));
	$nb = $requetemail->rowCount();
	

	if($nb != 0)
	{
	  $errors['email_existe']="L'email est déjà utilisée";
	}

	//debug($errors);
  }  

  if(empty($errors)){
	
	//récupération de toutes les valeurs
	$email = $_POST['email'];
	$pseudo = $_POST['pseudo'];
	$mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
	$mdpconf = $_POST['mdpconf'];
	$entreprise = $_POST['entreprise'];
	
	if($entreprise=='oui')
	{
	  $entreprise=1;
	  $url=$_POST['url'];
	}
	else
	{
	  $entreprise=0;
	  $url=NULL;
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
	  $req = $BDD->prepare("INSERT INTO utilisateurs (Pseudo, Email, Mdp, Entreprise, URL_entreprise)  VALUES (:pseudo, :email, :mdp, :ent, :url_ent) ");
	  $exec = $req->execute(array(':pseudo'=>$pseudo,':email'=>$email,':mdp'=>$mdp,':ent'=>$entreprise, ':url_ent'=>$url));
	}
	catch(Exception $e){
		echo "erreur".$e->getMessage();
	}

	
	header('Location: connexion.php');
	exit();
  }
}
	

?>












<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
<div class="card-wrapper">
<!--#################################################################################################################-->          
<div class="brand">
						<img src="img/logo.png" alt="bootstrap 4 login page">
</div>
<div class="card fat">
<div class="card-body">
<h4 class="card-title">Inscription</h4>
<form method="post" action="" >  
<!--Pseudo -->
<div class="form-group">
	<label for="name">Pseudo</label>
	<input id="name" type="text" class="form-control" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>"  required autofocus>
		<div class="invalid-feedback">
		c'est quoi ton pseudo?
</div>
</div>
<!--Email -->
<div class="form-group">
	<label for="email">Adresse mail</label>
	<input id="email" type="email" class="form-control" name="email"  value="<?php if(isset($email)) { echo $email; } ?>"   required>
	<div class="invalid-feedback">
	       Votre e-mail n'est pas valide
	</div>
</div>
<!--Mot de Passe -->
<div class="form-group">
	<label for="password">Mot de passe </label>
	<input id="password" type="password" class="form-control" name="mdp" value="<?php if(isset($mdp)) { echo $mdpconf; } ?>" required data-eye>
		<div class="invalid-feedback">
		   Le mot de passe est requis
        </div>
</div>
<!-- Confirmation du mot de passe -->
<div class="form-group">
	    <label for="password">Confirmation du mot de passe</label>
		<input id="password" type="password" class="form-control" name="mdpconf" value="<?php if(isset($mdpconf)) { echo $mdpconf; } ?>" required data-eye>
			<div class="invalid-feedback">
			      Le mot de passe est requis
			</div>
</div>

<!--Entreprise-->
<div class="form-group">
       <span class="label label-default" >Entreprise ? </span>  
       <div class="form-check">
           <div class="form-check form-check-inline"> 
              <input class="form-check-input" type="radio" name="entreprise" id="radiox" value="oui" checked>
              <label class="form-check-label" for="inlineCheckbox1"> oui </label>
           </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="entreprise" id="radiox" value="non">
            <label class="form-check-label" for="inlineCheckbox2"> non</label>
            </div>  
		</div>
		                           
</div> 
                           
<!--Url de L'entreprise -->    
<div class="form-group" id="resultbouton1" >
        <label for="titre">URL de l'entreprise</label>
        <input id="email" type="text" class="form-control" name="url" value="<?php if(isset($url)) { echo $url; }?> " required>
        <div class="invalid-feedback">
	            Votre URL n'est pas valide							
        </div>    
</div>

<hr>
<div class="form-group m-0">
	  <button type="submit" class="btn btn-primary btn-block" name="valider">
	        Valider
	  </button>
	
	
	  <div class="mt-4 text-center">  

	      Déjà client ? <a href="connexion.php">Se connecter</a>
	  </div>  			
</div> 

</form>
   
<div class="footer">
	Copyright &copy; 2022 &mdash; Université de Limoges
</div>

             
</div>
</div>
</div>   
</div>
</div>
</section>






   
<script type="text/javascript" src="js/java.js"></script>
<script src="js/my-login.js"></script>   
<script src="js/jquery-3.6.0.min.js"></script>  
<script src="js/popper.min.js"></script>  
<script src="js/bootstrap.min.js"></script>
</body>
















 </body>
</html>
