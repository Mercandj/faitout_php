<?php

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$requete = 'SELECT * FROM `message_droid` WHERE `reponse` IS NOT NULL LIMIT 0 , 300';

	$req = $bdd->prepare($requete);
	$req->execute();
	
	$res = "";

	$x = 0;
	while($donnees = $req->fetch()) {

		$res.='[Q] "'.$donnees['message'].'" ';
		$res.='[R] "'.$donnees['reponse'].'"<br/>';

		$x+=1;
	}

	$ret = '<!DOCTYPE html><html xml:lang="fr" lang="fr"><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><body><a>'.$res.'</a></body></html>';

	echo utf8_decode($ret);
?>