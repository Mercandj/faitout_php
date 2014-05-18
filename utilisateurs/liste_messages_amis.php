<?php

	$pseudo = $_GET['pseudo'];

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$res = '{ "messages" : [';

	$req = $bdd->prepare('SELECT * FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?');
	$req->execute(array($pseudo, $pseudo));

	$id = 0;

	while($donnees = $req->fetch()) {

		if($id!=0) $res.=',';
		
		if($donnees['Utilisateur_pseudo'] != $pseudo) {
			
			$req2 = $bdd->prepare('SELECT * FROM `message` WHERE `Utilisateur_pseudo` = ? OR `Utilisateur_pseudo` = ? ORDER BY date_de_creation DESC LIMIT 30');
			$req2->execute(array($donnees['Utilisateur_pseudo'], $pseudo));
			$x = 0;
			while($donnees2 = $req2->fetch()) {

				if($x==0)
					$res.='{';
				else
					$res.=',{';

				$res.='"Utilisateur_pseudo": "'.$donnees2['Utilisateur_pseudo'].'", ';
				$res.='"message": "'.$donnees2['message'].'", ';
				$res.='"Image_url": "'.$donnees2['Image_url'].'", ';

				$date = date('Y-m-d H:i:s');
				$diff_temps_sec = abs(strtotime($date) - strtotime(date($donnees2['date_de_creation'])));

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
				$res.='"date_de_creation": "'.$donnees2['date_de_creation'].'", ';
				$res.='"destinataire": "'.$donnees2['destinataire'].'"';
				$res.='}';

				$x+=1;
			}
			
		}
		else if($donnees['pseudo_ami'] != $pseudo) {
			
			$req2 = $bdd->prepare('SELECT * FROM `message` WHERE `Utilisateur_pseudo` = ? OR `Utilisateur_pseudo` = ? ORDER BY date_de_creation DESC LIMIT 30');
			$req2->execute(array($donnees['pseudo_ami'], $pseudo));
			$x = 0;
			while($donnees2 = $req2->fetch()) {

				if($x==0)
					$res.='{';
				else
					$res.=',{';

				$res.='"Utilisateur_pseudo": "'.$donnees2['Utilisateur_pseudo'].'", ';
				$res.='"message": "'.$donnees2['message'].'", ';
				$res.='"Image_url": "'.$donnees2['Image_url'].'", ';

				$date = date('Y-m-d H:i:s');
				$diff_temps_sec = abs(strtotime($date) - strtotime(date($donnees2['date_de_creation'])));

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
				$res.='"date_de_creation": "'.$donnees2['date_de_creation'].'", ';
				$res.='"destinataire": "'.$donnees2['destinataire'].'"';
				$res.='}';

				$x+=1;
			}
		}
		else {
			$res.='KO';
		}
		$id+=1;
	}

	echo $res.']}';
?>