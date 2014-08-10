<?php
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
		session_start();
		$_SESSION['pseudo'] = $donnees['pseudo'];
		$_SESSION['url_image_profil'] = $donnees['url_image_profil'];
		$_SESSION['description'] = $donnees['description'];
		header("Location: ./index.php");
	}
	else {
		echo 'Mauvais username ou password';
		header("Location: ./../index.html");
	}
?>