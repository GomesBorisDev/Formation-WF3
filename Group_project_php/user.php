<?php

require 'inc/connexion.php';

$rq = 'SELECT id_user, user_name, avatar, email FROM user WHERE user_name = :user_name';
$stmt = $pdo->prepare($rq);
$params = [':user_name' => $_GET['search_user']];

if ($stmt->execute($params)) {
    $success = true;
    $user = $stmt->fetch();
}

?>



<!DOCTYPE html>
<html lang="fr">

<?php

$titrePage = "Recherche d'utilisateur";

include 'inc/head.php';

?>

<body>
    <?php

    include 'inc/header.php';

    include 'inc/nav.php';

    ?>

    <main class="container">
        <h2>Recherche d'utilisateur</h2>

        <section>
            <table>
                <thead>
                    <th>Pseudo</th>
                    <th>email</th>
                    <th>avatar</th>
                </thead>
                <tbody>
                    <td><?= $user['user_name']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td><?= $user['avatar']; ?></td>
                </tbody>
            </table>

        </section>
    </main>




    <?php

    include 'inc/footer.php';

    include 'inc/script.php';

    ?>

</body>

</html>