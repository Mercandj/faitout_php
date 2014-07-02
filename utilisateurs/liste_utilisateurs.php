<?php
	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$res = '{ "utilisateurs" : [';

	if(isset($_GET['pseudo'])) {

		$pseudo = $_GET['pseudo'];

		$req = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` LIKE "%'.$pseudo.'%"');
		$req->execute();
		$i = 0;
		while($donnees = $req->fetch()) {
			if($i==0)
				$res.=',';
			$res.='{';
			$res.='"pseudo": "'.$donnees['pseudo'].'", ';
			$res.='"mot_de_passe": "'.$donnees['mot_de_passe'].'", ';
			$res.='"sexe":"'.$donnees['sexe'].'", ';
			$res.='"xp":"'.$donnees['xp'].'", ';
			$res.='"url_image_profil":"'.$donnees['url_image_profil'].'", ';
			$res.='"admin":"'.$donnees['admin'].'"';
			$res.='}';
			$i+=1;
		}

		echo $res.']}';
	}
	else {
		$req = $bdd->prepare('SELECT * FROM `utilisateur`');
		$req->execute();
		$i = 0;
		while($donnees = $req->fetch()) {
			if($i==0)
				$res.=',';
			$res.='{';
			$res.='"pseudo": "'.$donnees['pseudo'].'", ';
			$res.='"mot_de_passe": "'.$donnees['mot_de_passe'].'", ';
			$res.='"sexe":"'.$donnees['sexe'].'", ';
			$res.='"xp":"'.$donnees['xp'].'", ';
			$res.='"url_image_profil":"'.$donnees['url_image_profil'].'", ';
			$res.='"description":"'.$donnees['description'].'", ';
			$res.='"admin":"'.$donnees['admin'].'"';
			$res.='}';
			$i+=1;
		}

		echo $res.']}';
	}
?>
