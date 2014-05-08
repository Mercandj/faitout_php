<?php
	$pseudo = $_GET['pseudo'];
	$pseudo_ami = $_GET['pseudo_ami'];

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$res = '';

	$req = $bdd->prepare('DELETE * FROM `ami` WHERE `pseudo_ami` = ? AND `Utilisateur_pseudo` = ?');
	$req->execute(array($pseudo_ami, $pseudo));

	$res .= 'Ami supprimé.';

	echo $res;
?>
