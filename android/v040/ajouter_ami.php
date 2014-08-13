<?php
	include_once 'classe_Ami.php';

	$pseudo = $_GET['pseudo'];
	$pseudo_ami = $_GET['pseudo_ami'];

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$res = '';

	if($pseudo!='null') {

		if($pseudo!=$pseudo_ami) {

			$req2 = $bdd->prepare('SELECT * FROM `ami` WHERE `Utilisateur_pseudo` = ? AND `pseudo_ami` = ?');
			$req2->execute(array($pseudo, $pseudo_ami));
			if($donnees2 = $req2->fetch()) {
				
			}
			else {
				$req = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
				$req->execute(array($pseudo));
				if(!$req->fetch()) {
					die('401 Erreur : '.$pseudo.' inconnu');
				}

				$req = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
				$req->execute(array($pseudo_ami));
				if(!$req->fetch()) {
					die('401 Erreur : '.$pseudo_ami.' inconnu');
				}

				$date = date('Y-m-d H:i:s');

				$us = new Ami($pseudo, $date, $pseudo_ami);

				$req = $bdd->prepare($us->getinsert());
				$req->execute($us->getarray());
				$res.='Felicitations, ami(e) ajouté(e).';
			}
		}
		else {
			$res.='KO';
		}
	}
	else {
		$res.='KO';
	}

	echo $res;
?>