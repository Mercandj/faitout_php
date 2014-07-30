<?php
	$pseudo = $_GET['pseudo'];

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$res = '';

	$req = $bdd->prepare('DELETE FROM `groupe` WHERE `Utilisateur_pseudo` = ?');
	$req->execute(array($pseudo));

	$req = $bdd->prepare('DELETE FROM `demandeami` WHERE `pseudo_ami` = ? OR `Utilisateur_pseudo` = ?');
	$req->execute(array($pseudo, $pseudo));

	$req = $bdd->prepare('DELETE FROM `image` WHERE `Utilisateur_pseudo` = ?');
	$req->execute(array($pseudo));

	$req = $bdd->prepare('DELETE FROM `message` WHERE `Utilisateur_pseudo` = ?');
	$req->execute(array($pseudo));

	$req = $bdd->prepare('DELETE FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?');
	$req->execute(array($pseudo, $pseudo));

	$req = $bdd->prepare('DELETE FROM `utilisateur` WHERE `pseudo` = ?');
	$req->execute(array($pseudo));

	$res .= 'User supprimé.';

	echo $res;
?>
