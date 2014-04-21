<?php

	include_once 'classe_Utilisateur.php';

	$pseudo = $_GET['pseudo'];
	$mot_de_passe = $_GET['mot_de_passe'];

	$res = '{ "utilisateur" : [';

	$req = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
	$req->execute(array($pseudo));
	if($donnees = $req->fetch()) {
		$res.='{';
		$res.='"pseudo": "'.$donnees['pseudo'].'", ';
		$res.='"mot_de_passe": "'.$donnees['mot_de_passe'].'", ';
		$res.='"sexe":"'.$donnees['sexe'].'", ';
		$res.='"xp":"'.$donnees['xp'].'", ';
		$res.='"admin":"'.$donnees['admin'].'"';
		$res.='}';
		$res.=']}';
		echo $res;
	}
	else {
		$res.='KO';
		echo $res;
	}
?>
