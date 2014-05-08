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

	$date = date('Y-m-d H:i:s');

	$us = new DemandeAmi($pseudo, $pseudo_ami, $date);

	$req = $bdd->prepare($us->getinsert());
	$req->execute($us->getarray());
	$res.='Felicitations, demande ami(e) ajoutée.';

	echo $res;
?>
