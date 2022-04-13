<!DOCTYPE html>
<html> 
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    
	<link href="css/user_profil.css" rel="stylesheet">
</head>  
<body>       
    
    


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

     
<div class="container">
<div class="row">    
	<div class="col-12">
			<!-- Page title -->
		<div class="my-5">
				<h3>Mon profil</h3>
				<hr>
		</div>
			<!-- Form START -->
		<form class="file-upload">
			<div class="row mb-5 gx-5">
					<!-- Contact detail -->
					<div class="col-xxl-8 mb-5 mb-xxl-0">
						<div class="bg-secondary-soft px-4 py-5 rounded">
							<div class="row g-3">
								<h4 class="mb-4 mt-0">Coordonnées</h4>
								<!-- First Name -->
								<div class="col-md-6">
									<label class="form-label">Pseudo *</label>
									<input type="text" class="form-control" placeholder="" aria-label="First name" value=<?php echo($utilisateur['Pseudo']);?> >
                                    
								</div>
								<!-- Last name -->
								<div class="col-md-6">
									<label class="form-label">Rang*</label>
									<input type="text" class="form-control" placeholder="" aria-label="Last name" value="1">
								</div>
								<!-- Mobile number -->
								<div class="col-md-6">
									<label class="form-label">Nombre de bons signalements *</label>
									<input type="text" class="form-control" placeholder="" aria-label="Phone number" value="1">
								</div>
								<!-- Email -->
								<div class="col-md-6">
									<label for="inputEmail4" class="form-label">Email *</label>
									<input type="email" class="form-control" id="inputEmail4" value="example@homerealty.com">
								</div>  
								
							</div> <!-- Row END --> 
                            
                            
                           
						</div>  

                        <div class="col-xxl-8 mb-5 mb-xxl-0">
                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                <div class="row g-3">
                                    <h4 class="mb-4 mt-0">Changer mot de passe</h4>
                                    <!-- Old password -->
                                    <div class="col-md-6">
                                        <label for="exampleInputPassword1" class="form-label">Ancien mot de passe *</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <!-- New password -->
                                    <div class="col-md-6">
                                        <label for="exampleInputPassword2" class="form-label">Nouveau mot de passe *</label>
                                        <input type="password" class="form-control" id="exampleInputPassword2">
                                    </div>
                                    <!-- Confirm password -->
                                    <div class="col-md-12">
                                        <label for="exampleInputPassword3" class="form-label">Confirmer le mot de passe *</label>
                                        <input type="password" class="form-control" id="exampleInputPassword3">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
					</div>
					<!-- Upload profile -->  
                    <div class="col-xxl-4">
						<div class="bg-secondary-soft px-4 py-5 rounded">
							<div class="row g-3">
								<h4 class="mb-4 mt-0">Mettre à jour la photo de profil
                                </h4>
								<div class="text-center">
									<!-- Modifier image -->
									<div class="square position-relative display-2 mb-3">
										<i class="fas fa-fw fa-user position-absolute top-50 start-50 translate-middle text-secondary"></i>
									</div>
									<!--  Modifier & Supprimer -->
									<input type="file" id="customFile" name="file" hidden="">
									<label class="btn btn-success-soft btn-block" for="customFile">Modifier</label>
									<button type="button" class="btn btn-danger-soft">Supprimer</button>
									<!-- Image -->
									<p class="text-muted mt-3 mb-0"><span class="me-1">Note:</span>Taille minimale 300px x 300px</p>
								</div>
							</div>
						</div>
					</div>   
			    </div> <!-- Row END -->


				</div> <!-- Row END -->
				<!-- button -->
				<div class="gap-3 d-md-flex justify-content-md-end text-center">
					<button type="button" class="btn btn-danger btn-lg">supprimer le profil</button>
					<button type="button" class="btn btn-primary btn-lg">Mettre à jour le profil</button>
				</div>
			</form> <!-- Form END -->
		</div>
        <div class="footer">
            Copyright &copy; 2022 &mdash; Université de Limoges
        </div>
	</div>
	
	</div>
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  
  </body>  
  </html>
