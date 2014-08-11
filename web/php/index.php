<?php
	include_once 'lib.php';
	include_once 'classe_Utilisateur.php';


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

		$req = $bdd->prepare('SELECT COUNT(*) as total FROM `utilisateur`');
		$req->execute(array());
		if($donnees = $req->fetch())
			$utilisateur->nombre_utilisateurs = $donnees['total'];

		$req = $bdd->prepare('SELECT COUNT(*) as total FROM `message` WHERE `Utilisateur_pseudo` = ?');
		$req->execute(array($utilisateur->pseudo));
		if($donnees = $req->fetch()) {
			$utilisateur->nombre_mes_messages = $donnees['total'].'", ';

			if($donnees['total']!=0) {
				$req2 = $bdd->prepare($req_rang_message);
				$req2->execute(array($utilisateur->pseudo));
				if($donnees2 = $req2->fetch())
					$utilisateur->rang_chat = $donnees2['rang'].'", ';
			}
			else
				$utilisateur->rang_chat = $utilisateur->nombre_utilisateurs;

			$utilisateur->rang_chat_pourcent = round(((intval($utilisateur->nombre_utilisateurs)-intval($utilisateur->rang_chat)+1)/intval($utilisateur->nombre_utilisateurs))*100);
		
			if($utilisateur->rang_chat_pourcent>82)
				$utilisateur->rang_chat_pourcent_round = 100;
			else if($utilisateur->rang_chat_pourcent>63)
				$utilisateur->rang_chat_pourcent_round = 75;
			else if($utilisateur->rang_chat_pourcent>38)
				$utilisateur->rang_chat_pourcent_round = 50;
			else if($utilisateur->rang_chat_pourcent>15)
				$utilisateur->rang_chat_pourcent_round = 25;
			else
				$utilisateur->rang_chat_pourcent_round = 0;

		}

		include_once 'vue.php';
	}
	else {
		echo 'Mauvais username ou password';
		header("Location: ./../index.html");
	}
?>