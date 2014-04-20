<?php

	include_once 'classe_Message.php';

	$pseudo = $_GET['pseudo'];
	$message = $_GET['message'];

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$res = '';

	$date = date('Y-m-d H:i:s');


	$mess = new Message($pseudo, $date, $message);

	$req = $bdd->prepare($mess->getinsert());
	$req->execute($mess->getarray());
	$res.='Felicitations, vous avez bien envoye un message.';

	echo $res;
?>
