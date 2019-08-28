<?php

session_start();

include 'inc/connexion.php';

$errors = [];

if (!empty($_POST)) {

    $safe = array_map('trim', array_map('strip_tags', $_POST));

    $rq = "SELECT * FROM user WHERE email = :email";

    $stmt = $pdo->prepare($rq);

    $params = [':email' => $safe['email']];

    if (!$stmt->execute($params)) {
        $errors[] = 'L\'adresse email est inconnue';
    }

    $user = $stmt->fetch();

    if (!password_verify($safe['pwd'], $user['pwd'])) {
        $errors[] = 'Le mot de passe ne correspond pas';
    }

    if (count($errors) === 0) {

        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['user_name'] = $user['user_name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['auth'] = 'ok';

        session_regenerate_id();

        $success = true;
        echo '<script>
				window.location.href="session.php";
			</script>';
    }
}


?>


<!DOCTYPE html>
<html lang="fr">

<?php

$titrePage = "Page d'accueil";

include 'inc/head.php';

?>

<body>
    <?php

    include 'inc/header.php';

    include 'inc/nav.php';

    ?>

    <main class="container">
        <h2>Se connecter</h2>

        <section>
            <form method="post">
                <p>
                    <label>Email</label>
                    <input type="email" name="email" required placeholder="Votre email">
                </p>
                <p>
                    <label>Mot de Passe</label>
                    <input type="password" name="pwd" required placeholder="Votre mot de passe">
                </p>
                <p>
                    <input type="submit" value="Envoyer">
                </p>
                <p><a href="formInscription.php">Inscriptions</a></p>
            </form>
        </section>
    </main>




    <?php

    include 'inc/footer.php';

    include 'inc/script.php';

    ?>

</body>

</html>