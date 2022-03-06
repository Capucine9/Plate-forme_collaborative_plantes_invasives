<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta charset="utf-8" />
      <title>
          Ajout d'une plante
      </title>
      <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
  </head>

  <body>
    <script type="text/javascript" src="js/projet.js"></script>


    <div id="header">Plate-forme collaborative de lutte contre les plantes invasives</div>
    
    <!--menu déroulant-->
    <div class="deroulant">
            <button class="menu"> Menu </button>  
                <div class="partie" >
                    <a href="accueil.php">Accueil</a>
                    <a href="profil_utilisateur.php">Votre profil</a>
                    <a href="repertoire_botannique.php">Le répertoire botannique</a>
                    <a href="">Les utilisateurs</a>
                    <a href="">Les derniers signalements</a>
                    <a href="ajout_signalement.php">Signaler une plante</a>
                    <a href="ajout_plante.php">Ajouter une plante</a>
                    <a href="">Vos amis</a>
                    <a href="connexion.php">Connexion</a>
                    <a href="inscription.php">Inscription</a>
                </div>
        </div>

    <h1 style="text-align:center"> Ajouter une plante </h1>
    <div class="renseignement">
      <div id="titre">Nom français : </div>
      <input type="text" id="renseignement"/>
    </div>
    <div class="renseignement">
      <div id="titre">Nom latin : </div>
      <input type="text" id="renseignement"/>
    </div>


    <div class="renseignement">
      <div id="titre">Famille botanique : </div>
      <select id="type">
        <option value="arbre" selected>Arbre </option>
        <option value="arbuste">Arbuste </option>
        <option value="plante">Plante </option>
      </select>
    </div>


    <div class="renseignement">
      <div id="titre">Régions principales : </div>
      <input type="text" id="renseignement"/>
    </div>

    <div class="renseignement">
      <div id="titre">Couleur : </div>
      <select id="couleur">
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

    <div class="renseignement">
      <div id="titre">Taille (en cm) : </div>
      <input type="text" id="renseignement"/>
    </div>

    <div class="renseignement">
      <div id="titre">Possède des fleurs : </div>
      <input type="radio" name="fleur" value="oui"/><label for="oui">oui</label>
      <input type="radio" id="radiodroite" name="fleur" value="non" checked/><label for="non">non</label>
    </div>
    <div class="renseignement" class="oui msg">
      <div id="titre">Couleur fleur : </div>
      <select id="couleurfleur">
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
    <div class="renseignement">
      <div id="titre">Période de floraison : </div>
      <select id="periodefleur">
        <option value="printemps" selected>Printemps </option>
        <option value="ete">Eté </option>
        <option value="automne">Automne </option>
        <option value="hiver">Hiver </option>
      </select>
    </div>


    <div class="renseignement">
      <div id="titre">Possède des fruits : </div>
      <input type="radio" name="fruit" value="oui"/><label for="oui">oui</label>
      <input type="radio" id="radiodroite" name="fruit" value="non" checked/><label for="non">non</label>
    </div>
    <div class="renseignement">
      <div id="titre">Couleur fruit : </div>
      <select id="couleurfruit">
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
    <!--<div class="renseignement">
      <div id="titre">Type de fruit : </div>
      <select id="typefruit">
        <option value="simple" selected>Simple </option>
        <option value="multiple">Multiple </option>
        <option value="complexe">Complexe </option>
        <option value="compose">Composé </option>
      </select>
      <select id="fruitsimple">
        <option value="sec" selected>Sec </option>
        <option value="charnu">Charnu </option>
      </select>
      <select id="fruitsec">
        <option value="indehiscent" selected>Indéhiscent </option>
        <option value="dehiscent">Déhiscent </option>
      </select>
    </div>-->
    <div class="renseignement">
      <div id="titre">Période de fructification : </div>
      <select id="periodefruit">
        <option value="printemps" selected>Printemps </option>
        <option value="ete">Eté </option>
        <option value="automne">Automne </option>
        <option value="hiver">Hiver </option>
      </select>
    </div>

    <!--<div class="renseignement">
      <div id="titre">Mode de reproduction : </div>
      <input type="text" id="renseignement"/>
    </div>-->

    <div class="renseignement">
      <div id="titre">Description : </div>
      <input type="text" id="renseignement"/>
    </div>

    <div class="renseignement">
        <button id="bouttoncentre" onclick="">Ajouter photos</button>
    </div>


    <button id="bouttongauche" onclick="localhost:81/Projet%20M1/inscription.php">Annuler</button>
    <button id="bouttondroite" onclick="">Valider</button>

    <footer>
        <div id="baspage"> Contact</div>
    </footer> 

  </body>
</html>

<!--taille(en cm ?), couleur plante -->