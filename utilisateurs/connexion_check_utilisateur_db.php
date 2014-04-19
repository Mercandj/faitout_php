
<?php
	function utilisateur_existant($pseudo, $mot_de_passe) {
		try {
			$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
		}
		catch(Exception $e) {
			die('Erreur : '.$e->getMessage());
		}

		$req = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ? AND `mot_de_passe` = ?');
		$req->execute(array($pseudo, $mot_de_passe));
		if($donnees = $req->fetch()) {
			return true;
		}
		else {
			return false;
		}
	}
?>