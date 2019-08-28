<?php

include 'inc/connexion.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$errors = [];

if(!empty($_POST)) {

	$safe = array_map('trim', array_map('strip_tags', $_POST));

	if(!filter_var($safe['emailoublie'], FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'L\'email est invalide !';
	}

	if(count($errors) === 0) {

		$rqtExistOublie = "SELECT COUNT(*)
						FROM user
						WHERE user_name = :user_name
						AND email = :email";

		$stmtVerifOublie = $pdo -> prepare($rqtExistOublie);
		$paramsOublie = [':user_name' => $safe['user_name_oublie'], ':email' => $safe['emailoublie']];

		$stmtVerifOublie -> execute($paramsOublie);
		$exist = $stmtVerifOublie -> fetchColumn();

		if($exist <= 0) {
			$errors[] = 'Vous n\'avez pas de compte, veuillez en créer un !';
		}
		else {

			require 'vendor/autoload.php';

			$mail = new PHPMailer;

			$mail->SMTPOptions = ['ssl' => ['verify_peer' => false,
									 		'verify_peer_name' => false,
									 		'allow_self_signed' => true]
								 ];

			$mail->CharSet = 'UTF-8';
			$mail->isSMTP(); 
			$mail->isHTML(true); 
			$mail->Host = 'smtp.gmail.com'; 
			$mail->SMTPAuth = true; 
			$mail->Port = 465; 
			$mail->SMTPSecure = 'ssl'; 
			$mail->Username = 'wf3toulouse@gmail.com'; 
			$mail->Password = '244Seysses'; 
			$mail->AddAddress($safe['emailoublie']); 
			$mail->SetFrom('wf3toulouse@gmail.com', 'my mail'); 
			$mail->Subject = 'Message de '.$safe['emailoublie']; 
			
			$mail->Body = '<html>
								<head>
									<style>
							  		h1{color:green; }
							 		</style>
								</head>
								<body>
									<h1>Cliquez sur le lien ci-dessous afin de modifier votre mot de passe !</h1>
									<a href="http://localhost/PHP/Site-projet/formModifMdp.php">LINK !</p>
								</body>
						 	</html>';

			if($mail->Send()) {
				echo '<p style="color:green">Mail sended !</p>';
			}
		}
	}
}
	/*$success = true;*/


?>


<!DOCTYPE html>
<html lang="fr">

<?php
$titrePage = "Oublie mot de passe";

include 'inc/head.php';
?>

<body>

	<?php /*echo $pwdReturn*/ ?>

	<?php if(isset($success)):?>
		<p style="color:green;">Your have been registered !</p>

	<?php elseif (count($errors) > 0): ?>		
		<p style="color:red"><?=implode('<br>', $errors);?></p>
	<?php endif;?>


	<?php

	include 'inc/header.php';

	include 'inc/nav.php';

	?>

		

	
	<main class="container">
		<h2>Vous avez oubliez votre mot de passe ?!</h2>

		<form method="post">

			<p>
				<label for="user_name_oublie">User Name</label>
				<input type="text" name="user_name_oublie" id="user_name_oublie" required placeholder="votre nom ici">
			</p>
			<p>
				<label for="emailoublie">Email</label>
				<input type="email" name="emailoublie" id="emailoublie" required placeholder="ex: prenom.nom@societe.fr">
			</p>
			<p>
				<input type="submit" value="Envoyer">
			</p>
		</form>

	</main>

	<?php

	include 'inc/footer.php';

	include 'inc/script.php';

	?>

</body>

</html>