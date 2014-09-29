<?php
	$pseudo = $_GET['pseudo'];
	$clic_best = $_GET['clic_best'];
	$clic_total = $_GET['clic_total'];

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$req = $bdd->prepare('UPDATE `utilisateur` SET `clic_best` = ?, `clic_total` = ?  WHERE `pseudo` = ?');
	$req->execute(array($clic_best, $clic_total, $pseudo));

	$res = 'Xp est mise à jour.';

	echo $res;
?>