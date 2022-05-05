$(document).ready(function(){   
    //Dès qu'on clique sur #b1, on applique show() au titre
    $(".resultbouton1").click(function(){
        //$(".fleur").show();
        $(".entreprise").show();
      });

    //Dès qu'on clique sur #b1, on applique hide() au titre
    $(".resultbouton2").click(function(){
      //$(".fleur").hide();
      $(".entreprise").hide();
    });
});

$(document).ready(function(){   
    //Dès qu'on clique sur #b1, on applique show() au titre
    $(".resultbouton3").click(function(){
        $(".fruit").show();
      });

    //Dès qu'on clique sur #b1, on applique hide() au titre
    $(".resultbouton4").click(function(){
      $(".fruit").hide();
    });
});
  