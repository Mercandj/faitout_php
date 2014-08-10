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

		$_SESSION['chat'] = "2";

		/*
		$req2 = $bdd->prepare('SELECT COUNT(*) as total FROM `utilisateur`');
		$req2->execute(array());
		if($donnees2 = $req2->fetch())
			$nb_utilisateur = $donnees2['total'];

		$req2 = $bdd->prepare('SELECT COUNT(*) as total FROM `message` WHERE `Utilisateur_pseudo` = ?');
		$req2->execute(array($user));
		if($donnees2 = $req2->fetch()) {
			if($donnees2['total']!=0) {
				$req_rang_message = 
					'SELECT COUNT( `nb_message` )+1 AS `rang`
					FROM (
					    SELECT COUNT( * ) AS `nb_message`
					    FROM `message`
					    GROUP BY `Utilisateur_pseudo`
					    ORDER BY `nb_message`
					) AS T
					WHERE `nb_message` > (
					    SELECT COUNT( * ) 
					    FROM `message` 
					    WHERE `Utilisateur_pseudo` = ?
					    GROUP BY `Utilisateur_pseudo` 
					    ORDER BY `nb_message`
					)';
				$req3 = $bdd->prepare($req_rang_message);
				$req3->execute(array($user));
				if($donnees3 = $req3->fetch())
					$_SESSION['rang_chat'] = ((intval($donnees6['rang'])/intval($nb_utilisateur))*100);
			}
			else
				$_SESSION['rang_chat'] = 0;
		}
		*/

		header("Location: ./index.php");
	}
	else {
		echo 'Mauvais username ou password';
		header("Location: ./../index.html");
	}
?>