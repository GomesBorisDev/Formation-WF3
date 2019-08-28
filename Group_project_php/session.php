<?php

session_start(); //on démarre une session
require 'inc/connexion.php';

$requestAvatar = $pdo->prepare('SELECT avatar FROM user WHERE id_user = :id_user');
$paramAvatar = [':id_user' => $_SESSION['id_user']];
$requestAvatar->execute($paramAvatar);
$avatar = $requestAvatar->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">

<?php

$titrePage = "Mon profil";
include 'inc/head.php';

?>

<body>
	<?php
	include 'inc/header.php';
	include 'inc/nav.php';


	?>

	<main id="session">
		<h2>Mon compte</h2>
		<h3>Bonjour <?= $_SESSION['user_name']; ?></h3>

		<div class="container div_mon_compte">
			<table>
				<thead>
					<tr>
						<th>Pseudo</th>
						<th>E-mail</th>
						<th>Avatar</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($avatar == '') :
						$photo = 'uploads/avatar/no-image.png';
					else :
						$photo = 'uploads/avatar/' . $avatar;
					endif;
					?>
					<tr>
						<td><?= $_SESSION['user_name']; ?></td>
						<td><?= $_SESSION['email']; ?></td>
						<td class="photo">
							<img src="<?= $photo; ?>" alt="<?= $_SESSION['user_name']; ?>">
						</td>
						<td>
						</td>

				</tbody>
			</table>
		</div>

		<a href="modifyProfile.php">Modifier mon profil</a>


	</main>

	<?php


	include 'inc/footer.php';

	include 'inc/script.php';

	?>

</body>

</html>