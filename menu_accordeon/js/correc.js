//appel jQuery
$(document).ready(function() {

    $("#menu").click(function() {
        var objClique = event.target.getAttribute("id");;
        var num = objClique.charAt(objClique.length-1);
        var panneauAOuvrir = "#panneau" + num;
        $(panneauAOuvrir).slideToggle();
    });

    // fin de jQuery
});