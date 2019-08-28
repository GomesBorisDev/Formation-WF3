$(document).ready(function () {

	function loadMessage()
	{
		$.get('afficheMessages.php', function(json){ 

			for (let i = 0; i < 20; i++) {
				var del = "";
				var idPost = json[i].id_post;
				var post = json[i].post;
				var dateDelete = new Date (json[i].date);
				dateDelete.setMinutes(dateDelete.getMinutes() + 5);
				var dateNow = new Date ();
				var userName = json[i].user_name;
				var idUser = json[i].id_user;
				var dateFr = dateDelete.toLocaleDateString('fr-FR', {
					hour: "numeric",
					minute: "numeric",
					day: "numeric",
					month: "numeric",
				})
				
				if (connected) {
					
					if ((idUser == user) && (dateDelete >= dateNow)) {
						del = '<a href = "deletePost.php?id_post=' + idPost + '">Supprimer</a>';
						
					} else {
							del = '';
					}
				}

				
				$(".tableau").append('<tr><td class="td_date">' + dateFr + '</td><td class="td_user">' + userName + '</td><td class="td_post">' + post + '</td><td class = "deletePost">' + del + '</tr>');
					console.log(json);
			};  
		})
	}
	
	loadMessage();

	function ajax(){

			$.ajax({
				type: 'POST',
				url: 'tchat.php',
			
				success: function(json){
					// alert('ok');
					$(".tableau").html('');
					loadMessage();
				},

				error: function(){
					alert('non!');

				} 
			});
		}

	setInterval(function(){ ajax() }, 20000);

	// form.submit()
	$('#form_message').submit(function(e){
	console.log('submit');
		// e.preventDefault();
		ajax();
		
	});



});
