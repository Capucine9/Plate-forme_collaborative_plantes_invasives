let togg1 = document.getElementById("togg1");
let result1 = document.getElementById("resultbouton1");
let result2 = document.getElementById("resultbouton2");

togg1.addEventListener("change", () => {
    if(getComputedStyle(result1).display == "none"){
        result1.style.display = "block";
    } else {
        result1.style.display = "none";
    }
    if(getComputedStyle(result2).display == "none"){
        result2.style.display = "block";
    } else {
        result2.style.display = "none";
    }
})

let togg2 = document.getElementById("togg2");
let result3 = document.getElementById("resultbouton3");
let result4 = document.getElementById("resultbouton4");

togg2.addEventListener("change", () => {
    if(getComputedStyle(result3).display == "none"){
        result3.style.display = "block";
    } else {
        result3.style.display = "none";
    }
    if(getComputedStyle(result4).display == "none"){
        result4.style.display = "block";
    } else {
        result4.style.display = "none";
    }
})