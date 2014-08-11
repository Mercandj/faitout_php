<?php
	$pseudo = $_GET['pseudo'];
	$wallpaper = $_GET['wallpaper'];

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$req = $bdd->prepare('UPDATE `utilisateur` SET `wallpaper` = ? WHERE `pseudo` = ?');
	$req->execute(array($xp, $pseudo));

	$res = 'wallpaper est mise à jour.';

	echo $res;
?>