"use strict";
// fichier javascript écran 1

// pour stocker le "résultat" de chaque page
var calcul = 0;

// si l'utilisateur choisit oui sur un écran donné, 
// on rajoute la somme suivante :
var nbEcran1 = 1;
/*
var nbEcran2 = 2;
var nbEcran3 = 4;
var nbEcran4 = 8;
var nbEcran5 = 16;
var nbEcran6 = 32;
*/

//ECRAN 1

// si l'utilisateur clique oui

document.getElementById("ecran1oui").addEventListener("click", ecran1oui);
document.getElementById("ecran1non").addEventListener("click", ecran1non);

function ecran1oui() {
    calcul += nbEcran1;
    window.location.href="ecran2.html?calcul="+calcul;
}

// si l'utilisateur clique non
function ecran1non() {
    window.location.href="ecran2.html?calcul="+calcul;
}
