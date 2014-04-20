<?php

	include_once 'classe_Utilisateur.php';
	include_once 'inscription_check_utilisateur_db.php';

	$pseudo = $_GET['pseudo'];
	$mot_de_passe = $_GET['mot_de_passe'];
	$sexe = $_GET['sexe'];

	// Connexion à la base de données
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e)
	{
	die('Erreur : '.$e->getMessage());
	}

	$res = '';

	if(utilisateur_existant($pseudo))
	{
		$res.='Ce nom d\'utilisateur est deja pris.';
	}
	else
	{
	  $us = new Utilisateur($pseudo, $mot_de_passe, $sexe);

	  $req = $bdd->prepare($us->getinsert());
	  $req->execute($us->getarray());
	  $res.='Felicitations, vous pouvez desormais vous connecter avec votre pseudo et votre mot de passe.';

	}

	echo $res;
?>
