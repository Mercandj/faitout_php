
<?php
	function utilisateur_existant($user) {
		try {
			$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
		}
		catch(Exception $e) {
			die('Erreur : '.$e->getMessage());
		}

		$req = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
		$req->execute(array($user));
		if($donnees = $req->fetch()) {
			return true;
		}
		else {
			return false;
		}
	}
?>