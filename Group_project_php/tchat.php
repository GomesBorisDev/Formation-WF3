<?php
include 'inc/connexion.php';
session_start();

//nettoyage
$safe = array_map('strip_tags', $_POST);
$errors_msg = array();


 if (!empty($_POST)) {

	if (strlen($safe['user_post']) < 5) {
		$errors_msg[] = 'Tu ne peut poster un message vide ! 5 caractère mini :)';
	}
	if (!$_SESSION['auth']){
		$errors_msg[] = 'Tu dois être connecter pour envoyer des messages au copains ;)';

	}
	if (count($errors_msg) === 0) {



		// Préparation de la requete
		$request = $pdo->prepare('INSERT INTO post (
			id_user, post, date) VALUES (:id_user, :post, :date)');

		$paramsInsert = [
			':id_user' 	=> $_SESSION['id_user'],
			':post'	=> $safe['user_post'],
			':date'	=> date('Y-m-d H:i:s'),
		];

		if ($request->execute($paramsInsert)) {
			$success = true;



			$rqAddTchat = 'SELECT U.id_user, U.user_name, P.date, P.post FROM user U, post P WHERE (P.id_user = :id_user AND P.post = :post) AND (U.id_user = P.id_user)';

			$stmt = $pdo->prepare($rqAddTchat);
			$params = [
				':id_user' => $_SESSION['id_user'],
				':post' => $safe['user_post'],
			];

			if ($stmt->execute($params)) {
				$success = true;
				$userPost = $stmt->fetch();
			}
		}
	}
}

//include 'afficheMessages.php';

				

?>


<!DOCTYPE html>
<html lang="fr">

<?php

$titrePage = "Tchat";

include 'inc/head.php';

?>

<body>
	<?php

	include 'inc/header.php';

	include 'inc/nav.php';

	?>

	<main class="container">
		<div id="div_messages" style="height: ">
			<table>
				<thead>
					<th>Date</th>
					<th>Pseudo</th>
					<th>Message</th>
					<th>Supprimer</th>
				</thead>
				<tbody class="tableau">

				</tbody>
			</table>
		</div>

		<?php if (isset($success)) : ?>
			<p class="msg_send">Ton post vient d'être publié !</p>
		<?php elseif (count($errors_msg) > 0) : ?>
			<p class="msg_no_send"><?= implode('<br>', $errors_msg); ?></p>
		<?php endif; ?>

		<form method="post" enctype="multipart/form-data" id="form_message">

			<br>
			<label for="envoi">Ton message</label>
			<br>
			<textarea name="user_post" id="id_message"></textarea>

			<br>
			<input type="submit" name="submit" value="Poster" id="id_envoi" class="btn_send_kev">
		</form>
	</main>


	<?php

	include 'inc/footer.php';

	include 'inc/script.php';

	?>

	<script>

			var connected = $_SESSION['auth'];
			var user = $_SESSION['id_user']; 
             
    </script>

</body>

</html>


