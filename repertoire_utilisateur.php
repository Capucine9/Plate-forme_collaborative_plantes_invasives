
<!DOCTYPE html>
<html>
    <head>
        <title>Répertoire utilisateurs</title>
        <meta charset="utf-8">
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    </head>
    <body>
        <div id="header">Plate-forme collaborative de lutte contre les plantes invasives</div>


       
    <?php
    include("menu.php");
    ?>

        
        <form action="" method="POST">
            <h1 style="text-align:center"> Répertoire des utilisateurs </h1>
            
            <br/>
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
            
            <div class= "carre">
                
                    
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

            </div>

        </form>

        <footer>
        <div id="baspage"> Contact</div>
        </footer> 
    </body>
</html>
