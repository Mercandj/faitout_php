<?php
	if(isset($_GET['pseudo']))
		$pseudo = $_GET['pseudo'];

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$req = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
	$req->execute(array($pseudo));
	if(!$req->fetch()) {
		die('401 Erreur : '.$pseudo.' inconnu');
	}

	$res = '{ "messages" : [';

	$req = $bdd->prepare('SELECT * FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?');
	$req->execute(array($pseudo, $pseudo));

	$array_amis = array();

	array_push($array_amis, $pseudo);

	while($donnees = $req->fetch()) {
		
		if($donnees['Utilisateur_pseudo'] != $pseudo) {
			array_push($array_amis, $donnees['Utilisateur_pseudo']);
		}
		else if($donnees['pseudo_ami'] != $pseudo) {
			array_push($array_amis, $donnees['pseudo_ami']);
		}
		else {
			$res.='KO';
		}
	}

	$requete = 'SELECT * FROM `message` WHERE (`Utilisateur_pseudo` = \'';
	$x = 0;
	foreach($array_amis as $element) {
		if($x!=0) $requete.= '\' OR `Utilisateur_pseudo` = \'';
		$requete.=$element;
		$x+=1;
	}
	$requete .='\') AND `destinataire` = \'Amis\' ORDER BY date_de_creation DESC LIMIT 30';

	$req2 = $bdd->prepare($requete);
	$req2->execute();
	
	$x = 0;
	while($donnees2 = $req2->fetch()) {

		if($x==0)
			$res.='{';
		else
			$res.=',{';

		$res.='"Utilisateur_pseudo": "'.str_replace('"', '\"', $donnees2['Utilisateur_pseudo']).'", ';
		$res.='"message": "'.str_replace('"', '\"', $donnees2['message']).'", ';
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
		$res.='"destinataire": "'.str_replace('"', '\"', $donnees2['destinataire']).'"';
		$res.='}';
		$x+=1;
	}

	echo $res.']}';
?>