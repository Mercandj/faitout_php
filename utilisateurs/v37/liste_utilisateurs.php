<?php
	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$res = '{ "utilisateurs" : [';

	if(isset($_GET['recherche_pseudo'])) {

		$pseudo = $_GET['recherche_pseudo'];

		$req = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` LIKE "%'.$pseudo.'%" LIMIT 0 , 200');
		$req->execute();
		$i = 0;
		while($donnees = $req->fetch()) {
			if($i!=0)
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
	else if(isset($_GET['page'])) {

		$pseudo = $_GET['recherche_pseudo'];
		$page = $_GET['page'];

		$req = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` LIKE "%'.$pseudo.'%" LIMIT '.(1* ($page-1)).' , '.(5*$page));
		$req->execute();
		$i = 0;
		while($donnees = $req->fetch()) {
			if($i!=0)
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

		echo $res.']';
		if($i!=0)
			echo $res.', "next":'.($page+1).'}';
	}
	else {
		$req = $bdd->prepare('SELECT * FROM `utilisateur` LIMIT 0 , 200');
		$req->execute();
		$i = 0;
		while($donnees = $req->fetch()) {
			if($i!=0)
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
