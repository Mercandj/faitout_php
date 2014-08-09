<?php
	include_once 'lib.php';

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$res = '{ "messages" : [';

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
		$res.='"message": "'.str_replace('"', '\"', $donnees['message']).'", ';
		$res.='"Image_url": "'.$donnees['Image_url'].'", ';

		$date = date('Y-m-d H:i:s');
		$date_relative = difference_date($date, date($donnees['date_de_creation']));

		$res.='"date": "'.$date_relative.'", ';
		$res.='"date_de_creation": "'.$donnees['date_de_creation'].'", ';
		$res.='"destinataire": "'.$donnees['destinataire'].'"';
		$res.='}';

		$x+=1;
	}

	echo $res.']}';
?>
