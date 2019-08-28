<!DOCTYPE html>
<html lang="fr">

<?php

$titrePage = "Mentions Légales";

include 'inc/head.php';

?>

<body>
    <?php

    include 'inc/header.php';

    include 'inc/nav.php';

    ?>

    <main class="container">
        <h2>Mentions Légales</h2>

        <?php

        $tableau = file('mentions.txt');

        foreach ($tableau as $mention) {
            //on remplace les lignes vides par un hr
            if (trim($mention) == '') {
                echo '
            <hr class="h30">';
                continue;
            }
            // on cherche les ":" pour séparer la ligne dans un tableau
            $tLigne = explode(':', $mention);
            // on compte le nombre d'élements du tableau
            if (COUNT($tLigne) == 2) {
                echo '<p><strong>' . $tLigne[0]
                    . ': </strong>'
                    . htmlentities($tLigne[1]) . '</p>';
            }
            // si la ligne ne contient pas de ":"
            else {
                echo '<p><em>' . $tLigne[0] . '<em></p>';
            }
        }

        //PHP_EOL = saut de ligne dans des fichiers
        ?>

    </main>

    <?php

    include 'inc/footer.php';

    include 'inc/script.php';

    ?>

</body>

</html>