<?php

include 'inc/connexion.php';

include 'fonctionMdp.php';

$errors = [];

if(!empty($_POST)) {

	$safe = array_map('trim', array_map('strip_tags', $_POST));

	$rqtExistModif = 'SELECT COUNT(*)
					FROM user
					WHERE user_name = :user_name
					AND email = :email';

	$stmtVerifModif = $pdo -> prepare($rqtExistModif);
	$paramsModif = [':user_name' => $safe['user_name_modif'], ':email' => $safe['emailmodif']];

	$stmtVerifModif -> execute($paramsModif);
	$exist = $stmtVerifModif -> fetchColumn();

	if($exist <= 0) {
			$errors[] = 'Vous n\'avez pas de compte, veuillez en créer un !';
	}

	if(($exist > 0) && (count($errors) === 0)) {

		if (!verifPassword($safe['pwd_modif'])) {
				$errors[] = 'Le mot de passe doit contenir au moins 8 caractères, 1 majuscule et un chiffre';
		} 
		elseif (($safe['pwd_modif']) !== ($safe['pwd_confirm_modif'])) {
				$errors[] = 'Le mot de passe de confirmation n\'est pas identique au mot de passe initial ';
		}

		if(count($errors) === 0) {

			$hash = password_hash($safe['pwd_modif'], PASSWORD_DEFAULT);

			$rqtNewPwd = 'UPDATE user
							SET pwd = :pwd_modif
							WHERE user_name = :user_name
							AND email = :email';

			$stmtRqtModif = $pdo -> prepare($rqtNewPwd);
			$paramsRqtModif = [':pwd_modif' => $hash,':user_name' => $safe['user_name_modif'], ':email' => $safe['emailmodif']];

			if($stmtRqtModif -> execute($paramsRqtModif)) {
				$success = true;
			}
		}
	}
}


?>


<!DOCTYPE html>
<html lang="fr">

<?php

$titrePage = "Oublie mot de passe";

include 'inc/head.php';

if(!empty($_POST)) {}
?>

<body>

	<?php if(isset($success)):?>
		<p style="color:green;">Votre mot de passe a bien été modifié !</p>

	<?php elseif (count($errors) > 0): ?>		
		<p style="color:red"><?=implode('<br>', $errors);?></p>
	<?php endif;?>

	<?php

	include 'inc/header.php';

	include 'inc/nav.php';



	?>

		

	
	<main class="container">
		<h2>Choisissez un nouveau mot de passe !</h2>

		<form method="post">

			<p>
				<label for="user_name_modif">User Name</label>
				<input type="text" name="user_name_modif" id="user_name_modif" required placeholder="votre nom ici">
			</p>
			<p>
				<label for="emailmodif">Email</label>
				<input type="email" name="emailmodif" id="emailmodif" required placeholder="ex: prenom.nom@societe.fr">
			</p>
			<p>
				<label for="pwd_modif">Nouveau mot de passe:</label>
				<input type="password" name="pwd_modif" required>
			</p>
			<p>
				<label for="pwd_confirm_modif">Confirmation du nouveau mot de passe:</label>
				<input type="password" name="pwd_confirm_modif" required>
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