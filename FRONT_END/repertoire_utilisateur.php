<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6b6c1dbe0e.js" crossorigin="anonymous"></script>    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"   

        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">  

    <link rel="stylesheet" href="pageaccueil.css">
    <title>Accueil</title>
</head>

<body>
        
<style>





</style>
    <nav class="navbar navbar-dark bg-dark fixed-top navbar-expand-sm">
        <div class="container">
            <a href="#" class="navbar-brand">
           
                 
            </a>
            <button type="button" data-toggle="collapse" data-target="#navbarCollapse" class="navbar-toggler">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="navbarCollapse" class="collapse navbar-collapse">

<!--  Début Menu Bar -->
<!-- c'set le meme code que vous avez ecrit dans menu.php .juste j'ai coper ici et dans echo j'ai garde le méme code php mais echo va afficher un autre desgin -->
                <ul class="navbar-nav ml-auto">      
                     



                  
            <!--par défaut il existe  Accueil-->        
                    <li class="navbar-item">
                        <a href="accueil.php" class="nav-link active">Accueil</a>     
                    </li>   
            

             <!-- si l'utilisateur est connecté on va voir un champ Votre profil --> 
                     <?php
                           if(isset($_SESSION['id']) and empty($_GET['deco'])){
                                echo ("<a href=\"profil_utilisateur.php\">Votre profil</a>");
                                
                                echo (" <li class=\"navbar-item\">
                                <a href=\"profil_utilisateur.php\" class=\"nav-link active\">Votre profil </a>
                            </li>  ");

                            }
                        ?>   
                     <!-- par défaut il existe Le répertoire botanique-->
                       <li class="navbar-item">
                           <a href="repertoire_botannique.php" class="nav-link active">Le répertoire botanique</a>
                       </li>  
                     <!-- par défaut il existe  Les utlisateurs-->
                    <li class="navbar-item">
                        <a href="repertoire_utilisateur.php" class="nav-link active">Les utlisateurs </a>
                    </li>   
                     <!-- par défaut il existe  Les derniers signalement-->
                     <li class="navbar-item">
                        <a href="listeSignalement.php" class="nav-link active">Les derniers signalement </a>
                    </li>   

 <!-- si l'utilisateur est connecté on va afficher dans le nav bar un champs "signaler une plante" !> 

                        <?php
                           if(isset($_SESSION['id']) and empty($_GET['deco']))
                           {
    
                                echo (" <li class=\"navbar-item\">
                                <a href=\"ajout_signalement.php\" class=\"nav-link active\">Signaler une plante </a>
                            </li>  ");




                            }
                        ?>
 < !-- si l'utilisateur est connecté on va afficher dans le nav bar un champs "Ajouter une plante" !> 
       
                        <?php 
                            if($_SESSION['rang']==3 and empty($_GET['deco']))
                            {
                                echo (" <li class=\"navbar-item\">
                                <a href=\"ajout_plante.php\" class=\"nav-link active\">Ajouter une plante</a>
                            </li>  ");

                            }
                        ?>
 <! -- nous avons pas besoin de ce champs -->     
                        <?php
                            if(isset($_SESSION['id']) and empty($_GET['deco'])){
                                echo ("<a href=\"\">Vos amis</a>");
                            }
                        ?>
                        



   <!--Si l'utilisateur est connecté on va afficher Déconnexion si non on va afficher deux Champs Connexion et Inscription                         -->        
                        <?php
                            if(isset($_SESSION['id']) and empty($_GET['deco'])){

                                echo (" <li class=\"navbar-item\">
                                <a href=\"accueil.php?deco=1\" class=\"nav-link active\">Déconnexion</a>
                            </li>  ");




                            }
                            else{
                                  


                                echo (" <li class=\"navbar-item\">
                                <a href=\"connexion.php\" class=\"nav-link active\">Connexion</a>
                            </li>  

                            <li class=\"navbar-item\">
                            <a href=\"inscription.php\" class=\"nav-link active\">Inscription</a>
                        </li>  
                        
                            
                            
                            
                            ");


                            }
                        ?>
                        
                        
                    

                    <?php
                      if($_GET['deco']==1){
                      session_destroy();
                      echo ("<p align=\"center\"> Vous avez été déconnecté </p>");
                               }

                      ?>    



<!-- Fin Menu Bar -->
                    
                </ul>
            </div>
        </div>
    </nav>   


    <header >
   
        
        
          
           
            
                <div class="jumbotron   bg-image  text-Light    " >  
                
                
                    <h1 style="color:white;text-align:center" >
                        Plate-forme collaborative de lutte contre les plantes invasives
                    </h1>    
                    
                </div>
                   
                
            
        
    </header>
 
    <main>   
   
    <h2 class="card-title" style="text-align:center" >      Répertoire des utilisateurs      </h2>
        <div class="container">
            <div class="row ">
                <div class="col">  
                    <hr>
<div class="card mb-8">
                       
  <div class="card-body">
                            
                         
         <form action="" method="POST">                
         <input id="searchbar" type="text" placeholder="Rechercher un utilisateur..." name="utilisateur" >
         <button type="submit" name="searchbar">Rechercher</button>


            Type d'utilisateur :
            <select name="type" onchange="this.form.submit()"> 
                <option value="vide" <?php if($_POST['type']=="vide"){echo "selected";}?>> Tous </option> 
                <option value="Particulier" <?php if($_POST['type']=="Particulier"){echo "selected";}?>> Particulier </option>
                <option value="Entreprise" <?php if($_POST['type']=="Entreprise"){echo "selected";}?>> Entreprise </option>
            </select>

            Rang : 
            <select name="rang" onchange="this.form.submit()"> 
                <option value="vide" <?php if($_POST['rang']=="vide"){echo "selected";}?>> Tous </option> 
                <option value="Debutant" <?php if($_POST['rang']=="Debutant"){echo "selected";}?>> Débutant </option> 
                <option value="Moyen" <?php if($_POST['rang']=="Moyen"){echo "selected";}?>> Moyen</option> 
                <option value="Expert" <?php if($_POST['rang']=="Expert"){echo "selected";}?>> Expert </option>
            </select>
                            
                            
</div>
                  
  </div>



<hr>
<div class="card mb-4">
     <div class="card-body">
        
                <?php
                    
                    try{
                        $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
                    }
                    catch(Exception $e){
                        die('Erreur :' . $e->getMessage());
                    }

                    
                    $requete = $BDD->prepare('SELECT * FROM utilisateurs ORDER BY Pseudo, Rang');
                    $requete->execute();
                    $donnees = $requete->fetchAll();
                    


                    if(isset($_POST['utilisateur']) and $_POST['utilisateur']!="" )
                    {
                        foreach ($donnees as $utilisateur){
                            if(strstr (strtolower($utilisateur['Pseudo']), strtolower($_POST['utilisateur'])) ){
                                $result[]=$utilisateur;
                            }
                        }
                        $donnees=$result;


                    }

                    if(isset($_POST['type']) and $_POST['type']!="vide")
                    {
                        if($_POST['type']=="Particulier" ){

                            foreach ($donnees as $utilisateur){

                                if($utilisateur['Entreprise'] == 0 ){ 
                                        $resultatType[]=$utilisateur;
                                }
                            }
                            $donnees=$resultatType; 
                        } 

                        else{
                            foreach ($donnees as $utilisateur){

                                if($utilisateur['Entreprise']==1 ){ 
                                        $resultatType[]=$utilisateur;
                                }
                            }
                            $donnees=$resultatType; 
                        }
                    }

                    if(isset($_POST['rang']) and $_POST['rang']!="vide"){
                        if($_POST['rang']=="Debutant" ){
                            foreach ($donnees as $utilisateur){

                                if($utilisateur['Rang']==1 ){ 
                                        $resultatRang[]=$utilisateur;
                                }
                            }
                            
                        } 

                        elseif($_POST['rang']=="Moyen" ){
                            foreach ($donnees as $utilisateur){

                                if($utilisateur['Rang']==2 ){ 
                                        $resultatRang[]=$utilisateur;
                                }
                            }
                             
                        } 

                        elseif($_POST['rang']=="Expert" ){
                            foreach ($donnees as $utilisateur){

                                if($utilisateur['Rang']==3 ){ 
                                        $resultatRang[]=$utilisateur;
                                }
                            }
                            
                        } 
                        $donnees=$resultatRang; 
                    }


                    if (count($donnees)==0)   
                    {
                        echo "<p align=\"center\"> Aucun résultat disponible </p>";
                    } 
                    else{
                
                        foreach ($donnees as $utilisateur){
                            if ($utilisateur['Rang'] == 1 )
                                $rang="Débutant";
                                else if ( $utilisateur['Rang'] == 2 )
                                    $rang = "Moyen";
                                    else
                                        $rang = "Expert";

                            if ($utilisateur['Entreprise'] == 0)
                                $type = "Particulier";
                            else
                                $type = "entreprise";
                ?>
    
    
    <a href="profil_utilisateur_autre.php?id=<?php echo $utilisateur['Id_utilisateur']?> " id="lien_plante">
                    <div class = "carre_plante">
                            <div class="Plante">
                                <?php if($utilisateur['Photo']==NULL){?>
                                        <img src="images\profil.jpg" id="image_plante"> 
                                    <?php }
                                    else{ ?>
                                    <img src="data:image/jpg;base64,<?php echo base64_encode($utilisateur['Photo']);?> " id="image_plante" > 
                                    <?php } ?>
                                
                                <output name=pseudo id=planteinfos> Pseudo : <?php echo $utilisateur['Pseudo'];?></output></br>
                                <output name=email id=planteinfos>  Email : <?php echo $utilisateur['Email'];?></output></br>
                                <output name=rang id=planteinfos>  Rang : <?php echo $rang;?></output></br>    
                                <output name=rang id=planteinfos>  Catégorie : <?php echo $type;?></output></br> 
                                <?php
                                    if($type==1)   
                                        echo "<output name=rang id=planteinfos>  URL de l'entreprise :".$utilisateur['URL_entreprise']."</output>" ;
                                
                                ?>

                            </div>
                    </div>
                </a>

                <?php
                        }
                    }
                ?>
 </form>

</div>
</div>
  
</main>

</body>

</html>