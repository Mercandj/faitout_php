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

		$res.='{';
		$res.='"pseudo": "'.$donnees['pseudo'].'", ';
		$res.='"sexe":"'.$donnees['sexe'].'", ';
		$res.='"xp":"'.$donnees['xp'].'", ';
		$res.='"url_image_profil":"'.$donnees['url_image_profil'].'", ';
		$res.='"description":"'.$donnees['description'].'", ';

		session_start();
		$_SESSION['user'] = $user;
		header("Location: ./index.php");
	}
	else {
		echo 'Mauvais username ou password';
		header("Location: ./../index.html");
	}
?>