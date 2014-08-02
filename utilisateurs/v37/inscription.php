<?php

	include_once 'classe_Utilisateur.php';
	include_once 'inscription_check_utilisateur_db.php';

	$pseudo = $_GET['pseudo'];
	$mot_de_passe = $_GET['mot_de_passe'];
	$sexe = $_GET['sexe'];

	if($pseudo!='null') {
		// Connexion à la base de données
		try {
			$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
		}
		catch(Exception $e) {
			die('Erreur : '.$e->getMessage());
		}

		$res = '';

		if(utilisateur_existant($pseudo)) {
			$res.='Ce nom d\'utilisateur est deja pris.';
		}
		else {
			$date = date('Y-m-d H:i:s');
		 	$us = new Utilisateur($pseudo, $mot_de_passe, $sexe, $date);
			$req = $bdd->prepare($us->getinsert());
			$req->execute($us->getarray());
			$res.='OK';
		}
	}
	else {
		$res ='Ce nom d\'utilisateur est deja pris.';
	}

	echo $res;
?>
