<?php

	include_once 'classe_Message_sans_reponse.php';

	$var = $_GET['var'];
	$message = $_GET['message'];
	$nom = $_GET['nom'];
	$age = $_GET['age'];
	$account = $_GET['account'];
	$nat = $_GET['nat'];
	$version = $_GET['version'];
	$android = $_GET['android'];
	$devicename = $_GET['devicename'];
	$sms = $_GET['sms'];

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$res = '';

	$date = date('Y-m-d H:i:s');

	// Création d'une image
	$im = new Message_sans_reponse(
		$date,
		$message, 
		$nom,
		$age,
		$nat,
		$account,
		$version,
		$android,
		$devicename,
		$sms
	);

	// INSERT de l'image dans la base de données
	$req = $bdd->prepare($im->getinsert());
	$req->execute($im->getarray());


	$res.='Felicitations, vous avez bien envoye le message.';

	echo $res;
?>
