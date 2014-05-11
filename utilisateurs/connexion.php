<?php

	include_once 'classe_Utilisateur.php';

	$pseudo = $_GET['pseudo'];
	$mot_de_passe = $_GET['mot_de_passe'];

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$res = '{ "utilisateur" : [';

	$req = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ? AND `mot_de_passe` = ?');
	$req->execute(array($pseudo, $mot_de_passe));
	if($donnees = $req->fetch()) {
		$res.='{';
		$res.='"pseudo": "'.$donnees['pseudo'].'", ';
		$res.='"mot_de_passe": "'.$donnees['mot_de_passe'].'", ';
		$res.='"sexe":"'.$donnees['sexe'].'", ';
		$res.='"xp":"'.$donnees['xp'].'", ';
		$res.='"url_image_profil":"'.$donnees['url_image_profil'].'", ';

		$req3 = $bdd->prepare('SELECT COUNT(*) as total FROM `utilisateur`');
		$req3->execute(array());
		if($donnees3 = $req3->fetch()) {
			$res.='"nombre_utilisateurs":"'.$donnees3['total'].'", ';
		}

		$req4 = $bdd->prepare('SELECT COUNT(*) as total FROM `message` WHERE `Utilisateur_pseudo` = ?');
		$req4->execute(array($pseudo));
		if($donnees4 = $req4->fetch()) {
			$res.='"nombre_mes_messages":"'.$donnees4['total'].'", ';
		}

		$req5 = $bdd->prepare('SELECT COUNT(*) as total FROM `message`');
		$req5->execute(array($pseudo));
		if($donnees5 = $req5->fetch()) {
			$res.='"nombre_messages":"'.$donnees5['total'].'", ';
		}

		
		$req6 = $bdd->prepare('SELECT `Utilisateur_pseudo`, COUNT(*) AS `nb_message` FROM `message` WHERE `Utilisateur_pseudo` = ? GROUP BY `Utilisateur_pseudo` ORDER BY `nb_message`');
		
		/*
		$req6 = $bdd->prepare('SELECT `Utilisateur_pseudo`, COUNT(*) AS nb_message FROM `message` GROUP BY `Utilisateur_pseudo` ORDER BY `nb_message` WHERE `Utilisateur_pseudo` = ?');
		*/
		$req6->execute(array($pseudo));
		while($donnees6 = $req6->fetch()) {
			$res.='"chat_rang":"'.$donnees6['Utilisateur_pseudo'].' '.$donnees6['nb_message'].' '.$donnees6['rownum'].'", ';
		}

		$res.='"admin":"'.$donnees['admin'].'"';

		$req2 = $bdd->prepare('SELECT * FROM `demandeami` WHERE `pseudo_ami` = ?');
		$req2->execute(array($pseudo));
		$id = 0;
		while($donnees2 = $req2->fetch()) {
			if($id == 0) {
				$res.=', "demandeami": [{';
			}
			else {
				$res.=', {';
			}
			$res.='"Utilisateur_pseudo": "'.$donnees2['Utilisateur_pseudo'].'", ';

			$res.= '"utilisateur" : ';
			$req3 = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
			$req3->execute(array($donnees2['Utilisateur_pseudo']));
			if($donnees3 = $req3->fetch()) {
				$res.='{';
				$res.='"pseudo": "'.$donnees3['pseudo'].'", ';
				$res.='"mot_de_passe": "'.$donnees3['mot_de_passe'].'", ';
				$res.='"sexe":"'.$donnees3['sexe'].'", ';
				$res.='"xp":"'.$donnees3['xp'].'", ';
				$res.='"url_image_profil":"'.$donnees3['url_image_profil'].'", ';
				$res.='"admin":"'.$donnees3['admin'].'"';
				$res.='},';
			}

			$res.='"date_de_creation": "'.$donnees2['date_de_creation'].'"';		
			$res.='}';
			$id += 1;
		}
		if($id!=0) {
			$res.=']';
		}

		$res.='}';
		$res.=']}';
		echo $res;
	}
	else {
		$res='KO';
		echo $res;
	}
?>
