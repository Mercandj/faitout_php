<?php
	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$res = '{ "utilisateurs" : [';

	$req = $bdd->prepare('SELECT * FROM `utilisateur`');
	$req->execute();
	while($donnees = $req->fetch()) {
		$res.='{';
		$res.='"pseudo": "'.$donnees['pseudo'].'", ';
		$res.='"mot_de_passe": "'.$donnees['mot_de_passe'].'", ';
		$res.='"sexe":"'.$donnees['sexe'].'", ';
		$res.='"xp":"'.$donnees['xp'].'", ';
		$res.='"admin":"'.$donnees['admin'].'"';
		$res.='},';
	}

	echo $res.']}';
?>
