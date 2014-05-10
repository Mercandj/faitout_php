<?php

	include_once 'classe_DemandeAmi.php';

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

	$req = $bdd->prepare('SELECT * FROM `ami` WHERE ( `Utilisateur_pseudo` = ? AND `pseudo_ami` = ? ) OR ( `Utilisateur_pseudo` = ? AND `pseudo_ami` = ? ) ');
	$req->execute(array($pseudo, $pseudo_ami, $pseudo_ami, $pseudo));
	if($donnees = $req->fetch()) {
		$res.='KO';
	}
	else {
		$date = date('Y-m-d H:i:s');

		$us = new DemandeAmi($pseudo, $date, $pseudo_ami);

		$req = $bdd->prepare($us->getinsert());
		$req->execute($us->getarray());
		$res.='Felicitations, demande ami(e) ajoutée.';
	}
	echo $res;
?>
