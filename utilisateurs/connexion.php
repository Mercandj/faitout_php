<?php

	include_once 'classe_Utilisateur.php';
	include_once 'connexion_check_utilisateur_db.php';

	$pseudo = $_GET['pseudo'];
	$mot_de_passe = $_GET['mot_de_passe'];

	$res = '';

	if(utilisateur_existant($pseudo,$mot_de_passe)) {
		$res.='OK';
	}
	else {
		$res.='KO';
	}

	echo $res;
?>
