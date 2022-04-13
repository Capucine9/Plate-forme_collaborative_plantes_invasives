<!doctype html>
                        <html>
                            <head>
                                <meta charset='utf-8'>
                                <meta name='viewport' content='width=device-width, initial-scale=1'>
                                <title>Snippet - BBBootstrap</title>
                                <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css' rel='stylesheet'>
                                <link href='css/autre_utilisateur.css' rel='stylesheet'>
                                <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
                                <link href="css/autre_utilisateur.css" rel="stylesheet" type="text/css" media="all" /> 

                                </head>
                                <body >
                                <!-- Banner --> 




<!--Code Php -->  
<?php
            
            try{
                $BDD = new PDO('mysql:host=localhost;port=3308;dbname=bdd;charset=utf8', 'root', 'root');
            }
            catch(Exception $e){
                die('Erreur :' . $e->getMessage());
            }
            $requete = 'SELECT * FROM utilisateurs WHERE Id_utilisateur="'.$_GET["id"].'"';
            $requete = $BDD->prepare($requete);
            $requete->execute();
            /* on récupère le résultt de la requête sous forme d'un tableau */
            $utilisateur = $requete->fetch();

            if ($utilisateur['Rang'] == 1 )
                            $rang="débutant";
                            else if ( $utilisateur['Rang'] == 2 )
                                $rang = "moyen";
                                else
                                    $rang = "expert";

            if ($utilisateur['Entreprise'] == 0)
                    $type = "particulier";
            else
                    $type = "entreprise";
            
        ?>   



        <section class="h-100">
            <div class="container h-100">
                <div class="row d-flex justify-content-center">
            <!-- Component -->
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-center"> 
                        <a href="#" class="avatar avatar-xl rounded-circle"> 
                       <!--Ici on affiche l'image de l'utilisateur -->     
                      <img alt="..." src="photo_accueil/download.jpeg"> </a> </div>
                    <div class="text-center my-6">
                        <!-- ici on affiche Pseudo & Email & Catégorie -->
                         <a href="#" class="d-block h5 mb-0"><?php echo $utilisateur['Pseudo']; ?></a> <!-- Subtitle --> 
                        <span class="d-block text-sm text-muted"> <?php echo $utilisateur['Email']; ?>  </span> 
                          <span class="d-block text-sm text-muted"><?php echo $type; ?></span>   
                    </div> 
                    <!-- Ici on affiche le rang & Nb_bon_signalement-->
                    <div class="d-flex justify-content-around">
                        <div class="col-4 text-center"> <a href="#" class="h4 font-bolder mb-0"> <?php echo $rang; ?>  </a> <span class="d-block text-sm"> Rang</span> </div>
                       
                        <div class="col-4 text-center"> <a href="#" class="h4 font-bolder mb-0"> <?php echo $utilisateur['Nb_bon_signalement']; ?> </a> <span class="d-block text-sm">Signalements</span> </div>
 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
                                <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js'></script>
                                <script type='text/javascript' src=''></script>
                                <script type='text/javascript' src=''></script>
                                <script type='text/Javascript'></script>
                                </body>
                            </html>