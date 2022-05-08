<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>My Login Page </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
</head>
<body class="my-login-page">
      	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center align-items-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="img/logo.jpg" alt="bootstrap 4 login page">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Mot de passe oublié ?</h4>
							<form method="POST" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div>
									<div class="form-text text-muted">
									Saisissez l'adresse mail associée à votre compte.Nous allons envoyer à cette adresse un lien vous permettant de réinitialiser facilement votre mot de passe.
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Valider
									</button>
								</div>  
								<div class="mt-4 text-center"><a href="connexion.php">Retour à la connexion </a>
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
