"use strict";

var dateJour = new Date();
var dateCible = new Date(1992, 7, 18);

var options = {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric"
}

var dateJourLocale = dateJour.toLocaleDateString("fr-FR", options);
var dateCibleLocale = dateCible.toLocaleDateString("fr-FR", options);

var tpsEcouleMS = dateJour - dateCible;

var tpsEcouleS  = parseInt(tpsEcouleMS/1000);
var tpsEcouleMn = parseInt(tpsEcouleMS/1000/60);
var tpsEcouleH  = parseInt(tpsEcouleMS/1000/60/60);
var tpsEcouleJ  = parseInt(tpsEcouleMS/1000/60/60/24);
var tpsEcouleAn = parseInt(tpsEcouleMS/1000/60/60/24/365.25);
var tpsEcouleMois = parseInt(tpsEcouleMS/1000/60/60/24/365.25 * 12);

var nbMoisReel = tpsEcouleMois - (tpsEcouleAn * 12);
var nbJrReel = tpsEcouleJ - ((tpsEcouleAn * 365.25) + ((nbMoisReel*30.4375)));

document.body.innerHTML = 
    
        "<p>Nous sommes le "
        + dateJourLocale
        + ".</p><p>Nous allons calculer le temps écoulé depuis le "
        + dateCibleLocale
        + ".</p><p>Le temps écoulé en ms est de : "
        + tpsEcouleMS
        + "<ul>Temps écoulé : <li>"
        + tpsEcouleAn
        + " années</li><li>"
        + tpsEcouleMois
        + " mois</li><li>"
        + tpsEcouleJ
        + " jours</li><li>"
        + tpsEcouleH
        + " heures</li><li>"
        + tpsEcouleMn
        + " minutes</li><li>"
        + tpsEcouleS
        + " secondes</li><li>"
        + tpsEcouleMS
        + " millisecondes</li></ul><p>Temps total écoulé : "
        + tpsEcouleAn
        + " années "
        + Math.ceil(nbMoisReel)
        + " mois "
        + Math.ceil(nbJrReel)
        + " jour(s).";
