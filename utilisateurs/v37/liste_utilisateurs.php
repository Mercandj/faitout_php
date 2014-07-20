<?php
	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$per_page = 50;
	$page = 1;

	if(isset($_GET['per_page'])) {
		$per_page = (int) $_GET['per_page'];
	}
	if(isset($_GET['page'])) {
		$page = (int) $_GET['page'];
	}

	if(!isset($_GET['page'])) {
		if(isset($_GET['recherche_pseudo'])) {
			$recherche_pseudo = $_GET['recherche_pseudo'];
			$req = $bdd->prepare( 'SELECT * FROM `utilisateur` WHERE `pseudo` LIKE "%'.$recherche_pseudo.'%" LIMIT '.$per_page );
			$req->execute();
		}
		else {
			$req = $bdd->prepare( 'SELECT * FROM `utilisateur` LIMIT '.$per_page );
			$req->execute();
		}
	}
	else {
		if(isset($_GET['recherche_pseudo'])) {
			$recherche_pseudo = $_GET['recherche_pseudo'];
			$req = $bdd->prepare( 'SELECT * FROM `utilisateur` WHERE `pseudo` LIKE "%'.$recherche_pseudo.'%" LIMIT '.$per_page.' OFFSET '.(($page-1)*$per_page));
			$req->execute();
		}
		else {
			$req = $bdd->prepare('SELECT * FROM `utilisateur` LIMIT '.$per_page.' OFFSET '.(($page-1)*$per_page));
			$req->execute();
		}

	}

	$res = '{ "utilisateurs" : [';

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

	$res.=']';
	if($i==$per_page)
		$res.=', "next":'.($page+1);

	$res.='}';

	echo $res;



	/*
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
		$page = $_GET['page'];

		$req = $bdd->prepare('SELECT * FROM `utilisateur` LIMIT '.($per_page*($page-1)).' , '.($per_page*$page));
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

		$res.=']';
		if($i==$per_page)
			$res.=', "next":'.($page+1).'}';
		echo $res;
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
	*/
?>
