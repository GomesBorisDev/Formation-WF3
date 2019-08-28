<?php

/* vérification des mots de passe 
   - 1 majuscule
   - 1 chiffre
   - 8 caractères mini */

   
function verifPassword($pwd)
{
	$cptInt = $cptMaj = 0;
	// longueur du mot de passe
	$longueur = strlen($pwd);
	// une chaine est aussi un tableau...
	for($i = 0; $i<$longueur; $i++)
	{
		// un nombre?
		if(is_numeric($pwd[$i])) $cptInt++;
		// majuscule
		else if(strtoupper($pwd[$i]) == $pwd[$i]) 
			$cptMaj++; 
	}
	if($longueur >= 8 AND $cptInt >=1 AND $cptMaj >= 1)
	{
		return true;
	}
	else return false;
}