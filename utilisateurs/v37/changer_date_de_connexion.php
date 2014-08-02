<?php
	function update_user_date_de_connexion($bdd, $pseudo) {
		$date = date('Y-m-d H:i:s');
	    $req = $bdd->prepare('UPDATE `utilisateur` SET `date_de_connexion` = ? WHERE `pseudo` = ?');
		$req->execute(array($date, $pseudo));

		$req = $bdd->prepare('UPDATE `utilisateur` SET `date_de_creation` = ? WHERE `pseudo` = ?');
		$req->execute(array($date, $pseudo));
	}
?>