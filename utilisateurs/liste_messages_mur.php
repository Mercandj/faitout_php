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

	$requete = 'SELECT * FROM `message` WHERE `Utilisateur_pseudo` = ? AND `destinataire` = \'Mur\' ORDER BY date_de_creation DESC LIMIT 30';

	$req = $bdd->prepare($requete);
	$req->execute(array($pseudo));
	
	$x = 0;
	while($donnees = $req->fetch()) {

		if($x==0)
			$res.='{';
		else
			$res.=',{';

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

	echo $res.']}';
?>