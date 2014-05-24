<?php

	include_once 'classe_Ami.php';

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

	if($pseudo!=$pseudo_ami) {

		$req2 = $bdd->prepare('SELECT * FROM `ami` WHERE `Utilisateur_pseudo` = ? AND `pseudo_ami` = ?');
		$req2->execute(array($pseudo, $pseudo_ami));
		if($donnees2 = $req2->fetch()) {
			
		}
		else {
			$date = date('Y-m-d H:i:s');

			$us = new Ami($pseudo, $date, $pseudo_ami);

			$req = $bdd->prepare($us->getinsert());
			$req->execute($us->getarray());
			$res.='Felicitations, ami(e) ajouté(e).';
		}
	}
	else {
		$res.='KO';
	}

	echo $res;
?>