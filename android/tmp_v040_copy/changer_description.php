<?php
	$pseudo = $_GET['pseudo'];
	$description = $_GET['description'];

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$req = $bdd->prepare('UPDATE `utilisateur` SET `description` = ? WHERE `pseudo` = ?');
	$req->execute(array($description, $pseudo));

	$res = 'Description est mise à jour.';

	echo $res;
?>