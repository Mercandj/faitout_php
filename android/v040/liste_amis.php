<?php
	include_once 'lib.php';
	include_once 'classe_Utilisateur.php';

	$user = new Utilisateur;

	if(isset($_GET['pseudo']))
		$user->pseudo = $_GET['pseudo'];
	if(isset($_GET['langue']))
		$user->langue = $_GET['langue'];

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
			    	else if($k=="langue")
			    		$user->langue = $v;
			    	else if($k=="longitude")
			    		$user->longitude = $v;
			    	else if($k=="latitude")
			    		$user->latitude = $v; 
			    }
			}
		}
	}
	if($user->langue!=null)
		$fr = (strpos($user->langue,'fr') !== false);
	else
		$fr = true;

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
			//$req = $bdd->prepare( 'SELECT * FROM `ami` WHERE (`Utilisateur_pseudo` = ? OR `pseudo_ami` = ?) AND ( (`pseudo_ami` = ? AND `Utilisateur_pseudo` LIKE "%'.$recherche_pseudo.'%") OR (`Utilisateur_pseudo` = ? AND `pseudo_ami` LIKE "%'.$recherche_pseudo.'%")) LIMIT '.$per_page );
			//$req->execute(array($user->pseudo, $user->pseudo, $user->pseudo, $user->pseudo));
			$req_sql = 
			'SELECT *
			FROM(
				SELECT `Utilisateur_pseudo` AS `pseudo` FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?
				UNION ALL
				SELECT `pseudo_ami` AS `pseudo` FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?
			) AS A
			WHERE (`pseudo` != ? AND `pseudo` LIKE "%'.$recherche_pseudo.'%")
			GROUP BY `pseudo`
			ORDER BY ASC
			LIMIT '.$per_page;
			$req = $bdd->prepare($req_sql);
			$req->execute(array($user->pseudo, $user->pseudo, $user->pseudo, $user->pseudo, $user->pseudo));
		}
		else {
			//$req = $bdd->prepare( 'SELECT `Utilisateur_pseudo` AS `pseudo` FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ? LIMIT '.$per_page );
			//$req->execute(array($user->pseudo, $user->pseudo));
			$req_sql = 
			'SELECT *
			FROM(
				SELECT `Utilisateur_pseudo` AS `pseudo` FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?
				UNION ALL
				SELECT `pseudo_ami` AS `pseudo` FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?
			) AS A
			WHERE `pseudo` != ?
			GROUP BY `pseudo`
			ORDER BY ASC
			LIMIT '.$per_page;
			$req = $bdd->prepare($req_sql);
			$req->execute(array($user->pseudo, $user->pseudo, $user->pseudo, $user->pseudo, $user->pseudo));
		}
	}
	else {
		if(isset($_GET['recherche_pseudo'])) {
			$recherche_pseudo = $_GET['recherche_pseudo'];
			//$req = $bdd->prepare( 'SELECT * FROM `ami` WHERE (`Utilisateur_pseudo` = ? OR `pseudo_ami` = ?) AND ( (`pseudo_ami` = ? AND `Utilisateur_pseudo` LIKE "%'.$recherche_pseudo.'%") OR (`Utilisateur_pseudo` = ? AND `pseudo_ami` LIKE "%'.$recherche_pseudo.'%")) LIMIT '.$per_page.' OFFSET '.(($page-1)*$per_page));
			//$req->execute(array($user->pseudo, $user->pseudo, $user->pseudo, $user->pseudo));
			$req_sql = 
			'SELECT *
			FROM(
				SELECT `Utilisateur_pseudo` AS `pseudo` FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?
				UNION ALL
				SELECT `pseudo_ami` AS `pseudo` FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?
			) AS A
			WHERE (`pseudo` != ? AND `pseudo` LIKE "%'.$recherche_pseudo.'%")
			GROUP BY `pseudo`
			ORDER BY ASC
			LIMIT '.$per_page.' OFFSET '.(($page-1)*$per_page));
			$req = $bdd->prepare($req_sql);
			$req->execute(array($user->pseudo, $user->pseudo, $user->pseudo, $user->pseudo, $user->pseudo));
		}
		else {
			//$req = $bdd->prepare('SELECT * FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ? LIMIT '.$per_page.' OFFSET '.(($page-1)*$per_page));
			//$req->execute(array($user->pseudo, $user->pseudo));
			$req_sql = 
			'SELECT *
			FROM(
				SELECT `Utilisateur_pseudo` AS `pseudo` FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?
				UNION ALL
				SELECT `pseudo_ami` AS `pseudo` FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?
			) AS A
			WHERE `pseudo` != ?
			GROUP BY `pseudo`
			ORDER BY ASC
			LIMIT '.$per_page.' OFFSET '.(($page-1)*$per_page));
			$req = $bdd->prepare($req_sql);
			$req->execute(array($user->pseudo, $user->pseudo, $user->pseudo, $user->pseudo, $user->pseudo));
		}
	}

	$id = 0;

	while($donnees = $req->fetch()) {

		if($id!=0)
			$res.=',';
		
		$pseudo_ami = $donnees['pseudo'];
		/*
		if($donnees['Utilisateur_pseudo'] != $user->pseudo)
			$pseudo_ami = $donnees['Utilisateur_pseudo'];
		else if($donnees['pseudo_ami'] != $user->pseudo)
			$pseudo_ami = $donnees['pseudo_ami'];
		else
			die('Erreur : Utilisateur_pseudo == pseudo_ami == $pseudo');
		*/
		$req2 = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
		$req2->execute(array($pseudo_ami));
		if($donnees2 = $req2->fetch()) {
			$res.='{';
			$res.='"pseudo": "'.str_replace('"', '\"', $donnees2['pseudo']).'", ';
			if($fr)
				$res.='"sexe":"'.$donnees2['sexe'].'", ';
			else if(strpos($donnees2['sexe'],'omme')!== false)
				$res.='"sexe":"Man", ';
			else
				$res.='"sexe":"Woman", ';
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
				$res.='"url":"'.$donnees3['url'].'", ';
				$res.='"date":"'.$donnees3['date_de_creation'].'"';
				$res.='}';
				$tmp_images_index+=1;
			}
			$res.='], ';

			$req3 = $bdd->prepare('SELECT COUNT(*) as total FROM `utilisateur`');
			$req3->execute(array());
			if($donnees3 = $req3->fetch())
				$res.='"nombre_utilisateurs":"'.$donnees3['total'].'", ';

			$req4 = $bdd->prepare('SELECT COUNT(*) as total FROM `message` WHERE `Utilisateur_pseudo` = ?');
			$req4->execute(array($donnees2['pseudo']));
			if($donnees4 = $req4->fetch()) {
				$res.='"nombre_mes_messages":"'.$donnees4['total'].'", ';

				if($donnees4['total']!=0) {
					$req6 = $bdd->prepare($req_rang_message);
					$req6->execute(array($donnees2['pseudo']));
					if($donnees6 = $req6->fetch())
						$res.='"rang_chat":"'.$donnees6['rang'].'", ';
				}
				else
					$res.='"rang_chat":"'.$donnees3['total'].'", ';
			}

			$req4 = $bdd->prepare('SELECT COUNT(*) as total FROM `image` WHERE `Utilisateur_pseudo` = ?');
			$req4->execute(array($donnees2['pseudo']));
			if($donnees4 = $req4->fetch()) {
				$res.='"nombre_mes_images":"'.$donnees4['total'].'", ';

				if($donnees4['total']!=0) {
					$req6 = $bdd->prepare($req_rang_image);
					$req6->execute(array($donnees2['pseudo']));
					if($donnees6 = $req6->fetch())
						$res.='"rang_images":"'.$donnees6['rang'].'", ';
				}
				else
					$res.='"rang_images":"'.$donnees3['total'].'", ';
			}

			$req5 = $bdd->prepare('SELECT COUNT(*) as total FROM `message`');
			$req5->execute(array($donnees2['pseudo']));
			if($donnees5 = $req5->fetch())
				$res.='"nombre_messages":"'.$donnees5['total'].'", ';
			
			$req8 = $bdd->prepare('SELECT COUNT(*) as total FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?');
			$req8->execute(array($donnees2['pseudo'], $donnees2['pseudo']));
			if($donnees8 = $req8->fetch()) {
				$res.='"nombre_mes_amis":"'.$donnees8['total'].'", ';

				if($donnees8['total']!=0) {
					$req7 = $bdd->prepare($req_rang_ami);
					$req7->execute(array($donnees2['pseudo']));
					if($donnees7 = $req7->fetch())
						$res.='"rang_ami":"'.$donnees7['rang'].'", ';
				}
				else
					$res.='"rang_ami":"'.$donnees3['total'].'", ';
			}

			if($donnees2['clic_best']=='0') {
				$res.='"rang_jeu_clic":"'.$donnees3['total'].'"';
			}
			else {
				$req9 = $bdd->prepare($req_rang_jeu_best);
				$req9->execute(array($donnees2['pseudo']));
				if($donnees9 = $req9->fetch())
					$res.='"rang_jeu_clic":"'.$donnees9['rang'].'"';
			}		

			$res.='}';
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
