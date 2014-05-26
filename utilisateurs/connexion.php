<?php

	include_once 'classe_Utilisateur.php';

	$pseudo = $_GET['pseudo'];
	$mot_de_passe = $_GET['mot_de_passe'];

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$res = '{ "utilisateur" : [';

	$req = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ? AND `mot_de_passe` = ?');
	$req->execute(array($pseudo, $mot_de_passe));
	if($donnees = $req->fetch()) {
		$res.='{';
		$res.='"pseudo": "'.$donnees['pseudo'].'", ';
		$res.='"mot_de_passe": "'.$donnees['mot_de_passe'].'", ';
		$res.='"sexe":"'.$donnees['sexe'].'", ';
		$res.='"xp":"'.$donnees['xp'].'", ';
		$res.='"url_image_profil":"'.$donnees['url_image_profil'].'", ';
		$res.='"description":"'.$donnees['description'].'", ';

		$res.='"clic_best":"'.$donnees['clic_best'].'", ';
		$res.='"clic_total":"'.$donnees['clic_total'].'", ';

		$req3 = $bdd->prepare('SELECT COUNT(*) as total FROM `utilisateur`');
		$req3->execute(array());
		if($donnees3 = $req3->fetch()) {
			$res.='"nombre_utilisateurs":"'.$donnees3['total'].'", ';
		}

		$req4 = $bdd->prepare('SELECT COUNT(*) as total FROM `message` WHERE `Utilisateur_pseudo` = ?');
		$req4->execute(array($pseudo));
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
				$req6->execute(array($pseudo));
				if($donnees6 = $req6->fetch()) {
					$res.='"rang_chat":"'.$donnees6['rang'].'", ';
				}
			}
			else {
				$res.='"rang_chat":"'.$donnees3['total'].'", ';
			}
		}

		$req5 = $bdd->prepare('SELECT COUNT(*) as total FROM `message`');
		$req5->execute(array($pseudo));
		if($donnees5 = $req5->fetch()) {
			$res.='"nombre_messages":"'.$donnees5['total'].'", ';
		}
		
		$req8 = $bdd->prepare('SELECT COUNT(*) as total FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?');
		$req8->execute(array($pseudo, $pseudo));
		if($donnees8 = $req8->fetch()) {
			$res.='"nombre_mes_amis":"'.$donnees8['total'].'", ';

			if($donnees8['total']!=0) {
				$sql_req_7 = 
				'SELECT COUNT( `nb_ami` )+1 AS `rang`
				FROM (
				    SELECT COUNT( * ) AS `nb_ami`
				    FROM `ami`
				    ORDER BY `nb_ami`
				) AS T
				WHERE `nb_ami` > (
				    SELECT COUNT( * )
				    FROM `ami` 
				    WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?
				    ORDER BY `nb_ami`
				)';

				$req7 = $bdd->prepare($sql_req_7);
				$req7->execute(array($pseudo, $pseudo));
				if($donnees7 = $req7->fetch()) {
					$res.='"rang_ami":"'.$donnees7['rang'].'", ';
				}
			}
			else {
				$res.='"rang_ami":"'.$donnees3['total'].'", ';				
			}
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
		$req9->execute(array($pseudo));
		if($donnees9 = $req9->fetch()) {
			$res.='"rang_jeu_clic":"'.$donnees9['rang'].'", ';
		}
		

		$req10 = $bdd->prepare('SELECT MAX(`clic_best`) AS `maxi` FROM `utilisateur`');
		$req10->execute();
		if($donnees10 = $req10->fetch()) {
			$res.='"clic_best_world":"'.$donnees10['maxi'].'", ';
		}
		

		$res.='"admin":"'.$donnees['admin'].'"';

		$req2 = $bdd->prepare('SELECT * FROM `demandeami` WHERE `pseudo_ami` = ?');
		$req2->execute(array($pseudo));
		$id = 0;
		while($donnees2 = $req2->fetch()) {
			if($id == 0) {
				$res.=', "demandeami": [{';
			}
			else {
				$res.=', {';
			}
			$res.='"Utilisateur_pseudo": "'.$donnees2['Utilisateur_pseudo'].'", ';

			$res.= '"utilisateur" : ';
			$req3 = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
			$req3->execute(array($donnees2['Utilisateur_pseudo']));
			if($donnees3 = $req3->fetch()) {
				$res.='{';
				$res.='"pseudo": "'.$donnees3['pseudo'].'", ';
				$res.='"mot_de_passe": "'.$donnees3['mot_de_passe'].'", ';
				$res.='"sexe":"'.$donnees3['sexe'].'", ';
				$res.='"xp":"'.$donnees3['xp'].'", ';
				$res.='"url_image_profil":"'.$donnees3['url_image_profil'].'", ';
				$res.='"admin":"'.$donnees3['admin'].'"';
				$res.='},';
			}

			$res.='"date_de_creation": "'.$donnees2['date_de_creation'].'"';		
			$res.='}';
			$id += 1;
		}
		if($id!=0) {
			$res.=']';
		}

		$res.='}';
		$res.='], ';


		$res .= '"messages" : [';

		$req = $bdd->prepare('SELECT * FROM `message` WHERE `destinataire` = ? ORDER BY date_de_creation DESC LIMIT 30');
		$req->execute(array('All'));

		$x = 0;

		while($donnees = $req->fetch()) {
			if($x==0)
				$res.='{';
			else
				$res.=',{';

			$req2 = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
			$req2->execute(array($donnees['Utilisateur_pseudo']));
			if($donnees2 = $req2->fetch()) {
				$res.='"utilisateur": {';
				$res.='"pseudo": "'.$donnees2['pseudo'].'", ';
				$res.='"mot_de_passe": "'.$donnees2['mot_de_passe'].'", ';
				$res.='"sexe":"'.$donnees2['sexe'].'", ';
				$res.='"xp":"'.$donnees2['xp'].'", ';
				$res.='"url_image_profil":"'.$donnees2['url_image_profil'].'", ';
				$res.='"admin":"'.$donnees2['admin'].'"';
				$res.='}, ';
			}

			$res.='"Utilisateur_pseudo": "'.$donnees['Utilisateur_pseudo'].'", ';
			$res.='"message": "'.$donnees['message'].'", ';
			$res.='"Image_url": "'.$donnees['Image_url'].'", ';

			$date = date('Y-m-d H:i:s');
			$diff_temps_sec = abs(strtotime($date) - strtotime(date($donnees['date_de_creation'])));

			if( $diff_temps_sec < 60) {
			    $date_relative = 'il y a '.$diff_temps_sec.'s';
			}
			else {
				$diff_temps_min = intval($diff_temps_sec / 60);

				if($diff_temps_min < 60) {
					$date_relative = 'il y a '.$diff_temps_min.'mn';
				}
				else {
					$diff_temps_h = intval($diff_temps_min / 60);

					if($diff_temps_h < 24) {
						$date_relative = 'il y a '.$diff_temps_h.'h'.($diff_temps_min-$diff_temps_h*60);
					}
					else {
						$diff_temps_j = intval($diff_temps_h / 24);

						if($diff_temps_j < 30) {
							$date_relative = 'il y a '.$diff_temps_j.'j';
						}
						else {
							$diff_temps_mois = intval($diff_temps_j / 30);

							if($diff_temps_mois < 12) {
								$date_relative = 'il y a '.$diff_temps_mois.' mois';
							}
							else {
								$diff_temps_ans = intval($diff_temps_mois / 12);

								if($diff_temps_ans==1) {
									$date_relative = 'il y a '.$diff_temps_ans.' an';
								}
								else {
									$date_relative = 'il y a '.$diff_temps_ans.' ans';
								}
							}
						}
					}
				}
			}
			$res.='"date": "'.$date_relative.'", ';
			$res.='"date_de_creation": "'.$donnees['date_de_creation'].'", ';
			$res.='"destinataire": "'.$donnees['destinataire'].'"';
			$res.='}';

			$x+=1;
		}
		$res.='}';
		$res.=']} ';


		echo $res;
	}
	else {
		$res='KO';
		echo $res;
	}
?>
