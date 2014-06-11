<?php

	$message = $_GET['message'];
	$reponse = $_GET['reponse'];

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$req = $bdd->prepare('UPDATE `message_droid` SET `reponse` = ?  WHERE `message` = ?');
	$req->execute(array($reponse, $message));
	
	$res ='Felicitations, vous avez bien ajoute une reponse au message.';

	echo $res;
?>
