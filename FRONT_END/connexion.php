<!DOCTYPE html>
<html lang="fr">
<?php
    session_start();
?>
  <head>
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8" />
      <title> Connexion </title>  
      <link rel="stylesheet" type="text/css" href="css/my-login.css">   
      <link href ="css/bootstrap.css" rel="stylesheet" type="text/css"/>
  </head>    

    <body class="my-login-page">  
	<section class="h-100">  

		<div class="container h-100">  

			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="img/logo.png" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Déjà client ?</h4>   


<!--Code PHP -->  
<?php
     if($_GET["inscription"]=="true"){
        echo "<div class=inscription> Inscription réussie, veuillez vous connecter </div></br>";
      }
    ?>
    
    <?php 
      
      ini_set( 'display_errors', 'on' );
      error_reporting( E_ALL );
      $errors = array();
      if(isset($_POST['email']) and isset($_POST['mdp'])){
        try{
          $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
          $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $BDD->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
          die('Erreur :' . $e->getMessage());
        }

        $requete=$BDD->prepare('SELECT * FROM utilisateurs WHERE Email ="'.$_POST['email'].'"');
        $requete->execute();
        $utilisateur=$requete->fetch();

        if($utilisateur == null)
          $errors['email']="Email incorrecte";
        else{
          if(password_verify($_POST['mdp'], $utilisateur['Mdp'])){
              
              $_SESSION['id']=$utilisateur['Id_utilisateur'];
              $_SESSION['pseudo']=$utilisateur['Pseudo'];
              $_SESSION['rang']=$utilisateur['Rang'];
	      $_SESSION['score']=$utilisateur['Nb_bon_signalement'];

              header('Location: accueil.php');
              exit();
          }
          else{
            $errors['mdp']="Mot de passe incorrect";
          }
        }

      }

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


<form method="post" >     
<!-- Entrer Email-->				
<div class="form-group">
	<label for="email">Adresse mail</label>
	<input id="renseignement" type="email" class="form-control" name="email" value="" required autofocus>
	<div class="invalid-feedback">
	Votre e-mail n'est pas valide
	</div>
</div>
<!-- Entrer  Mot de Passe -->                  
<div class="form-group">
	<label for="password">Mot de passe
		<a href="forgot.php" class="float-right">
										    Mot de passe oublié ?
										</a>
									</label>
	<input id="password" type="password" class="form-control" name="mdp" required data-eye>
    <div class="invalid-feedback">
	Le mot de passe est requis
	</div>
</div>
         		
<!--Se Connecter -->
<div class="form-group m-0">
	<button type="submit" class="btn btn-primary btn-block" id="bouttondroite">
										Se connecter
	</button>
</div>   
<!-- si Nouveau utilisateur on va creer un compte pour lui -->    
	<div class="mt-4 text-center">
								Nouveau utilisateur ? <a href="inscription.php">Créer mon compte</a>
	</div>   


</form>
						</div>
					</div>  


					<div class="footer">
						Copyright &copy; 2022 &mdash; Université de Limoges
					</div>
				</div>
			</div>
		</div>
	</section>



	
  <script src="js/my-login.js"></script>   
  <script src="js/jquery-3.6.0.min.js"></script>  
  <script src="js/popper.min.js"></script>  
  <script src="js/bootstrap.min.js"></script>

</body>

</html>
