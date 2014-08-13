<?php
	include_once 'classe_Utilisateur.php';

	$user = new Utilisateur;

	if(isset($_GET['pseudo']))
		$user->pseudo = $_GET['pseudo'];
	if(isset($_GET['mot_de_passe']))
		$user->mot_de_passe = $_GET['mot_de_passe'];
	if(isset($_GET['pseudo_a_supp']))
		$pseudo_a_supp = $_GET['pseudo_a_supp'];

	$request_body = file_get_contents('php://input');
	$phpArray = json_decode($request_body, true);
	if($phpArray!=null) {
		foreach ($phpArray as $key => $value) {
		    if($key=="utilisateur") {
			    foreach ($value as $k => $v) {
			    	if($k=="pseudo")
			    		$user->pseudo = $v;
			    	else if($k=="mot_de_passe")
			    		$user->mot_de_passe = $v;
			    }
			}
		}
	}

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$req = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ? AND `mot_de_passe` = ? AND (`admin` = \'true\' OR `admin` = \'True\' OR `admin` = \'TRUE\'? OR `admin` = \'oui\' OR `admin` = ?\'admin\')');
	$req->execute(array($user->pseudo, $user->mot_de_passe));
	if($donnees = $req->fetch()) {
		$req = $bdd->prepare('DELETE FROM `groupe` WHERE `Utilisateur_pseudo` = ?');
		$req->execute(array($pseudo_a_supp));

		$req = $bdd->prepare('DELETE FROM `demandeami` WHERE `pseudo_ami` = ? OR `Utilisateur_pseudo` = ?');
		$req->execute(array($pseudo_a_supp, $pseudo_a_supp));

		$req = $bdd->prepare('DELETE FROM `image` WHERE `Utilisateur_pseudo` = ?');
		$req->execute(array($pseudo_a_supp));

		$req = $bdd->prepare('DELETE FROM `message` WHERE `Utilisateur_pseudo` = ?');
		$req->execute(array($pseudo_a_supp));

		$req = $bdd->prepare('DELETE FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?');
		$req->execute(array($pseudo_a_supp, $pseudo_a_supp));

		$req = $bdd->prepare('DELETE FROM `utilisateur` WHERE `pseudo` = ?');
		$req->execute(array($pseudo_a_supp));

		$res = 'User supprimé.';
	}
	else {
		$res = 'KO';
	}

	echo $res;
?>


