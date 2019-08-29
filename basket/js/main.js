
$(document).ready(function(){

	updatePrice();


	$('table').on('change', 'input[name="qty"]', function(){//on > agit sur les éléments modifier aprés le chargement de la page (DOM = arborescence HTML au départ du chargement de la page)
		updatePrice();
	});
	

	$('table').on('click', '.btn-delete', function(e){//
		e.preventDefault();
		$(this).closest('.item').remove();
		updatePrice();
	});

	$('.btn-remove').on('click', function(y){//
		y.preventDefault();
		$('tbody > tr').remove();
		updatePrice();
	});	

	$('.add-to-basket').click(function(){

		var nameProduct = $(this).data('name');//
		var priceProduct = $(this).data('price');//

		var html = '<tr class="item">' +
					'<td>' + nameProduct +
					'<td><input type="number" name="qty" value="1" min="1" class="form-control"></td>' +
					'<td><span class="unitPrice">' + priceProduct + '</span> €</td>' +
					'<td><span class="totalPrice">' + priceProduct + '</span> €</td>' +
					'<td><button type="button" class="btn btn-danger btn-sm btn-delete">X</button></td>' +
					'</tr>';

		$('table > tbody').append(html);
		updatePrice();
	});


	function updatePrice(){
		fullTotalPrice = 0;
		
		$('[name="qty"]').each(function(){

			var qty = $(this).val();
			console.log(qty); 

			var priceUnitString = $(this).closest('.item').find('.unitPrice').text();
			var priceUnit = parseFloat(priceUnitString);

			console.log(priceUnit);

			var priceTotal = qty * priceUnit;
			$(this).closest('.item').find('.totalPrice').text(priceTotal);

			
			fullTotalPrice += priceTotal; 

		}); 

		$('#fullTotalPrice').text(fullTotalPrice);

	}

});