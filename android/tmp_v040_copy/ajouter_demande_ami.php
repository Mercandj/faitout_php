<?php

	include_once 'classe_DemandeAmi.php';

	$pseudo = $_GET['pseudo'];
	$pseudo_ami = $_GET['pseudo_ami'];

	$res = '';

	if($pseudo!='null') {

		// Connexion à la base de données
		try {
			$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
		}
		catch(Exception $e) {
			die('Erreur : '.$e->getMessage());
		}		

		if($pseudo!=$pseudo_ami) {	

			$req = $bdd->prepare('SELECT * FROM `ami` WHERE ( `Utilisateur_pseudo` = ? AND `pseudo_ami` = ? ) OR ( `Utilisateur_pseudo` = ? AND `pseudo_ami` = ? )');
			$req->execute(array($pseudo, $pseudo_ami, $pseudo_ami, $pseudo));
			
			if($donnees = $req->fetch()) {
				$res.='KO';
			}
			else {
				$req2 = $bdd->prepare('SELECT * FROM `demandeami` WHERE ( `Utilisateur_pseudo` = ? AND `pseudo_ami` = ? ) OR ( `Utilisateur_pseudo` = ? AND `pseudo_ami` = ? )');
				$req2->execute(array($pseudo, $pseudo_ami, $pseudo_ami, $pseudo));

				if($donnees2 = $req2->fetch()) {
					$res.='KO';
				}
				else {
					$req3 = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
					$req3->execute(array($pseudo));
					if(!$req3->fetch()) {
						die('401 Erreur : '.$pseudo.' inconnu');
					}

					$req3 = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
					$req3->execute(array($pseudo_ami));
					if(!$req3->fetch()) {
						die('401 Erreur : '.$pseudo_ami.' inconnu');
					}

					$date = date('Y-m-d H:i:s');

					$us = new DemandeAmi($pseudo, $date, $pseudo_ami);

					$req = $bdd->prepare($us->getinsert());
					$req->execute($us->getarray());
					$res.='Felicitations, demande ami(e) ajoutée.';

					include_once './../../notifications_push_android/notifier_user.php';
					sendUserGCM($bdd, $pseudo.' souhaite vous ajouter comme proche !', $pseudo_ami);
				}
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
