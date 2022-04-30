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
  </header>
<!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->

<main>

 

<h2 class="card-title" style="text-align:center" >   Ajouter une plante     </h2>  
<hr>
<?php
include("menu.php");
?>


<div class="container">
<div class="row ">  


       
 <div class="col">  
                
 

<!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->                      
<div class="brand">
	<img src="img/logo.png" alt="bootstrap 4 login page">
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

<form method="post">
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
         <label for="email">Nom Latin: </label>
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
      <option selected>Choose...</option>
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
<!-- Taille en CM-->
<div class="form-group">
      <label for="email">Taille (en cm): </label>
      <input id="taille" type="text" class="form-control" name="taille" required>
      <div class="invalid-feedback">
                          
      </div>
  </div>

<!-- Possède des fleurs  -->    
   <div class="form-group">
      <span class="label label-default">Possède des fleurs ?  </span>
     
      <div class="form-check">
                
        <div class="form-check form-check-inline"> 
        <input class="form-check-input" type="radio" name="fleur" id="exampleRadios1" value="oui" checked>
        <label class="form-check-label" for="exampleRadios1"> oui </label>
        </div>

      <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="fleur" id="exampleRadios2" value="non">
      <label class="form-check-label" for="exampleRadios2"> non</label> 

       </div>
    </div>
<!-- Couleur Fleur -->
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Couleur </label>
  </div>
  <select class="custom-select" id="inputGroupSelect01" name="couleurfleur">
    <option selected>Choose...</option>
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
<div class="input-group mb-3">
     <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Période de floraison</label>
     </div>
     <select class="custom-select" id="inputGroupSelect01" name="periodefleur">
             <option selected>Choose...</option>
             <option value="printemps" selected>Printemps </option>
             <option value="ete">Eté </option>
             <option value="automne">Automne </option>
             <option value="hiver">Hiver </option>
    </select>
</div>

<!-- Posséde de fruit -->
<div class="form-group">
                
      <span class="label label-default">Possède des fruits  ? </span>  
      <div class="form-check">
      
      <div class="form-check form-check-inline"> 
      <input class="form-check-input" type="radio" name="fruit" id="exampleRadios1" value="oui" checked>
      <label class="form-check-label" for="exampleRadios1"> oui </label>
      </div>

    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="fruit" id="exampleRadios2" value="non">
    <label class="form-check-label" for="exampleRadios2"> non</label>
     </div>
        

        

</div>
         
<!-- Couleur fruit -->
    
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Couleur fruit </label>
  </div>
  <select class="custom-select" id="inputGroupSelect01" name="couleurfruit">
    <option selected>Choose...</option>
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
   
  <!--  Période de fructification-->

<div class="input-group mb-3">
      <div class="input-group-prepend">
        <label class="input-group-text" for="inputGroupSelect01">Période de fructification</label>
      </div>
      <select class="custom-select" id="inputGroupSelect01" name="periodefruit">
        <option selected>Choose...</option>
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
    <label for="formFileMultiple" class="form-label">Ajouter photos</label>
    <input class="form-control"  type="file" id="formFileMultiple" multiple />

</div>


<div class="form-group m-0">
    <button type="submit" class="btn btn-primary btn-block" name="valider">
          Valider
    </button>
    <button type="submit" class="btn btn-primary btn-block">
      Annuler
    </button>
    
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

   






 

  
   
        
        
          
           
            
          

       


  


  <script src="js/jquery-3.6.0.min.js"></script>  
  <script src="js/popper.min.js"></script>  
  <script src="js/bootstrap.min.js"></script>
















</body>
</html>
