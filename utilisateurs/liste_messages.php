<?php
	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$res = '{';

	$req = $bdd->prepare('SELECT * FROM `message`');
	$req->execute();
	while($donnees = $req->fetch()) {
		$res.='message = {';
		$res.='"Utilisateur_pseudo":"'.$donnees['Utilisateur_pseudo'].'", ';
		$res.='"message":"'.$donnees['message'].'"';
		$res.='}';
	}

	echo $res.'}';
?>
