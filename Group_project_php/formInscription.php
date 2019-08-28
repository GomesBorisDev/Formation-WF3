<?php

include 'inc/connexion.php';

include 'fonctionMdp.php';

$errors = [];

if (!empty($_POST)) {

	$safe = array_map('trim', array_map('strip_tags', $_POST));

	if (!strlen($safe['user_name'] < 3)) {
		$errors[] = 'Votre pseudo doit contenir au minimum 3 caractères';
	}
	if (!filter_var($safe['email'], FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'L\'adresse email n\'est pas valide';
	}
	if (!verifPassword($safe['pwd'])) {
		$errors[] = 'Le mot de passe doit contenir au moins 8 caractères, 1 majuscule et un chiffre';
	} else (verifPassword($safe['pwd'])){
		$hash = password_hash($safe['pwd'], PASSWORD_DEFAULT)};
	if (($safe['pwd']) !== ($safe['pwd_confirm'])) {
		$errors[] = 'Le mot de passe de confirmation n\'est pas identique au mot de passe initial ';
	}


	// email déja dans la table?
	$stmtVerif = $pdo->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
	$stmtVerif->execute([':email' => $safe['email']]);
	$exist = $stmtVerif->fetchColumn();

	//S'il n'y a pas d'erreurs et si non présent, inscription. sinon message
	if ($exist > 0) {
		$errors[] = 'Cet email existe déjà';
	}

	if (count($errors) === 0) {

		$rqAjout = "INSERT INTO user( email, pwd, user_name) VALUES(:email, :pwd, :user_name)";

		$stmtAjout = $pdo->prepare($rqAjout);

		$params = [
			':email'      => $safe['email'],
			':pwd'        => $hash,
			':user_name'  => $safe['user_name']
		];

		if ($stmtAjout->execute($params)) {
			$success = true;
		}
	}
}

?>


<!DOCTYPE html>
<html lang="fr">

<?php

$titrePage = "Inscriptions";

include 'inc/head.php';

?>

<body>
	<?php

	include 'inc/header.php';

	include 'inc/nav.php';

	?>

	<main class="container">
		<h2>Inscriptions</h2>

		<form method="post">
			<p>
				<?php if ((isset($errors)) && (count($errors) > 0)) : ?>
					<p style="color:red"><?= implode('<br>', $errors); ?></p>

				<?php elseif (isset($success)) : ?>
					<p style="color:green;">Félicitation ! Vous etes inscrits.</p>
				<?php endif; ?>

			</p>
			<p>
				<label for="user_name">Pseudo</label>
				<input type="text" name="user_name" id="user_name" required placeholder="votre pseudo ici">
			</p>
			<p>
				<label for="email">Email</label>
				<input type="email" name="email" id="email" required placeholder="ex: prenom.nom@societe.fr">
			</p>
			<p>
				<label for="pwd">Mot de Passe</label>
				<input type="password" name="pwd" id="pwd" required placeholder="8 caract min dont 1 chiffre et une majuscule">
			</p>
			<p>
				<label for="pwd_confirm">Confirmation du mot de Passe</label>
				<input type="password" name="pwd_confirm" id="pwd_confirm" required placeholder="le mot de passe doit être identique au précédent">
			</p>
			<p>
				<input type="submit" value="Je m'enregistre">
			</p>
		</form>

	</main>

	<?php

	include 'inc/footer.php';

	include 'inc/script.php';

	?>

</body>

</html>