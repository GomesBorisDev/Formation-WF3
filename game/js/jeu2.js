// fichier javascript écran 2

// si l'utilisateur choisit oui sur un écran donné, 
// on rajoute la somme suivante :
var nbEcran2 = 2;
/*
var nbEcran3 = 4;
var nbEcran4 = 8;
var nbEcran5 = 16;
var nbEcran6 = 32;
*/

// d'abord on récupère la variable calcul dans l'URL

var url = window.location.search;
// ici on récupère la fin de l'URL à partir du "?"
// soit : "?calcul=1" ou "?calcul=0"
console.log(url);

var calcul = parseInt(url.substring(url.lastIndexOf("=")+1));
// url.lastIndexOf("=")+1 retourne : 8
// url.substring(8) : 1 ou 0
console.log(calcul);

// si l'utilisateur clique oui
document.getElementById("ecran2oui").addEventListener("click", ecran2oui);
document.getElementById("ecran2non").addEventListener("click", ecran2non);

function ecran2oui() {
    calcul += nbEcran2;
    window.location.href="ecran3.html?calcul="+calcul;
}

// si l'utilisateur clique non
function ecran2non() {
    window.location.href="ecran3.html?calcul="+calcul;
}

