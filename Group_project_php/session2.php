<?php
/* session2.php */
session_start();

echo '<pre>';
print_r($_SESSION);
print_r($_SERVER);
echo '</pre>';

//navigateur (user-agent)
echo $_SERVER['HTTP_USER_AGENT'];
//adresse IP de l'internaute
echo $_SERVER['REMOTE_ADDR'];

if(isset($_SESSION['auth']))
{
	echo 'Vous êtes connecté';
}
else echo 'Je ne vous connais pas';

?>

<a href="session.php">retour</a>
<a href="goodbye.php">Se déconnecter</a>