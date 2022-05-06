$(document).ready(function(){   
    //Dès qu'on clique sur le radio bouton de class resultbouton1, on applique show() 
    //à la class fleur ou entreprise
    $(".resultbouton1").click(function(){
      $(".fleur").show();
      $(".entreprise").show();
    });

    //Dès qu'on clique sur le radio bouton de class resultbouton1, on applique hide() 
    //à la class fleur ou entreprise
    $(".resultbouton2").click(function(){
      $(".fleur").hide();
      $(".entreprise").hide();
    });
});

$(document).ready(function(){   
    $(".resultbouton3").click(function(){
        $(".fruit").show();
      });

    $(".resultbouton4").click(function(){
      $(".fruit").hide();
    });
});
  