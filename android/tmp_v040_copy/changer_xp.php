<?php
	$pseudo = $_GET['pseudo'];
	$xp = $_GET['xp'];

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$req = $bdd->prepare('UPDATE `utilisateur` SET `xp` = ? WHERE `pseudo` = ?');
	$req->execute(array($xp, $pseudo));

	$res = 'Xp est mise à jour.';

	echo $res;
?>