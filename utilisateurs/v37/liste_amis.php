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
				$res.='"pseudo": "'.str_replace('"', '\"', $donnees2['pseudo']).'", ';
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
						$req7->execute(array($donnees2['pseudo']));
						if($donnees7 = $req7->fetch())
							$res.='"rang_ami":"'.$donnees7['rang'].'", ';
					}
					else
						$res.='"rang_ami":"'.$donnees3['total'].'", ';
				}

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
				$req9->execute(array($donnees2['pseudo']));
				if($donnees9 = $req9->fetch())
					$res.='"rang_jeu_clic":"'.$donnees9['rang'].'"';

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
						$req7->execute(array($donnees2['pseudo'], $donnees2['pseudo']));
						if($donnees7 = $req7->fetch())
							$res.='"rang_ami":"'.$donnees7['rang'].'", ';
					}
					else
						$res.='"rang_ami":"'.$donnees3['total'].'", ';
				}

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
				$req9->execute(array($donnees2['pseudo']));
				if($donnees9 = $req9->fetch())
					$res.='"rang_jeu_clic":"'.$donnees9['rang'].'"';

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
