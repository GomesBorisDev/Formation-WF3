"use strict";
//appel jQuery
$(document).ready(function() {
	//effets Afficher/Masquer (show/hide)
	$("#show").click(function() {
		$("#txtCible").show();
	});

	$("#hide").click(function() {
		$("#txtCible").hide();
	});

	$("#toggleShowHide").click(function(){
		$("#txtCible").toggle();
	});

	//Effets Fondu
	$("#fade").click(function() {
		$("#fondu1").fadeOut(3000);//fondu sortant
		$("#fondu2").fadeToggle(3000);//bascule entre fondu entrant et sortant selon la visibilité initiale de l'objet
		$("#fondu3").fadeTo(3000, 0.5); //.fadeTo (durée, opacity) 
		$("#fondu4").fadeIn(3000); //.fadeIn([durée]) par défaut la durée est de 400ms -[] quand optionel //fondu entrant
	});

	//Effet Slide (disponible: slideDown, slideUp, slideToggle)
	$("#bandeau").click (function() {
		$("#panneau").slideToggle("slow");
		//slow est un paramètre optionnel d'effet de durée - ou fast ou un nombre pour une durée 
		//
	});

	//Effet Animation (permet d'animer plusieurs propriétés CSS - attention certaines ne sont pas animables)
	$("#btAnimate").click (function() {
		$("#rectangleRouge").animate({ //syntaxe JSON
			opacity: "toggle",
			height: "toggle",
			left: "+=200" //fonctionnecar on as mis position absolute dans le CSS : ajoute 200pxà la position actuelle
		});//fin animation
	});//fin click

});//fin jQuery