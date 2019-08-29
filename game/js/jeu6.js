// fichier javascript écran 2

// si l'utilisateur choisit oui sur un écran donné, 
// on rajoute la somme suivante :

var nbEcran6 = 32;

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
document.getElementById("ecran6oui").addEventListener("click", ecran6oui);
document.getElementById("ecran6non").addEventListener("click", ecran6non);

function ecran6oui() {
    calcul += nbEcran6;
    alert("Le chiffre choisi est : " + calcul);
}

// si l'utilisateur clique non
function ecran6non() {
    alert("Le chiffre choisi est : " + calcul);
}
