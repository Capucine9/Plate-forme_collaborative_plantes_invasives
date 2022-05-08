<!DOCTYPE html>
<html> 
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    
	<link href="css/user_profil.css" rel="stylesheet">
	<link rel="stylesheet" href="pageaccueil.css">
	<title>Profil utilisateur</title>
</head>  
<body>       
	<header>
		<div class="jumbotron   bg-image  text-Light    " >  
			<h1 style="color:white;text-align:center" >
				Plate-forme collaborative de lutte contre les plantes invasives
			</h1>    
		</div>
    </header>
  
    <main> 
    <h2 class="card-title" style="text-align:center" >   Mon profil    </h2>  
	<?php
    		include("menu.php");
	?>

	<hr>   
	  
	  
    
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

			/*if(isset($_POST['supprimer'])){
			$requete=$BDD->prepare('DELETE FROM utilisateurs WHERE Id_utilisateur="'.$_SESSION['id'].'"');
			$requete->execute();
			session_destroy();
			header('Location: accueil.php');
			exit();
			}*/

			if(isset($_POST['maj'])){
			$errors = array();

			if(empty($_POST['pseudo']) || !preg_match('/^[A-Za-z0-9_]+$/', $_POST['pseudo'])){
				$errors['pseudo']="Pseudo non valide";
			}

			if(empty($_POST['email']) ){
				$errors['email']="Email non valide";
			}

			if($utilisateur['Entreprise']==1 && empty($_POST['URL']) ){
				$errors['URL']="URL non valide";
				}

			if(!empty($_POST['mdp']) && !password_verify($_POST['mdp'], $utilisateur['Mdp']) ){
				$errors['mdp']="Mot de passe non valide";
			}

			if(!empty($_POST['mdp']) &&  $_POST['mdpnew'] != $_POST['mdpconf']){
				$errors['mdpconf']="Mots de passe différents";
			}

			if(empty($errors)){
				if ($utilisateur['Entreprise']==1){
					$requete=$BDD->prepare('UPDATE utilisateurs SET Pseudo =?, Email=?, URL_entreprise=? WHERE Id_utilisateur="'.$_SESSION['id'].'"');
					$requete->execute([$_POST['pseudo'], $_POST['email'],  $_POST['URL'] ]);
				}
				else{
					$requete=$BDD->prepare('UPDATE utilisateurs SET Pseudo =?, Email=? WHERE Id_utilisateur="'.$_SESSION['id'].'"');
					$requete->execute([$_POST['pseudo'], $_POST['email'] ]);
				}

				if(!empty($_POST['mdp'])){
					$requete=$BDD->prepare('UPDATE utilisateurs SET Mdp=? WHERE Id_utilisateur="'.$_SESSION['id'].'"');
					$requete->execute([password_hash($_POST['mdpnew'], PASSWORD_BCRYPT) ]);
				}

				if($_FILES['image']['error']!=4){
					$img = $_FILES['image'];
					$requete=$BDD->prepare('UPDATE utilisateurs SET Photo=? WHERE Id_utilisateur="'.$_SESSION['id'].'"');
					$requete->execute([file_get_contents($img['tmp_name'])]);
					
				}
			}
			header('Location: profil_utilisateur.php');
			exit();
			}
	?>      

<div class="container">
<div class="row justify-content-between">     
<div class="row">
<div class="card mb-4">
<div class="card-body">
<form class="file-upload" method="post" action="" enctype="multipart/form-data">

	<!-- Upload profile -->  
	<div class="row g-3">
		<h4 class="mb-4 mt-0">Mettre à jour la photo de profil
		</h4>
		<div class="text-center">
			<!-- Modifier image -->
			<div class="square position-relative display-2 mb-3">
				<?php if($utilisateur['Photo']==NULL){?>
					<img src="img\profil.jpg" width = "300" height="300" > 
				<?php }
				else{ ?>
					<img src="data:image/jpg;base64,<?php echo base64_encode($utilisateur['Photo']);?> " width = 250 height=250 > 
				<?php }?>									
			</div>                    
			<div>
				<!--  Modifier & Supprimer -->
				<input type="file" id="renseignement" name="image"/>
				<!--<button type="button" class="btn btn-danger-soft">Supprimer</button>-->
				<!-- Image -->
				<p class="text-muted mt-3 mb-0"><span class="me-1">Note:</span>Taille minimale 300px x 300px</p>
			</div>   
		</div> 
     <div class="card mb-4">
        <div class="card-body">
			<!-- Contact detail -->
			<div class="bg-secondary-soft px-4 py-5 rounded">
				<div class="row g-3">
					<h4 class="mb-4 mt-0">Coordonnées</h4>
					<!-- Pseudo -->
					<div class="col-md-6">
						<label class="form-label">Pseudo </label>
						<input type="text" class="form-control" name="pseudo" placeholder="" aria-label="First name" value=<?php echo($utilisateur['Pseudo']);?> >
					</div>

					<!-- Rang -->
					<div class="col-md-6">
						<label class="form-label">Rang</label>
						<input type="text" class="form-control"  placeholder="" aria-label="Last name" value= <?php echo($rang);?> readonly >
					</div>

					<!-- Nombre bon signalements -->
					<div class="col-md-6">
						<label class="form-label">Nombre de bons signalements </label>
						<input type="text" class="form-control" placeholder="" aria-label="Phone number" value= <?php echo($utilisateur['Nb_bon_signalement']);?> readonly     >
					</div>

					<!-- Email -->
					<div class="col-md-6">
						<label for="inputEmail4" class="form-label">Email </label>
						<input type="email" class="form-control" name="email" id="inputEmail4" value= <?php echo($utilisateur['Email']);?> >
					</div> 
					
					<?php if ($utilisateur['Entreprise']==1)
					{?>
					<hr>
					<div class="col-md-6">
						<label class="form-label">URL de l'entreprise </label>
						<input type="text" class="form-control" name="URL" id="URL" value= <?php echo($utilisateur['URL_entreprise']);?> >
					</div>
					<?php }?>
				</div>  
			</div>
		</div>
	</div>  
		 
<div class="card mb-4">
<div class="card-body">
	<div class="col-xxl-8 mb-5 mb-xxl-0">
		<div class="bg-secondary-soft px-4 py-5 rounded">
			<div class="row g-3">
				<h4 class="mb-4 mt-0">Changer mot de passe</h4>
				<!-- Ancien mot de passe -->
				<div class="col-md-6">
					<label for="exampleInputPassword1" class="form-label">Ancien mot de passe </label>
					<input type="password" class="form-control" id="exampleInputPassword1" name="mdp">
				</div>

				<!-- Nouveau mot de passe -->
				<div class="col-md-6">
					<label for="exampleInputPassword2" class="form-label">Nouveau mot de passe </label>
					<input type="password" class="form-control" id="exampleInputPassword2" name="mdpnew">
				</div>

				<!-- Confirmation du nouveau mot de passe -->
				<div class="col-md-12">
					<label for="exampleInputPassword3" class="form-label">Confirmer le mot de passe </label>
					<input type="password" class="form-control" id="exampleInputPassword3" name="mdpconf">
				</div>
			</div>
		</div>
	</div>             
</div>
</div>
</div>

<!-- Bouton -->
<div class="gap-3 d-md-flex justify-content-md-end text-center">
	<!--<button type="submit" class="btn btn-danger btn-lg" name = "supprimer" >supprimer le profil</button>--> 
	<button type="submit" class="btn btn-primary btn-lg" name = "maj" >Mettre à jour le profil</button>
</div>
</div>
</div>
</div>
  
</form>

</div>
</div>
</div>  
</div>
</div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>  
</html>
