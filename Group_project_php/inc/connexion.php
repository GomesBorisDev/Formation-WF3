<?php

$pdo = new PDO('mysql:host=localhost; dbname=e_com; charset=utf8', 'root', '');

//on force le tableau associatif par défaut pour les fetch et les fetchAll
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// Affichage de erreurs SQL (debug en phase de dev)
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

?>