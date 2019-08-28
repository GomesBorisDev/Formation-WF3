<!DOCTYPE html>
<html lang="fr">

<?php
session_start();

$titrePage = "Page d'accueil";
include 'inc/head.php';

?>

<body>
    <?php

    include 'inc/header.php';

    include 'inc/nav.php';

    ?>

    <main class="container">
        <h2>Ma page d'accueil</h2>

        <section>
            <form method="get" action="user.php?user=<?= $_GET['search_user'] ?>">
                <p>
                    <label for="search_user">Rechercher un utilisateur</label>
                    <input type="search" name="search_user" id="search_user">
                    <p>
                        <input type="submit" value="Go !">
                    </p>
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