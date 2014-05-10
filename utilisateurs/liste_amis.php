<?php

	$pseudo = $_GET['pseudo'];

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$res = '{ "amis" : [';

	$req = $bdd->prepare('SELECT * FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?');
	$req->execute(array($pseudo, $pseudo));

	$id = 0;

	while($donnees = $req->fetch()) {

		if($id!=0) {
			$res.=',';
		}
		
		if($donnees['Utilisateur_pseudo'] != $pseudo) {
			$req2 = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
			$req2->execute(array($donnees['Utilisateur_pseudo']));
			if($donnees2 = $req2->fetch()) {
				$res.='{';
				$res.='"pseudo": "'.$donnees2['pseudo'].'", ';
				$res.='"mot_de_passe": "'.$donnees2['mot_de_passe'].'", ';
				$res.='"sexe":"'.$donnees2['sexe'].'", ';
				$res.='"xp":"'.$donnees2['xp'].'", ';
				$res.='"admin":"'.$donnees2['admin'].'"';
				$res.='}';
			}
		}
		else if($donnees['pseudo_ami'] != $pseudo) {
			$req2 = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
			$req2->execute(array($donnees['pseudo_ami']));
			if($donnees2 = $req2->fetch()) {
				$res.='{';
				$res.='"pseudo": "'.$donnees2['pseudo'].'", ';
				$res.='"mot_de_passe": "'.$donnees2['mot_de_passe'].'", ';
				$res.='"sexe":"'.$donnees2['sexe'].'", ';
				$res.='"xp":"'.$donnees2['xp'].'", ';
				$res.='"admin":"'.$donnees2['admin'].'"';
				$res.='}';
			}
		}
		else {
			$res.='KO';
		}
		$id+=1;
	}

	echo $res.']}';
?>
