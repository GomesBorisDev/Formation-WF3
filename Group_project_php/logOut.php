<?php

session_start(); //toujours en haut

//suppression d'une variable de session
unset($_SESSION['auth']);

//supression de toutes les variable de session
session_unset();
// ou $_SESSION = [];

//destruction de la session
session_destroy();
//retour à la page d'accueil
header('location: index.php');