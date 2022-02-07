<!DOCTYPE html>
<html>
    <head>
        <title>Profil Utilisateur</title>
        <meta charset="utf-8">
        <link href="test.css" rel="stylesheet" type="text/css" media="all" />
    </head>
    <body>
        <div id="header">Plate-forme collaborative de lutte contre les plantes invasives</div>

        <form>
            <h1 style="text-align:center"> Mes informations </h1>
            <img src  > <!--mettre photo de la bdd-->
            <br/>
            
            <div class="renseignement">
                <div id="titre">
                Pseudo : 
                </div>
                <output name="pseudo">Claire</output> <!--mettre bdd-->
            </div>
            <div class="renseignement">
                <div id="titre">
                Mot de passe :
                </div>
                <output name="mdp">test</output> <!--mettre bdd-->
            </div>
            <div class="renseignement">
                <div id="titre">
                Adresse mail :
                </div>
                <output name="email">test@test.com</output> <!--mettre bdd-->
            </div>
            <div class="renseignement">
                <div id="titre">
                Nombre de bons signalements :
                </div>
                <output name="email">1</output> <!--mettre bdd-->
            </div>


            <button id="boutonmodif" type=button onclick="">
                Modifier
            </button>
        </form>
    </body>
</html>