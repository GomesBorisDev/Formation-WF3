<?php

session_start();
require 'inc/connexion.php';

$errors = array();
$maxFileSize = 3 * 1000 * 1000;


if (!empty($_SESSION) && ($_SESSION['auth']) == "ok") {

	if (!empty($_POST)) {

		$safe = array_map('trim', array_map('strip_tags', $_POST));

		//modifier pseudo
		if (strcmp($safe['input_user_name'], $_SESSION['user_name']) !== 0) {

			if (!strlen($safe['input_user_name'] < 3)) {
				$errors[] = 'Votre pseudo doit contenir au minimum 3 caractères';
			}
			//requete
		}

		//modifier email
		if (strcmp($safe['input_email'], $_SESSION['email']) !== 0) {

			if (!filter_var($safe['input_email'], FILTER_VALIDATE_EMAIL)) {
				$errors[] = 'L\'adresse email n\'est pas valide';
			}
			//requete
		}

		//ajouter & modifier la photo et la verifier

		if (!empty($_FILES)) {

			if ($_FILES['input_avatar']['error'] == UPLOAD_ERR_NO_FILE) {
				//$errors[] = 'Vous devez sélectionner une image';
			}
			elseif ($_FILES['input_avatar']['error'] == UPLOAD_ERR_OK) {
				$image_size = $_FILES['input_avatar']['size'];

				if ($image_size > $maxFileSize) {
					$errors[] = 'Votre image est supérieur à 3 Mo';
				}

				$info = new finfo(FILEINFO_MIME_TYPE);
				$mime = $info->file($_FILES['input_avatar']['tmp_name']);


				$type = substr($mime, 0, 5);
				if ($type == 'image') {
					$extension = substr($_FILES['input_avatar']['name'], strrpos($_FILES['input_avatar']['name'], '.'));

					$newFilename = md5(uniqid(rand(), true)) . $extension;


					if (move_uploaded_file($_FILES['input_avatar']['tmp_name'], 'uploads/avatar/' . $newFilename) === false) {
						$errors[] = 'Une erreur est survenue lors de l\'upload de l\'image';
					}
				}
				else {
					$errors[] = 'Le fichier que vous avez envoyé n\'est pas une image';
				}
			}
			else
				$errors[] = 'Une erreur est survenue lors de l\'envoi de votre image';
		}
		if (count($errors) === 0) {

			if (isset($_FILES['input_avatar']) && $_FILES['input_avatar']['error'] == UPLOAD_ERR_OK) {

				$requestSession = $pdo->prepare('UPDATE user SET user_name = :user_name, email = :email, avatar = :avatar WHERE id_user = :id_user');
				$paramSession = [
					':user_name' => $safe['input_user_name'],
					':email' => $safe['input_email'],
					':avatar' => $newFilename ?? '',
					':id_user' => $_SESSION['id_user']
				];
				if ($requestSession->execute($paramSession)) {
					$success = true;
				}
			}
			else {

				$requestSession = $pdo->prepare('UPDATE user SET user_name = :user_name, email = :email WHERE id_user = :id_user');
				$paramSession = [
					':user_name' => $safe['input_user_name'],
					':email' => $safe['input_email'],
					':id_user' => $_SESSION['id_user']
				];
				if ($requestSession->execute($paramSession)) {
					$success = true;
				}
			}
		}
	}

}

$requestMdfyProfile = $pdo->prepare('SELECT * FROM user WHERE id_user = :id_user');
$paramMdfyProfile = [':id_user' => $_SESSION['id_user']];
$requestMdfyProfile->execute($paramMdfyProfile);
$profile = $requestMdfyProfile->fetch();


?>

<!DOCTYPE html>
<html lang="fr">

<?php
$titrePage = "Modifier mon profil";
include 'inc/head.php';

?>

<body>

	<?php
	include 'inc/header.php';
	include 'inc/nav.php';

	?>

	<?php if (isset($success)) : ?>
		<p style="color:green;">Votre profil a bien été mis à jour Bisous & Calins !!!!</p>

	<?php elseif (count($errors) > 0) :
		?>
		<p style="color:red"><?= implode('<br>', $errors); ?></p>
	<?php endif; ?>

	<?php if ($profile['avatar'] == '') :
		$mdfyAvatar = 'uploads/avatar/no-image.png';
	else :
		$mdfyAvatar = 'uploads/avatar/' . $profile['avatar'];
	endif;
	?>

	<form method="post" enctype="multipart/form-data">
	        <label for="user_name">Changer votre pseudo</label>
	        <?php $_SESSION['user_name'] = $profile['user_name'] ?>
	        <input type="text" name="input_user_name" id="user_name" required value="<?= $_SESSION['user_name']; ?>">
	        <br>
	        <label for="email">Changer d'E-mail</label>
	        <?php $_SESSION['email'] = $profile['email'] ?>
	        <input type="email" name="input_email" id="email" required value="<?= $_SESSION['email']; ?>">
	        <br>
	        <label for="avatar">Modifer Avatar</label>
	        <input type="hidden" name="MAX_FILE_SIZE" value="<?= $maxFileSize; ?>">
	        <input type="file" name="input_avatar" id="avatar" accept="image/*">
	        <img src="<?= $mdfyAvatar; ?>" alt="<?= $_SESSION['user_name']; ?>">
	        <br>
	        <input type="submit" value="submitter">
    </form>

	<?php

	include 'inc/footer.php';

	include 'inc/script.php';

	?>

</body>

</html>