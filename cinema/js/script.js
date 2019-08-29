$(document).ready(function(){
    
    
    var choixFilm = $("#choixFilm");
    var raisonsChoix = $("#raisonsChoix");
    
    var errors = false;
    
    
    // quand on clique sur valider
    $("#choisirFilm").on("submit", function(e) {
        
        e.preventDefault();// empêche le fonctionnement par défaut
        // empêche l'envoi du formulaire
        
        if (choixFilm.val().length === 0) {
        // == comparaison
        // === comparaison strict : à la fois la valeur et le type
            choixFilm.addClass("is-invalid");
            errors = true;
        } else {
            choixFilm.addClass("is-valid");
        }
        
        if (raisonsChoix.val().length < 15) {
        // == comparaison
        // === comparaison strict : à la fois la valeur et le type
            raisonsChoix.addClass("is-invalid");
            errors = true;
        } else {
            raisonsChoix.addClass("is-valid");
        }
        
        
        if (errors === false) {
            $("#choisirFilm").replaceWith("<div class='alert alert-success'>Votre demande a été envoyée.....</div>")
        }
        
    });
    
    
    // quand je modifie le select/options
    choixFilm.on("change", function() {
        $(this).removeClass("is-valid is-invalid");
        errors = false;
    })
    
    // quand je modifie textarea
    raisonsChoix.on("focus", function() {
        $(this).removeClass("is-valid is-invalid");
        errors = false;
    })
    
    
    
});