$(document).ready(function(){


	$('input').on('change', function(){
		var color = $('[name="color"]').val();
		console.log(color);

		$('h1').css('color', color);
		$('p').css('background-color', color);

		var html = color;
		$('#rgba').text(html);
		$('#rgba').css('color', color);
	});


});