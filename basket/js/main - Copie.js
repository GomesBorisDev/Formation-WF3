$(document).ready(function(){ //instancie jQuery lorsque la page est chargée
//$(function(){}); //autre manière d'instancier jQuery 

	update();//appel imméduat de la fonction au chargement de la page - permet afficher prix base à l'ouverture de la page

	function updateAdd() { 

	//$('input[name="qty"]').change(update);
		$('input[name="qty"]').change(function(){
			update();
		});

		$('.btn-delete').click(function(e){
			e.preventDefault();//empêche l'action par default. bonne habitude pour les clicks & submit
			$(this).closest('.item').remove();
			update();//j'appelle ma fonction qui recalcule les prix
		});
	};

	//fonction qui recalcule le prix de chaque éléments
	function update() {

		var fullTotalPrice = 0;
		//je récupère la valeur du champ ayant pour attribut name="qty"
		$('[name="qty"]').each(function(){

			var qty = $(this).val();//je parcours mes éléments ayant l'attribut name="qty"
			//console.log(qty); // affiche la quantité de chaque élément

			//récupération du prix unitaire
			//closest > remonter au parent le plus proche
			//find > chercher un enfant
			//.text() me permet de récupéréer la valeur d'un élément
			//$(selector).text('nouyvelle valeur') permet de définir le texte d'un  
			var priceUnitString = $(this).closest('.item').find('.unitPrice').text();
			var priceUnit = parseFloat(priceUnitString); //convertit le texte en chiffre
			//var priceUnitString = parseFloat($(this).closest('.item').find('.unitPrice').text());
			//console.log(priceUnit);


			//prix total
			var priceTotal = qty * priceUnit;

			$(this).closest('.item').find('.totalPrice').text(priceTotal);

			fullTotalPrice += priceTotal; //ajoutera a chaque passage dasn la bouvle, le prix total de l'item au total final
		});//fin boucle .each()

		$('#fullTotalPrice').text(fullTotalPrice);

	};//fin fonction update()

	$('.add-to-basket').click(function(){

		var nameNew = $(this).attr("data-name");
		var priceNew = $(this).attr("data-price");
		console.log(nameNew);
		console.log(priceNew);

		$('tbody').append('<tr class="item"><td>'+ nameNew +'</td><td><input type="number" name="qty" value="1" min="1" class="form-control"></td><td><span class="unitPrice">' + priceNew + '<td><span class="totalPrice">--</span> €</td><td><button type="button" class="btn btn-danger btn-sm btn-delete">X</button></td></tr>');

		updateAdd();
		update();


	}); 
		

});

//JQuery(#maTable > tbody:last).append(<tr>...</tr><tr>...</tr>);
/*$('[class="btn-succes"]').click(function(x){
		x.preventDefault();
		$(this).closest('tbody').append('#data-name')*/