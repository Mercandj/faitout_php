<?php
	$pseudo = $_GET['pseudo'];
	$date = $_GET['date'];

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$res = '';

	$req = $bdd->prepare('DELETE FROM `image` WHERE `Utilisateur_pseudo` = ? AND `date_de_creation` = ?');
	$req->execute(array($pseudo, $date));

	$res .= 'Image supprimée';

	echo $res;
?>
