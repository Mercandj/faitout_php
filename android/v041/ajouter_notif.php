<?php
	include_once 'classe_Message.php';
	include_once 'classe_DemandeAmi.php';

	if(isset($_GET['pseudo']))
		$pseudo = $_GET['pseudo'];
	$destinataire = $_GET['destinataire'];
	$message = $_GET['message'];

	$res = '';

	if($pseudo!='null') {

		// Connexion à la base de données
		try {
			$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
		}
		catch(Exception $e) {
			die('Erreur : '.$e->getMessage());
		}

		$req = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
		$req->execute(array($pseudo));
		if(!$req->fetch()) {
			die('401 Erreur : '.$pseudo.' inconnu');
		}

		include_once './../../notifications_push_android/notifier_user.php';
		sendUserGCM($bdd, $pseudo.' à '.$destinataire.' : '.$message, $destinataire);
			
		$date = date('Y-m-d H:i:s');
		$url = '';

		$mess = new Message($pseudo, $date, $message, $destinataire, $url);

		$req = $bdd->prepare($mess->getinsert());
		$req->execute($mess->getarray());

		$res.='Felicitations, vous avez bien envoye un message.';		
	}
	else {
		$res.='KO';
	}
	echo $res;
?>
