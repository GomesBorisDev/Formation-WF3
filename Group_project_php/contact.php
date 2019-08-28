<?php

$errors = [];

$safe = array_map('trim', array_map('strip_tags', $_POST));

if (!empty($_POST)) {
	
	if (!strlen($safe['name'] < 3)) {
		$errors[] = 'Votre nom doit contenir au minimum 3 caractères';
	}
	if (!strlen($safe['subject'] < 3)) {
		$errors[] = 'Votre sujet doit contenir au minimum 3 caractères';
	}
	if (!filter_var($safe['email'], FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'L\'adresse email n\'est pas valide';
	}
	if (!strlen($safe['message'] < 10)) {
		$errors[] = 'Votre message est trop court';
	}
}

	
	/* import des classes de PHPMailer */

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	// Load Composer's autoloader
	require 'vendor/autoload.php';

	$mail = new PHPMailer;
	/* paramétrage du SMTP */
	$mail->SMTPOptions = [
		'ssl' =>
		[
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		]
	];

	// $mail->SMTPDebug = 3; //mode debug si > 2
	$mail->CharSet = 'UTF-8'; //charset utf-8
	$mail->isSMTP(); //connexion directe à un serveur SMTP
	$mail->isHTML(true); //mail au format HTML
	$mail->Host = 'smtp.gmail.com'; //serveur SMTP
	$mail->SMTPAuth = true; //serveur sécurisé
	$mail->Port = 465; //port utilisé par le serveur
	$mail->SMTPSecure = 'ssl'; //certificat SSL
	$mail->Username = 'wf3toulouse@gmail.com'; //login
	$mail->Password = '244Seysses'; //mot de passe
	$mail->AddAddress('pratlong.estelle@gmail.com'); //destinataire
	$mail->SetFrom('wf3toulouse@gmail.com'); //expediteur
	$mail->Subject = 'Message de ' . $safe['email']; //sujet
	// le corps du mail au forma HTML
	$mail->Body = '	<h1>Message de ' . $safe['email'] . '</h1>
		<p>Nom: ' . $safe['name'] . '</p>
		<p>Sujet: ' . $safe['subject'] . '</p>
		<p>Message: ' . $safe['message'] . '</p>';

	// envoi
	if ($mail->Send()) {
		$success = true;
	} else echo '<p>Une erreur est survenue, veuillez réessayer plus tard ' . $mail->ErrorInfo . '</p>';

?>


<!DOCTYPE html>
<html lang="fr">

<?php

$titrePage = "Contactez-nous";

include 'inc/head.php';

?>

<body>
	<?php

	include 'inc/header.php';

	include 'inc/nav.php';

	?>

	<main class="container">
		<h2>Contactez-nous</h2>
		<section>

			<form method="post">
				<p>
					<?php if ((isset($errors)) && (count($errors) > 0)) : ?>
						<p style="color:red"><?= implode('<br>', $errors); ?></p>

					<?php elseif (isset($success)) : ?>
						<p style="color:green;">Votre mail à été envoyé. Merci de nous avoir contacté</p>
					<?php endif; ?>

				</p>
				<p>
					<label for="name">Nom / Entreprise</label>
					<input type="text" name="name" id="name">
				</p>
				<p>
					<label for="subject">Sujet</label>
					<input type="text" name="subject" id="subject">
				</p>
				<p>
					<label for="email">Email</label>
					<input type="email" name="email" id="email">
				</p>
				<p>
					<label for="message">Message</label>
					<textarea name="message" id="message" cols="40" rows="5"></textarea>
				</p>
				<p>
					<input type="submit" value="Go">
				</p>
			</form>

		</section>
	</main>




	<?php

	include 'inc/footer.php';

	include 'inc/script.php';

	?>

</body>

</html>