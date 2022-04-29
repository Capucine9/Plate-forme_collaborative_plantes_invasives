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
                
                
                    <h1 class="font-dark-light text-center text-muted text-Light">
                        Plate-forme collaborative de lutte contre les plantes invasives
                    </h1>    
                    
                </div>
                   
                
            
        
    </header>

    <main>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-8">  
                    <hr>
                    <div class="card mb-8">
                       
                        <div class="card-body">
                            <h4 class="card-title">Pourquoi cette plate-forme ?</h4>
                            <p class="card-text">
                                L'objectif de cette plate-forme est de sensibiliser ses utilisateurs aux dangers des plantes envahissantes. 
                                Cette page web est une plate-forme collaborative 
                                qui permet à tous de signaler et d'aider à recenser les plantes envahissantes du pays en quelques clics.
                            </p>
                           

                        </div>
                  
                    </div>


                     <hr>
<!--   Qu'est ce qu'une plante envahissante ?              -->           
                    <div class="card mb-4">
                        <img src="photo_accueil/renouee.jpg" class="img-thumbnail card-img-top" alt="">
                        <div class="card-body">
                            <h4 class="card-title">Qu'est ce qu'une plante envahissante ?</h4>
                            <p class="card-text">
                                Une plante envahissante est une espèce végétale qui a une capacité de reproduction élevée et qui a également un impact négatif sur la biodiversité, la santé humaine ou encore sur les activités économiques. Elles peuvent être de deux types différents, indigène ou exotique. Les plantes indigènes sont originaires du milieu où elles sont implantées; tandis que les plantes exotiques ont été importées et se sont adaptées à leur 
                                nouveau milieu aux dépens des plantes indigènes. Elles sont également appelées plantes invasives.
                            </p>
                           

                        </div>
                  
                    </div>    
<!-- Solutions existant --> 
                    <div class="card mb-4">
                    
                         
                        <div class="card-body">
                            <h4 class="card-title">Solutions existantes  </h4>
                            <p class="card-text">
                                Une fois ces plantes recensées avec l'aide de la plate-forme, 
                                il existe différentes solutions pour les supprimer. Pour cela il existe trois méthodes qui sont les suivantes :
                            </p>      
                             

                        </div>    
                    
                       

                     <ul>
<!-- Méthode manuelle et outillée  --> 
                        <li>
                        <div class="card-body">
                            <h4 class="card-title">Méthode manuelle et outillée  </h4>
                            <p class="card-text">
                                La méthode manuelle est surtout utilisée sur de jeunes plantes qui sont plus simples à déraciner. 
                                Pour les plantes ayant des racines plus importantes, il est plus pratique d'utiliser des outils. 
                                Il existe différents outils qui sont utilisés pour arracher ou couper ces nuisibles. La pioche, la tronçonneuse ou encore la débroussailleuse sont fréquemment utilisées. Mais cela dépend des régions, par exemple, à la Réunion l'outil le plus répandu est le sabre. Ces instruments permettent de tailler les plantes avant la floraison, ainsi elles ne pourront pas disperser leur pollen et donc se reproduire. 
                                Mais ils permettent aussi de les déraciner ou encore de les tuer.
                            </p>      
                            <img src="photo_accueil/arrachage.jpg" class="img-thumbnail card-img-top" alt="">   

                        </div>   
                        </li>    
<!-- Méthode mécanisée   -->
                        <li>
                          
                            <div class="card-body">
                                <h4 class="card-title">Méthode mécanisée </h4>
                                <p class="card-text">
                                    Cette méthode consiste à déraciner les plantes les plus coriaces à l'aide de différents véhicules motorisés.
                                     Le tractopelle et la pelle mécanique 
                                    sont les plus couramment utilisés. C'est la technique la moins exploitée car elle tasse le sol et
                                     doit donc être pratiquée sur des milieux peu sensibles où il y a une densité assez importante de plantes 
                                     envahissantes.
                                </p>      
                                <img src="photo_accueil/tractopelle.jpg" class="img-thumbnail card-img-top" alt="">   
    
                            </div> 


                        </li>     

<!-- Méthode chimique   -->
                        <li>

                            <div class="card-body">
                                <h4 class="card-title">Méthode chimique </h4>
                                <p class="card-text">
                                    Cette méthode consiste à pulvériser des substances chimiques sur les plantes 
                                    envahissantes. Elle peut être effectuée suite à la coupe ou l'écorçage de certaines
                                     espèces ou encore par l'injection de la substance dans le tronc. L'ONF, l'Office 
                                     National des Forêts, publiait tous les ans une liste des produits chimiques 
                                     autorisés. Mais depuis 2018, l'ONF a mis fin à l'utilisation de ces substances 
                                     toxiques. Désormais les méthodes mécanisées et des techniques de bio-contrôle sont
                                      priorisées. Mais il existe encore des désherbants qui sont disponibles sur 
                                      le marché. Ils sont cependant mauvais pour les sols, pour les autres espèces 
                                      végétales et également pour les divers animaux qui se nourrissent de ces plantes.

                                </p>      
                                <img src="photo_accueil/desherbant.jpg" class="img-thumbnail card-img-top" alt="">   
    
                            </div> 





                        </li>




                    </ul>


                        
                    </div>    


                </div>


                <div class="col-4">
                    <hr>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Contact</h4>
                           
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <ul class="list-unstyled">
                                        <li><a href="https://www.sciences.unilim.fr/">Faculté des Sciences & Techniques</a></li>
                                       
                                    </ul>
                                </div>
                                <div class="col">
                                    <ul class="list-unstyled">
                                        <li><a href=""> Claire & Marouen & Capucine </a></li>
                                       
                                    </ul>
                                </div>
                            </div>
                        </div>




                        
                    </div>
                </div>




            </div>
        </div>


        
    </main>






  
</body>

</html>