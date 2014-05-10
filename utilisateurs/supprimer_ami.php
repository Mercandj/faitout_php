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

	$req = $bdd->prepare('DELETE * FROM `ami` WHERE ( `Utilisateur_pseudo` = ? AND `pseudo_ami` = ? ) OR ( `Utilisateur_pseudo` = ? AND `pseudo_ami` = ? )');
	$req->execute(array($pseudo_ami, $pseudo, $pseudo, $pseudo_ami));

	$res .= 'Ami supprimé.';

	echo $res;
?>
