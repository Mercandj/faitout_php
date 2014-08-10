<?php
	include_once 'lib.php';
	
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
		$pseudo_tmp = $donnees['pseudo'];
		$res.='"pseudo": "'.str_replace('"', '\"', $pseudo_tmp).'", ';
		$res.='"sexe":"'.$donnees['sexe'].'", ';
		$res.='"xp":"'.$donnees['xp'].'", ';
		$res.='"url_image_profil":"'.$donnees['url_image_profil'].'", ';
		$res.='"description":"'.$donnees['description'].'", ';
		$res.='"admin":"'.$donnees['admin'].'", ';

		$req3 = $bdd->prepare('SELECT COUNT(*) as total FROM `utilisateur`');
		$req3->execute(array());
		if($donnees3 = $req3->fetch())
			$res.='"nombre_utilisateurs":"'.$donnees3['total'].'", ';

		$req4 = $bdd->prepare('SELECT COUNT(*) as total FROM `message` WHERE `Utilisateur_pseudo` = ?');
		$req4->execute(array($pseudo_tmp));
		if($donnees4 = $req4->fetch()) {
			$res.='"nombre_mes_messages":"'.$donnees4['total'].'", ';

			if($donnees4['total']!=0) {
				$sql_req_6 = 
				'SELECT COUNT( `nb_message` )+1 AS `rang`
				FROM (
				    SELECT COUNT( * ) AS `nb_message`
				    FROM `message`
				    GROUP BY `Utilisateur_pseudo`
				    ORDER BY `nb_message`
				) AS T
				WHERE `nb_message` > (
				    SELECT COUNT( * ) 
				    FROM `message` 
				    WHERE `Utilisateur_pseudo` = ?
				    GROUP BY `Utilisateur_pseudo` 
				    ORDER BY `nb_message`
				)';

				$req6 = $bdd->prepare($sql_req_6);
				$req6->execute(array($pseudo_tmp));
				if($donnees6 = $req6->fetch())
					$res.='"rang_chat":"'.$donnees6['rang'].'", ';
			}
			else
				$res.='"rang_chat":"'.$donnees3['total'].'", ';
		}

		$req4 = $bdd->prepare('SELECT COUNT(*) as total FROM `image` WHERE `Utilisateur_pseudo` = ?');
		$req4->execute(array($pseudo_tmp));
		if($donnees4 = $req4->fetch()) {
			$res.='"nombre_mes_images":"'.$donnees4['total'].'", ';

			if($donnees4['total']!=0) {
				$sql_req_6 = 
				'SELECT COUNT( `nb_images` )+1 AS `rang`
				FROM (
				    SELECT COUNT( * ) AS `nb_images`
				    FROM `image`
				    GROUP BY `Utilisateur_pseudo`
				    ORDER BY `nb_images`
				) AS T
				WHERE `nb_images` > (
				    SELECT COUNT( * ) 
				    FROM `image` 
				    WHERE `Utilisateur_pseudo` = ?
				    GROUP BY `Utilisateur_pseudo` 
				    ORDER BY `nb_images`
				)';

				$req6 = $bdd->prepare($sql_req_6);
				$req6->execute(array($pseudo_tmp));
				if($donnees6 = $req6->fetch())
					$res.='"rang_images":"'.$donnees6['rang'].'", ';
			}
			else
				$res.='"rang_images":"'.$donnees3['total'].'", ';
		}

		$req5 = $bdd->prepare('SELECT COUNT(*) as total FROM `message`');
		$req5->execute(array($pseudo_tmp));
		if($donnees5 = $req5->fetch())
			$res.='"nombre_messages":"'.$donnees5['total'].'", ';
		
		$req8 = $bdd->prepare('SELECT COUNT(*) as total FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?');
		$req8->execute(array($pseudo_tmp, $pseudo_tmp));
		if($donnees8 = $req8->fetch()) {
			$res.='"nombre_mes_amis":"'.$donnees8['total'].'", ';

			if($donnees8['total']!=0) {
				$sql_req_7 = 
				'SELECT COUNT( `nb_ami` )+1 AS `rang`
				FROM (
			    	SELECT SUM(`cmp`) AS `nb_ami`
				    FROM (
				    	SELECT `Utilisateur_pseudo` AS `pseudo`, COUNT( `Utilisateur_pseudo` ) AS `cmp`
					    FROM `ami`
					    GROUP BY `Utilisateur_pseudo`
					    UNION ALL
					    SELECT `pseudo_ami` AS `pseudo`, COUNT( `pseudo_ami` ) AS `cmp`
					    FROM `ami`
					    GROUP BY `pseudo_ami`
				    ) AS M
					GROUP BY `pseudo`
					ORDER BY `nb_ami` DESC
				) AS T
				WHERE `nb_ami` > (
					SELECT SUM(`cmp`) AS `nb`
			    	FROM (
				    	SELECT `Utilisateur_pseudo` AS `pseudo`, COUNT( `Utilisateur_pseudo` ) AS `cmp`
					    FROM `ami`
					    GROUP BY `Utilisateur_pseudo`
					    UNION ALL
					    SELECT `pseudo_ami` AS `pseudo`, COUNT( `pseudo_ami` ) AS `cmp`
					    FROM `ami`
					    GROUP BY `pseudo_ami`
				    ) AS D
					WHERE `pseudo` = ?
					GROUP BY `pseudo`
					ORDER BY `nb` DESC
				)';

				$req7 = $bdd->prepare($sql_req_7);
				$req7->execute(array($pseudo_tmp));
				if($donnees7 = $req7->fetch())
					$res.='"rang_ami":"'.$donnees7['rang'].'", ';
			}
			else
				$res.='"rang_ami":"'.$donnees3['total'].'", ';
		}

		if($donnees['clic_best']=='0') {
			$res.='"rang_jeu_clic":"'.$donnees3['total'].'", ';
		}
		else {
			$sql_req_9 = 
			'SELECT COUNT( `clic_best` )+1 AS `rang`
			FROM (
			    SELECT `clic_best`
			    FROM `utilisateur`
			    ORDER BY `clic_best`
			) AS T
			WHERE `clic_best` > (
			    SELECT `clic_best`
			    FROM `utilisateur`
			    WHERE `pseudo` = ?
			)';
			$req9 = $bdd->prepare($sql_req_9);
			$req9->execute(array($pseudo_tmp));
			if($donnees9 = $req9->fetch())
				$res.='"rang_jeu_clic":"'.$donnees9['rang'].'"';
		}



		$res.='}';
		$i+=1;
	}

	$res.=']';
	if($i==$per_page)
		$res.=', "next":'.($page+1);

	$res.='}';

	echo $res;
?>
