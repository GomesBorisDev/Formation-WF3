// fichier javascript écran 2

// si l'utilisateur choisit oui sur un écran donné, 
// on rajoute la somme suivante :

var nbEcran5 = 16;
/*
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
document.getElementById("ecran5oui").addEventListener("click", ecran5oui);
document.getElementById("ecran5non").addEventListener("click", ecran5non);

function ecran5oui() {
    calcul += nbEcran5;
    window.location.href="ecran6.html?calcul="+calcul;
}

// si l'utilisateur clique non
function ecran5non() {
    window.location.href="ecran6.html?calcul="+calcul;
}
