<?php
require 'inc/connexion.php';

header('Content-type: application/json; charset=utf-8');


$rqListPost = 'SELECT P.post, P.date, U.user_name, P.id_user, P.id_post FROM user U JOIN post P ON U.id_user = P.id_user ORDER BY P.date DESC LIMIT 20';

$stmtListPost = $pdo->prepare($rqListPost);
$stmtListPost->execute();
$listPost = $stmtListPost->fetchAll();

echo json_encode($listPost);


?>			