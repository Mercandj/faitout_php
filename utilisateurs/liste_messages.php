<?php
	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$res = '{ "messages" : [';

	$req = $bdd->prepare('SELECT * FROM `message`');
	$req->execute();
	while($donnees = $req->fetch()) {

		$res.='{';

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
		$diff_temps_sec = abs(strtotime($date) - strtotime(date($donnees['date'])));

		if( $diff_temps_sec < 60) {
		    $date_relative = 'il y a '.$diff_temps_sec.'s';
		}
		else {
			$diff_temps_min = $diff_temps_sec / 60;
			$date_relative = 'il y a '.$diff_temps_min.'mn';
		}
		$res.='"date": "'.$date_relative.'", ';
		$res.='"destinataire": "'.$donnees['destinataire'].'"';
		$res.='},';
	}

	echo $res.']}';
?>
