<?php

require 'inc/connexion.php';

$rqDelete = 'DELETE FROM post WHERE id_post = :id_post';

$stmtDelete = $pdo->prepare($rqDelete);

$paramsDelete = [ ':id_post' => $_GET['id_post']];

if($stmtDelete->execute($paramsDelete)){
    echo '<script>
				window.location.href="tchat.php";
			</script>';
}
