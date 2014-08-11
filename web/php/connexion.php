<?php

	include_once 'classe_Utilisateur';


	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$user = $_POST['user'];
	$pass = $_POST['pass'];

	$req = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ? AND `mot_de_passe` = ?');
	$req->execute(array($user, $pass));
	if($donnees = $req->fetch()) {
		$utilisateur = new Utilisateur();

		$utilisateur->pseudo = $donnees['pseudo'];
		$utilisateur->url_image_profil = $donnees['url_image_profil'];
		$utilisateur->description = $donnees['description'];

		include_once 'index.php';
	}
	else {
		echo 'Mauvais username ou password';
		header("Location: ./../index.html");
	}
?>