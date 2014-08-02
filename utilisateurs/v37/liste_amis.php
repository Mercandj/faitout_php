<?php

	$pseudo = $_GET['pseudo'];

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$per_page = 50;
	$page = 1;

	if(isset($_GET['per_page']))
		$per_page = (int) $_GET['per_page'];
	if(isset($_GET['page']))
		$page = (int) $_GET['page'];

	$res = '{ "amis" : [';

	if(!isset($_GET['page'])) {
		if(isset($_GET['recherche_pseudo'])) {
			$recherche_pseudo = $_GET['recherche_pseudo'];
			$req = $bdd->prepare( 'SELECT * FROM `ami` WHERE (`Utilisateur_pseudo` = ? OR `pseudo_ami` = ?) AND ( (`pseudo_ami` = ? AND `Utilisateur_pseudo` LIKE "%'.$recherche_pseudo.'%") OR (`Utilisateur_pseudo` = ? AND `pseudo_ami` LIKE "%'.$recherche_pseudo.'%")) LIMIT '.$per_page );
			$req->execute(array($pseudo, $pseudo, $pseudo, $pseudo));
		}
		else {
			$req = $bdd->prepare( 'SELECT * FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ? LIMIT '.$per_page );
			$req->execute(array($pseudo, $pseudo));
		}
	}
	else {
		if(isset($_GET['recherche_pseudo'])) {
			$recherche_pseudo = $_GET['recherche_pseudo'];
			$req = $bdd->prepare( 'SELECT * FROM `ami` WHERE (`Utilisateur_pseudo` = ? OR `pseudo_ami` = ?) AND ( (`pseudo_ami` = ? AND `Utilisateur_pseudo` LIKE "%'.$recherche_pseudo.'%") OR (`Utilisateur_pseudo` = ? AND `pseudo_ami` LIKE "%'.$recherche_pseudo.'%")) LIMIT '.$per_page.' OFFSET '.(($page-1)*$per_page));
			$req->execute(array($pseudo, $pseudo, $pseudo, $pseudo));
		}
		else {
			$req = $bdd->prepare('SELECT * FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ? LIMIT '.$per_page.' OFFSET '.(($page-1)*$per_page));
			$req->execute(array($pseudo, $pseudo));
		}
	}

	/*
	$req = $bdd->prepare('SELECT * FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?');
	$req->execute(array($pseudo, $pseudo));
	*/

	$id = 0;

	while($donnees = $req->fetch()) {

		if($id!=0) {
			$res.=',';
		}
		
		if($donnees['Utilisateur_pseudo'] != $pseudo) {
			$req2 = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
			$req2->execute(array($donnees['Utilisateur_pseudo']));
			if($donnees2 = $req2->fetch()) {
				$res.='{';
				$res.='"pseudo": "'.$donnees2['pseudo'].'", ';
				$res.='"sexe":"'.$donnees2['sexe'].'", ';
				$res.='"xp":"'.$donnees2['xp'].'", ';
				$res.='"url_image_profil":"'.$donnees2['url_image_profil'].'", ';
				$res.='"description":"'.$donnees2['description'].'", ';
				$res.='"admin":"'.$donnees2['admin'].'", ';
				$res.='"images":[';
				$req3 = $bdd->prepare('SELECT * FROM `image` WHERE `Utilisateur_pseudo` = ? ORDER BY date_de_creation DESC LIMIT 50');
				$req3->execute(array($donnees2['pseudo']));
				$tmp_images_index = 0;
				while($donnees3 = $req3->fetch()) {
					if($tmp_images_index==0)
						$res.='{';
					else
						$res.=',{';
					$res.='"titre":"'.$donnees3['titre'].'", ';
					$res.='"url":"'.$donnees3['url'].'", ';
					$res.='"date":"'.$donnees3['date_de_creation'].'"';
					$res.='}';
					$tmp_images_index+=1;
				}
				$res.=']';
				$res.='}';
			}
		}
		else if($donnees['pseudo_ami'] != $pseudo) {
			$req2 = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
			$req2->execute(array($donnees['pseudo_ami']));
			if($donnees2 = $req2->fetch()) {
				$res.='{';
				$res.='"pseudo": "'.$donnees2['pseudo'].'", ';
				$res.='"sexe":"'.$donnees2['sexe'].'", ';
				$res.='"xp":"'.$donnees2['xp'].'", ';
				$res.='"url_image_profil":"'.$donnees2['url_image_profil'].'", ';
				$res.='"description":"'.$donnees2['description'].'", ';
				$res.='"admin":"'.$donnees2['admin'].'", ';
				$res.='"images":[';
				$req3 = $bdd->prepare('SELECT * FROM `image` WHERE `Utilisateur_pseudo` = ? ORDER BY date_de_creation DESC LIMIT 50');
				$req3->execute(array($donnees2['pseudo']));
				$tmp_images_index = 0;
				while($donnees3 = $req3->fetch()) {
					if($tmp_images_index==0)
						$res.='{';
					else
						$res.=',{';
					$res.='"titre":"'.$donnees3['titre'].'", ';
					$res.='"url":"'.$donnees3['url'].'", ';
					$res.='"date":"'.$donnees3['date_de_creation'].'"';
					$res.='}';
					$tmp_images_index+=1;
				}
				$res.=']';
				$res.='}';
			}
		}
		else {
			$res.='KO';
		}
		$id+=1;
	}

	$res.='], ';

	if($id==$per_page)
		$res.='"next":'.($page+1).', ';

	$req3 = $bdd->prepare('SELECT COUNT(*) as total FROM `utilisateur`');
	$req3->execute(array());
	if($donnees3 = $req3->fetch())
		$res.='"nombre_utilisateurs":"'.$donnees3['total'].'"';

	$res.='}';

	echo $res;
?>
