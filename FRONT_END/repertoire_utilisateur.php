<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6b6c1dbe0e.js" crossorigin="anonymous"></script>    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"   

        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">  

    <link rel="stylesheet" href="pageaccueil.css">
    <title>Répertoire des utilisateurs</title>
</head>

<body>
     
    <header >
    <div class="jumbotron   bg-image  text-Light    " >  
                    <h1 style="color:white;text-align:center" >
                        Plate-forme collaborative de lutte contre les plantes invasives
                    </h1>    
                    
                </div>
    </header>
 
    <main>  
    <hr>    

<h2 class="card-title" style="text-align:center" >      Répertoire des utilisateurs      </h2>
<?php
    include("menu.php");
?> 

 <div class="container">
 <div class="row ">  
 <div class="col-sm">    
            
        <form action="" method="POST">   
     <div class="card mb-3">
     <div class="card-body">   

     <div class="input-group">
    <input type="search" class="form-control rounded" id="searchbar" name="plante" placeholder="Rechercher une plante..." aria-label="Search" aria-describedby="search-addon" />
     <button type="submit" class="btn btn-outline-primary" name="searchbar">Rechercher</button>
    </div>
          
    </div> 
    </div> 

      <div class="card mb-3">                    
      <div class="card-body">    
         <div class="row">
<!-- Type d'utilisateur -->             
<div class="col">  
                    
         <label for="Type d'utilisateur" class="control-label"> Type d'utilisateur:</label>    

        <select class="form-control"  onchange="this.form.submit()" name="type">
               <option value="vide" <?php if($_POST['type']=="vide"){echo "selected";}?>> Tous </option> 
               <option value="Particulier" <?php if($_POST['type']=="Particulier"){echo "selected";}?>> Particulier </option>
               <option value="Entreprise" <?php if($_POST['type']=="Entreprise"){echo "selected";}?>> Entreprise </option>

        </select>              
                             
</div>
                   
<!-- Rang -->                   
 <div class="col">
                   
                       
        <label for="Rang" class="control-label">Rang :</label>  
        <select class="form-control"  onchange="this.form.submit()" name="rang">
                <option value="vide" <?php if($_POST['rang']=="vide"){echo "selected";}?>> Tous </option> 
                <option value="Debutant" <?php if($_POST['rang']=="Debutant"){echo "selected";}?>> Débutant </option> 
                <option value="Moyen" <?php if($_POST['rang']=="Moyen"){echo "selected";}?>> Moyen</option> 
               <option value="Expert" <?php if($_POST['rang']=="Expert"){echo "selected";}?>> Expert </option>
        </select>        
 </div>  
                  
                    
                    
<hr>
                                       
</div>
</div>      






<div class="card mb-3">
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
                                        <img src="img\profil.jpg" id="image_plante"> 
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

<div class="footer">
    Copyright &copy; 2022 &mdash; Université de Limoges
  </div>
               
  
</main>  
</div>
</div>
 </div>

</body>

</html>
